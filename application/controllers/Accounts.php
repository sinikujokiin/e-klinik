<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Accounts extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		// var_dump(isset(isLogin()['status']));die;
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

		$account = Account::with('role')->get();
		$data = [
			'title' => 'Pengguna',
			'breadcrumb' => 'List Pengguna',
			'account'  => $account,
		];
		$this->template->load('templates/cms','cms/account/index', $data,FALSE);
	}

	function show($id)
	{
		if (!cekAccess($this->uri->segment(1), 'detail')) {
			danger('Anda tidak memiliki akses');
			redirect('dashboard','refresh');
		}
		$id = encrypt_decrypt('decrypt', $id);
		$account = Account::find($id);
		if (!$account) {
			danger('Data account tidak ditemukan');
			redirect(base_url('accounts'),'refresh');
		}

		$data = [
			'title' 		=> 'Pengguna',
			'breadcrumb' 	=> 'Detail Data Pengguna',
			'account' 		=> $account,
		];


		$this->template->load('templates/cms','cms/account/show', $data,FALSE);
	}

	public function create()
	{
		if (!cekAccess($this->uri->segment(1), 'create')) {
			danger('Anda tidak memiliki akses');
			redirect('dashboard','refresh');
		}
		$data = [
			'title' => 'Pengguna',
			'breadcrumb' => 'Tambah Data Pengguna',
			'role' => Role::get()
		];
		$this->template->load('templates/cms','cms/account/create', $data,FALSE);
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
			danger('Data account tidak ditemukan');
			redirect('accounts/create','refresh');
		}

		$this->form_validation->set_rules('username', 'Username', 'trim|required|is_unique_soft[accounts.username]', messageError());
		$this->form_validation->set_rules('password', 'Password', 'trim|required', messageError());
		$this->form_validation->set_rules('fullname', 'Nama Lengkap', 'trim|required', messageError());
		$this->form_validation->set_rules('confirm_password', 'Konfirmasi Password', 'trim|required|matches[password]', messageError());
		$this->form_validation->set_error_delimiters('<small class="text-danger"> <i class="fa fa-exclamation-circle"></i> ', '</small>');
		// var_dump($this->form_validation->run());die;
		if ($this->form_validation->run()) {
			$account = new Account;
			$account->role_id = $request['role_id'];
			$account->username = $request['username'];
			$account->fullname = $request['fullname'];
			$account->password = password_hash($request['password'], PASSWORD_DEFAULT);
			$account->save();

			success('Berhasil menambahkan data account');
			redirect(base_url('accounts'));
		} else {
			$error = getErrorValidation();
			$this->session->set_flashdata('error', $error);
			redirect(base_url('accounts/create'));
		}

	}

	function edit($id)
	{
		if (!cekAccess($this->uri->segment(1), 'update')) {
			danger('Anda tidak memiliki akses');
			redirect('dashboard','refresh');
		}
		$id = encrypt_decrypt('decrypt', $id);
		$account = Account::find($id);
		if (!$account) {
			danger('Data account tidak ditemukan');
			redirect(base_url('accounts'),'refresh');
		}
		$data = [
			'title' => 'Pengguna',
			'breadcrumb' => 'Ubah Data Pengguna',
			'account' => $account,
			'role' => Role::get()

		];

		$this->template->load('templates/cms','cms/account/edit', $data,FALSE);

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
		$account = Account::find($id);

		if (!$account) {
			danger('Data account tidak ditemukan');
			redirect(base_url('accounts'), 'refresh');
		}

		if (!$request) {
			redirect('accounts/edit/'.$id,'refresh');
		}

		if($account->username != $request['username']){
			$is_unique = '|is_unique_soft[accounts.username]';
		}

		$this->form_validation->set_rules('username', 'Username', 'trim|required'.$is_unique, messageError());
		$this->form_validation->set_rules('password', 'Password', 'trim', messageError());
		$this->form_validation->set_rules('fullname', 'Nama Lengkap', 'trim|required', messageError());
		$this->form_validation->set_rules('confirm_password', 'Konfirmasi Password', 'trim|matches[password]', messageError());
		$this->form_validation->set_error_delimiters('<small class="text-danger"> <i class="fa fa-exclamation-circle"></i> ', '</small>');

		if ($this->form_validation->run()) {

			$account->role_id = $request['role_id'];
			$account->username = $request['username'];
			$account->fullname = $request['fullname'];
			if ($request['password']) {
				$account->password = password_hash($request['password'], PASSWORD_DEFAULT);
			}
			$account->save();

			success('Berhasil memperbarui data account');
			redirect(base_url('accounts'));
		} else {
			$error = getErrorValidation();
			$this->session->set_flashdata('error', $error);
			redirect(base_url('accounts/edit/'.encrypt_decrypt('encrypt',$id)));
		}

	}

	function destroy($id)
	{
		if (!cekAccess($this->uri->segment(1), 'delete')) {
			danger('Anda tidak memiliki akses');
			redirect('dashboard','refresh');
		}
		$id = encrypt_decrypt('decrypt', $id);
		$account = Account::find($id);
		if (!$account) {

			danger('Data account tidak ditemukan');
			redirect(base_url('accounts'),'refresh');
		}

		$account->delete();

		success('Berhasil menghapus data account');
		redirect(base_url('accounts'),'refresh');
	}
}
