<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Roles extends CI_Controller {

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

		$role = Role::get();
		// var_dump($role->toArray());die;
		$data = [
			'title' => 'Role',
			'breadcrumb' => 'List Role',
			'role'  => $role,
		];
		$this->template->load('templates/cms','cms/role/index', $data,FALSE);
	}

	function show($id)
	{
		if (!cekAccess($this->uri->segment(1), 'detail')) {
			danger('Anda tidak memiliki akses');
			redirect('dashboard','refresh');
		}
		$id = encrypt_decrypt('decrypt', $id);
		$role = Role::find($id);
		if (!$role) {
			danger('Data role tidak ditemukan');
			redirect(base_url('roles'),'refresh');
		}

		$data = [
			'title' 		=> 'Role',
			'breadcrumb' 	=> 'Detail Data Role',
			'role' 		=> $role,
		];


		$this->template->load('templates/cms','cms/role/show', $data,FALSE);
	}

	public function create()
	{
		if (!cekAccess($this->uri->segment(1), 'create')) {
			danger('Anda tidak memiliki akses');
			redirect('dashboard','refresh');
		}
		$data = [
			'title' => 'Role',
			'breadcrumb' => 'Tambah Data Role',
		];

		$this->template->load('templates/cms','cms/role/create', $data,FALSE);
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
			danger('Data role tidak ditemukan');
			redirect('roles/create','refresh');
		}

		$this->form_validation->set_rules('name', 'Nama Role', 'trim|required', messageError());
		$this->form_validation->set_rules('description', 'Deskripsi', 'trim', messageError());
		$this->form_validation->set_error_delimiters('<small class="text-danger"> <i class="fa fa-exclamation-circle"></i> ', '</small>');
		// var_dump($this->form_validation->run());die;
		if ($this->form_validation->run()) {
			$role = new Role;
			$role->name = $request['name'];
			$role->description = $request['description'];
			$role->save();

			success('Berhasil menambahkan data role');
			redirect(base_url('roles'));
		} else {
			$error = getErrorValidation();
			$this->session->set_flashdata('error', $error);
			redirect(base_url('roles/create'));
		}

	}

	function edit($id)
	{
		if (!cekAccess($this->uri->segment(1), 'update')) {
			danger('Anda tidak memiliki akses');
			redirect('dashboard','refresh');
		}
		$id = encrypt_decrypt('decrypt', $id);
		$role = Role::find($id);
		if (!$role) {
			danger('Data role tidak ditemukan');
			redirect(base_url('roles'),'refresh');
		}
		$data = [
			'title' => 'Role',
			'breadcrumb' => 'Ubah Data Role',
			'role' => $role
		];

		$this->template->load('templates/cms','cms/role/edit', $data,FALSE);

	}

	public function update($id)
	{
		if (!cekAccess($this->uri->segment(1), 'update')) {
			danger('Anda tidak memiliki akses');
			redirect('dashboard','refresh');
		}

		$request = $this->input->post();
		$id =  encrypt_decrypt('decrypt', $id);
		$role = Role::find($id);

		if (!$role) {
			danger('Data role tidak ditemukan');
			redirect(base_url('roles'), 'refresh');
		}

		if (!$request) {
			redirect('roles/edit/'.$id,'refresh');
		}

		$this->form_validation->set_rules('name', 'Nama Role', 'trim|required', messageError());
		$this->form_validation->set_rules('description', 'Deskripsi', 'trim', messageError());
		$this->form_validation->set_error_delimiters('<small class="text-danger"> <i class="fa fa-exclamation-circle"></i> ', '</small>');

		if ($this->form_validation->run()) {

			$role->name = $request['name'];
			$role->description = $request['description'];
			$role->save();

			success('Berhasil memperbarui data role');
			redirect(base_url('roles'));
		} else {
			$error = getErrorValidation();
			$this->session->set_flashdata('error', $error);
			redirect(base_url('roles/edit/'.encrypt_decrypt('encrypt',$id)));
		}

	}

	function destroy($id){
		if (!cekAccess($this->uri->segment(1), 'delete')) {
			danger('Anda tidak memiliki akses');
			redirect('dashboard','refresh');
		}
		$id = encrypt_decrypt('decrypt', $id);
		$role = Role::find($id);
		if (!$role) {

			danger('Data role tidak ditemukan');
			redirect(base_url('roles'),'refresh');
		}

		$role->delete();

		$access = RoleAccess::where('role_id', $id)->delete();

		success('Berhasil menghapus data role');
		redirect(base_url('roles'),'refresh');
	}


	// Akses
	function access($id)
	{
		if (!cekAccess($this->uri->segment(1), 'access')) {
			danger('Anda tidak memiliki akses');
			redirect('dashboard','refresh');
		}
		$id = encrypt_decrypt('decrypt', $id);
		$role = Role::find($id);
		if (!$role) {

			danger('Data role tidak ditemukan');
			redirect(base_url('roles'),'refresh');
		}


		$menu = Menu::with(['children' => function($query){
					$query->orderBy('sort', 'asc');
				}])
		->orderBy('sort', 'asc')
		->where('parent_id', null)->get();
		$roleAccess = RoleAccess::where('role_id', $id)->get()->toArray();
		$access = array_column($roleAccess, 'menu_id');
		$idaccess = array_column($roleAccess, 'id');
		foreach ($menu as &$value) {
			$value->checked = false;
			$accessible = $roleAccess ? json_decode($roleAccess[array_search($value->id, $access)]['access']) : [];
			$value->accessible = $accessible ? $accessible : [] ;
			if (is_int(array_search($value->id, $access))) {
				$value->checked = true;
			}




			foreach ($value->children as &$value1) {
				$value1->checked = false;
				$accessible1 = $roleAccess ? json_decode($roleAccess[array_search($value1->id, $access)]['access']) : [];
				$value1->accessible = $accessible1 ? $accessible1 : [] ;
				if (is_int(array_search($value1->id, $access))) {
					$value1->checked = true;
				}
			}
		}
		// var_dump($menu->toArray());die;

		$data = [
			'title' => 'Role Akses',
			'breadcrumb' => 'Role Akses',
			'menu' => $menu,
			'role' => $role
		];

		$this->template->load('templates/cms','cms/role/access', $data,FALSE);
	}

	function storeaccess($id)
	{
		if (!cekAccess($this->uri->segment(1), 'access')) {
			danger('Anda tidak memiliki akses');
			redirect('dashboard','refresh');
		}
		$request = $this->input->post();
		$id = encrypt_decrypt('decrypt', $id);
		$role = Role::find($id);
		if (!$role) {

			danger('Data role tidak ditemukan');
			redirect(base_url('roles'),'refresh');
		}

		$access = RoleAccess::select('menu_id')->where('role_id', $id)->get()->toArray();
		$access = array_column($access, 'menu_id');

		$old = array_diff($access, $request['menu_id']);
		$new = array_diff($request['menu_id'], $access);

		try {
			foreach ($old as $value) {
				RoleAccess::where(['role_id' => $id, 'menu_id' => $value])->delete();
			}

			foreach ($new as $value) {
				RoleAccess::create(['role_id' => $id, 'menu_id' => $value]);
			}

			foreach ($request['access'] as $key => $value) {
				$roleAccess = RoleAccess::where(['menu_id' => $key, 'role_id' =>  $id])->first();
				$roleAccess->access = json_encode($value);
				$roleAccess->save();
			}
			
			success('Berhasil memperbarui akses role');
			redirect(base_url('roles/access/'.encrypt_decrypt('encrypt', $id)));
		} catch (Exception $e) {
			danger('Gagal memperbarui akses role, silahkan hubungi administrator');
			redirect(base_url('roles/access/'.encrypt_decrypt('encrypt', $id)));
		}



	}
}
