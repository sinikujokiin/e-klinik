<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pharmacists extends CI_Controller {

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
		$pharmacists = Pharmacist::with(['account'])->get();
		$data = [
			'title' 		=> 'Data Apoteker',
			'breadcrumb' 	=> 'List Data Apoteker',
			'pharmacists' 	=> $pharmacists
		];
		$this->template->load('templates/cms','cms/pharmacists/index', $data,FALSE);
	}

	public function create()
	{
		if (!cekAccess($this->uri->segment(1), 'create')) {
			danger('Anda tidak memiliki akses');
			redirect('dashboard','refresh');
		}
		$lastRecord = Pharmacist::latest()->first();
		$lastNum 	= $lastRecord ? $lastRecord->code : 0 ;
		$strCode 	= "APTK";

		$data = [
			'title' 		=> 'Apoteker',
			'breadcrumb' 	=> 'Tambah Data Apoteker',
			'code'			=> generateCode($lastNum, $strCode, 4)
		];

		$this->template->load('templates/cms','cms/pharmacists/create', $data,FALSE);
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
			danger('Data tidak valid');
			redirect('pharmacists/create','refresh');
		}

		$this->form_validation->set_rules('code', 'kode', 'trim|required|is_unique_soft[pharmacists.code]', messageError());
		$this->form_validation->set_rules('name', 'nama apoteker', 'trim|required', messageError());
		$this->form_validation->set_rules('no_reg', 'no registrasi', 'trim|required|numeric|is_unique_soft[pharmacists.no_reg]', messageError());
		$this->form_validation->set_rules('pob', 'tempat lahir', 'trim|xss_clean', messageError());
		$this->form_validation->set_rules('dob', 'tanggal lahir', 'trim', messageError());
		$this->form_validation->set_rules('email', 'email', 'trim|valid_email', messageError());
		$this->form_validation->set_rules('gender', 'jenis kelamin', 'trim', messageError());
		$this->form_validation->set_rules('status', 'status', 'trim', messageError());
		$this->form_validation->set_error_delimiters('<small class="text-danger"> <i class="fa fa-exclamation-circle"></i> ', '</small>');
		// var_dump($this->form_validation->run());die;
		if ($this->form_validation->run()) {
			$request['status'] 	= isset($request['status']) ? "Aktif" : "Tidak Aktif"; 
			Pharmacist::insert($request);

			success('Berhasil menambahkan data apoteker');
			redirect(base_url('pharmacists'));
		} else {
			$error = getErrorValidation();
			$error['gender'] = strip_tags(form_error('gender'));
			$this->session->set_flashdata('error', $error);
			redirect(base_url('pharmacists/create'));
		}

	}


	public function create_account($id)
	{
		if (!cekAccess($this->uri->segment(1), 'read') && !cekAccess('accounts', 'read')) {
			danger('Anda tidak memiliki akses');
			redirect('dashboard','refresh');
		}

		$pharmacists = Pharmacist::find(encrypt_decrypt('decrypt',$id));
		if (!$pharmacists) {
			danger('Data apoteker tidak ditemukan');
			redirect(base_url('pharmacists'),'refresh');
		}

		$data = [
			'title' => 'Pengguna',
			'breadcrumb' => 'Tambah Data Pengguna',
			'role' => Role::get(),
			'name' => $pharmacists->name
		];
		$this->template->load('templates/cms','cms/pharmacists/create_account', $data,FALSE);
	}

	public function store_account($id)
	{
		if (!cekAccess($this->uri->segment(1), 'create')) {
			danger('Anda tidak memiliki akses');
			redirect('dashboard','refresh');
		}

		$request = $this->input->post();
		// var_dump($request);die;
		if (!$request) {
			danger('Data tidak valid');
			redirect('pharmacists/create_account','refresh');
		}

		$pharmacists = Pharmacist::find(encrypt_decrypt('decrypt',$id));
		if (!$pharmacists) {
			danger('Data apoteker tidak ditemukan');
			redirect(base_url('pharmacists'),'refresh');
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

			$pharmacists->user_id = $account->id;
			$pharmacists->save();

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
		$pharmacists = Pharmacist::find($id);
		if (!$pharmacists) {
			danger('Data apoteker tidak ditemukan');
			redirect(base_url('pharmacists'),'refresh');
		}
		$data = [
			'title' 		=> 'Apoteker',
			'breadcrumb' 	=> 'Ubah Data Apoteker',
			'pharmacists' 	=> $pharmacists,
		];

		$this->template->load('templates/cms','cms/pharmacists/edit', $data,FALSE);

	}

	public function update($id)
	{
		if (!cekAccess($this->uri->segment(1), 'create')) {
			danger('Anda tidak memiliki akses');
			redirect('dashboard','refresh');
		}

		$request = $this->input->post();
		// var_dump($request);die;
		if (!$request) {
			danger('Data tidak valid');
			redirect('pharmacists/create','refresh');
		}

		$pharmacists = Pharmacist::find(encrypt_decrypt('decrypt', $id));
		if (!$pharmacists) {
			danger('Data apoteker tidak ditemukan');
			redirect('pharmacists/edit/'.$id,'refresh');
		}

		$is_unique_code = '';
		$is_unique_reg = '';
		if ($pharmacists->code != $request['code']) {
			$is_unique_code = '|is_unique_soft[pharmacists.code]';
		}

		if ($pharmacists->no_reg != $request['no_reg']) {
			$is_unique_reg ='|is_unique_soft[pharmacists.no_reg]';
		}

		$this->form_validation->set_rules('code', 'kode', 'trim|required'.$is_unique_code, messageError());
		$this->form_validation->set_rules('name', 'nama apoteker', 'trim|required', messageError());
		$this->form_validation->set_rules('no_reg', 'no registrasi', 'trim|required|numeric'.$is_unique_reg, messageError());
		$this->form_validation->set_rules('pob', 'tempat lahir', 'trim|xss_clean', messageError());
		$this->form_validation->set_rules('dob', 'tanggal lahir', 'trim', messageError());
		$this->form_validation->set_rules('email', 'email', 'trim|valid_email', messageError());
		$this->form_validation->set_rules('gender', 'jenis kelamin', 'trim', messageError());
		$this->form_validation->set_rules('status', 'status', 'trim', messageError());
		$this->form_validation->set_error_delimiters('<small class="text-danger"> <i class="fa fa-exclamation-circle"></i> ', '</small>');
		// var_dump($this->form_validation->run());die;
		if ($this->form_validation->run()) {
			$request['status'] 	= isset($request['status']) ? "Aktif" : "Tidak Aktif"; 
			$pharmacists->update($request);

			success('Berhasil mengubah data apoteker');
			redirect(base_url('pharmacists'));
		} else {
			$error = getErrorValidation();
			$error['gender'] = strip_tags(form_error('gender'));
			$this->session->set_flashdata('error', $error);
			redirect(base_url('pharmacists/create'));
		}

	}

	function destroy($id){
		if (!cekAccess($this->uri->segment(1), 'delete')) {
			danger('Anda tidak memiliki akses');
			redirect('dashboard','refresh');
		}
		$id = encrypt_decrypt('decrypt', $id);
		$pharmacists = Pharmacist::find($id);
		if (!$pharmacists) {

			danger('Data apoteker tidak ditemukan');
			redirect(base_url('pharmacists'),'refresh');
		}

		Account::find($pharmacists->user_id)->delete();

		$pharmacists->delete();



		success('Berhasil menghapus data apoteker');
		redirect(base_url('pharmacists'),'refresh');
	}

}

/* End of file Pharmacists.php */
/* Location: ./application/controllers/Pharmacists.php */ ?>