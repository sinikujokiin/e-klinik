<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Menus extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if (isset(isLogin()['status'])) {
			danger(isLogin()['msg']);
			redirect(isLogin()['redirect']);
		}
	}

	public function index()
	{
		if (!cekAccess($this->uri->segment(1), 'read')) {
			danger('Anda tidak memiliki akses');
			redirect('dashboard','refresh');
		}

		$menu = Menu::select('menus.*', 'm.name as parent_name', 'm.id as id_parent')
		->join('menus as m', 'menus.parent_id', '=', 'm.id', 'left')->get();
		// var_dump($menu->toArray());die;
		$data = [
			'title' => 'Menu',
			'breadcrumb' => 'List Menu',
			'menu'  => $menu,
		];
		$this->template->load('templates/cms','cms/menu/index', $data,FALSE);
	}

	function show($id)
	{
		if (!cekAccess($this->uri->segment(1), 'detail')) {
			danger('Anda tidak memiliki akses');
			redirect('dashboard','refresh');
		}
		$id = encrypt_decrypt('decrypt', $id);
		$menu = Menu::find($id);
		if (!$menu) {
			danger('Data menu tidak ditemukan');
			redirect(base_url('menus'),'refresh');
		}

		$data = [
			'title' 		=> 'Menu',
			'breadcrumb' 	=> 'Detail Data Menu',
			'menu' 		=> $menu,
		];


		$this->template->load('templates/cms','cms/menu/show', $data,FALSE);
	}

	public function create()
	{
		if (!cekAccess($this->uri->segment(1), 'create')) {
			danger('Anda tidak memiliki akses');
			redirect('dashboard','refresh');
		}
		$data = [
			'title' => 'Menu',
			'breadcrumb' => 'Tambah Data Menu',
			'parent' => Menu::orderBy('sort', 'asc')->orderBy('parent_id', 'asc')->get()
		];

		$this->template->load('templates/cms','cms/menu/create', $data,FALSE);
	}

	public function store()
	{
		if (!cekAccess($this->uri->segment(1), 'create')) {
			danger('Anda tidak memiliki akses');
			redirect('dashboard','refresh');
		}

		$request = $this->input->post();
		// var_dump($request);die;
		if (!$request) {
			danger('Data menu tidak ditemukan');
			redirect('menus/create','refresh');
		}

		$this->form_validation->set_rules('name', 'Nama Menu', 'trim|required', messageError());
		$this->form_validation->set_rules('url', 'Url Menu', 'trim|required', messageError());
		$this->form_validation->set_rules('icon', 'Icon Menu', 'trim|required', messageError());
		$this->form_validation->set_rules('sort', 'Urutan Menu', 'trim|required', messageError());
		$this->form_validation->set_error_delimiters('<small class="text-danger"> <i class="fa fa-exclamation-circle"></i> ', '</small>');
		// var_dump($this->form_validation->run());die;
		if ($this->form_validation->run()) {
			$menu = new Menu;
			$menu->parent_id = $request['parent_id'] ? $request['parent_id'] : null ;
			$menu->name = $request['name'];
			$menu->url = $request['url'];
			$menu->icon = $request['icon'];
			$menu->sort = $request['sort'];
			$menu->access = strtolower(json_encode($request['access']));
			$menu->save();

			success('Berhasil menambahkan data menu');
			redirect(base_url('menus'));
		} else {
			$error = getErrorValidation();
			$this->session->set_flashdata('error', $error);
			redirect(base_url('menus/create'));
		}

	}

	function edit($id)
	{
		if (!cekAccess($this->uri->segment(1), 'update')) {
			danger('Anda tidak memiliki akses');
			redirect('dashboard','refresh');
		}
		$id = encrypt_decrypt('decrypt', $id);
		$menu = Menu::find($id);
		// var_dump($menu);die;
		if (!$menu) {
			danger('Data menu tidak ditemukan');
			redirect(base_url('menus'),'refresh');
		}
		$data = [
			'title' => 'Menu',
			'breadcrumb' => 'Ubah Data Menu',
			'parent' => Menu::orderBy('sort', 'asc')->orderBy('parent_id', 'asc')->get(),
			'menu' => $menu
		];

		$this->template->load('templates/cms','cms/menu/edit', $data,FALSE);

	}

	public function update($id)
	{
		if (!cekAccess($this->uri->segment(1), 'update')) {
			danger('Anda tidak memiliki akses');
			redirect('dashboard','refresh');
		}

		$request = $this->input->post();
		// var_dump($request);die;
		$id =  encrypt_decrypt('decrypt', $id);
		$menu = Menu::find($id);

		if (!$menu) {
			danger('Data menu tidak ditemukan');
			redirect(base_url('menus'), 'refresh');
		}

		if (!$request) {
			redirect('menus/edit/'.$id,'refresh');
		}

		$this->form_validation->set_rules('name', 'Nama Menu', 'trim|required', messageError());
		$this->form_validation->set_rules('url', 'Url Menu', 'trim|required', messageError());
		$this->form_validation->set_rules('icon', 'Icon Menu', 'trim|required', messageError());
		$this->form_validation->set_rules('sort', 'Urutan Menu', 'trim|required', messageError());
		$this->form_validation->set_error_delimiters('<small class="text-danger"> <i class="fa fa-exclamation-circle"></i> ', '</small>');

		if ($this->form_validation->run()) {

			$menu->parent_id = $request['parent_id'] ? $request['parent_id'] : null ;
			$menu->name = $request['name'];
			$menu->url = $request['url'];
			$menu->icon = $request['icon'];
			$menu->sort = $request['sort'];
			$menu->access = strtolower(json_encode($request['access']));
			$menu->save();

			success('Berhasil memperbarui data menu');
			redirect(base_url('menus'));
		} else {
			$error = getErrorValidation();
			$this->session->set_flashdata('error', $error);
			redirect(base_url('menus/edit/'.encrypt_decrypt('encrypt',$id)));
		}

	}

	function destroy($id)
	{
		if (!cekAccess($this->uri->segment(1), 'delete')) {
			danger('Anda tidak memiliki akses');
			redirect('dashboard','refresh');
		}
		$id = encrypt_decrypt('decrypt', $id);
		$menu = Menu::find($id);
		if (!$menu) {

			danger('Data menu tidak ditemukan');
			redirect(base_url('menus'),'refresh');
		}

		$menu->delete();

		$access = RoleAccess::where('menu_id', $id)->delete();

		success('Berhasil menghapus data menu');
		redirect(base_url('menus'),'refresh');
	}
}
