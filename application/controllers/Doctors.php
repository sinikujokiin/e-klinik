<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Doctors extends CI_Controller {

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
		$doctors = Doctor::with(['account'])->get();
		$data = [
			'title' 		=> 'Data Dokter',
			'breadcrumb' 	=> 'List Data Dokter',
			'doctors' 	=> $doctors
		];
		$this->template->load('templates/cms','cms/doctors/index', $data,FALSE);
	}

	public function create()
	{
		if (!cekAccess($this->uri->segment(1), 'create')) {
			danger('Anda tidak memiliki akses');
			redirect('dashboard','refresh');
		}
		$lastRecord = Doctor::latest()->first();
		$lastNum 	= $lastRecord ? $lastRecord->code : 0 ;
		$strCode 	= "DTR";

		$data = [
			'title' 		=> 'Dokter',
			'breadcrumb' 	=> 'Tambah Data Dokter',
			'code'			=> generateCode($lastNum, $strCode, 4)
		];

		$this->template->load('templates/cms','cms/doctors/create', $data,FALSE);
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
			redirect('doctors/create','refresh');
		}

		$this->form_validation->set_rules('code', 'kode', 'trim|required|is_unique_soft[doctors.code]', messageError());
		$this->form_validation->set_rules('name', 'nama dokter', 'trim|required', messageError());
		$this->form_validation->set_rules('no_reg', 'no registrasi', 'trim|required|numeric|is_unique_soft[doctors.no_reg]', messageError());
		$this->form_validation->set_rules('pob', 'tempat lahir', 'trim|xss_clean', messageError());
		$this->form_validation->set_rules('dob', 'tanggal lahir', 'trim', messageError());
		$this->form_validation->set_rules('email', 'email', 'trim|valid_email', messageError());
		$this->form_validation->set_rules('gender', 'jenis kelamin', 'trim', messageError());
		$this->form_validation->set_rules('status', 'status', 'trim', messageError());
		$this->form_validation->set_error_delimiters('<small class="text-danger"> <i class="fa fa-exclamation-circle"></i> ', '</small>');
		// var_dump($this->form_validation->run());die;
		if ($this->form_validation->run()) {
			$request['status'] 	= isset($request['status']) ? "Aktif" : "Tidak Aktif"; 
			Doctor::insert($request);

			success('Berhasil menambahkan data dokter');
			redirect(base_url('doctors'));
		} else {
			$error = getErrorValidation();
			$error['gender'] = strip_tags(form_error('gender'));
			$this->session->set_flashdata('error', $error);
			redirect(base_url('doctors/create'));
		}

	}


	public function create_account($id)
	{
		if (!cekAccess($this->uri->segment(1), 'read') && !cekAccess('accounts', 'read')) {
			danger('Anda tidak memiliki akses');
			redirect('dashboard','refresh');
		}

		$doctors = Doctor::find(encrypt_decrypt('decrypt',$id));
		if (!$doctors) {
			danger('Data dokter tidak ditemukan');
			redirect(base_url('doctors'),'refresh');
		}

		$data = [
			'title' => 'Pengguna',
			'breadcrumb' => 'Tambah Data Pengguna',
			'role' => Role::get(),
			'name' => $doctors->name
		];
		$this->template->load('templates/cms','cms/doctors/create_account', $data,FALSE);
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
			redirect('doctors/create_account','refresh');
		}

		$doctors = Doctor::find(encrypt_decrypt('decrypt',$id));
		if (!$doctors) {
			danger('Data dokter tidak ditemukan');
			redirect(base_url('doctors'),'refresh');
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

			$doctors->user_id = $account->id;
			$doctors->save();

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
		$doctors = Doctor::find($id);
		if (!$doctors) {
			danger('Data dokter tidak ditemukan');
			redirect(base_url('doctors'),'refresh');
		}
		$data = [
			'title' 		=> 'Dokter',
			'breadcrumb' 	=> 'Ubah Data Dokter',
			'doctors' 	=> $doctors,
		];

		$this->template->load('templates/cms','cms/doctors/edit', $data,FALSE);

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
			redirect('doctors/create','refresh');
		}

		$doctors = Doctor::find(encrypt_decrypt('decrypt', $id));
		if (!$doctors) {
			danger('Data dokter tidak ditemukan');
			redirect('doctors/edit/'.$id,'refresh');
		}

		$is_unique_code = '';
		$is_unique_reg = '';
		if ($doctors->code != $request['code']) {
			$is_unique_code = '|is_unique_soft[doctors.code]';
		}

		if ($doctors->no_reg != $request['no_reg']) {
			$is_unique_reg ='|is_unique_soft[doctors.no_reg]';
		}

		$this->form_validation->set_rules('code', 'kode', 'trim|required'.$is_unique_code, messageError());
		$this->form_validation->set_rules('name', 'nama dokter', 'trim|required', messageError());
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
			$doctors->update($request);

			success('Berhasil mengubah data dokter');
			redirect(base_url('doctors'));
		} else {
			$error = getErrorValidation();
			$error['gender'] = strip_tags(form_error('gender'));
			$this->session->set_flashdata('error', $error);
			redirect(base_url('doctors/create'));
		}

	}

	function destroy($id){
		if (!cekAccess($this->uri->segment(1), 'delete')) {
			danger('Anda tidak memiliki akses');
			redirect('dashboard','refresh');
		}
		$id = encrypt_decrypt('decrypt', $id);
		$doctors = Doctor::find($id);
		if (!$doctors) {

			danger('Data dokter tidak ditemukan');
			redirect(base_url('doctors'),'refresh');
		}

		Account::find($doctors->user_id)->delete();

		$doctors->delete();



		success('Berhasil menghapus data dokter');
		redirect(base_url('doctors'),'refresh');
	}

}

/* End of file Doctors.php */
/* Location: ./application/controllers/Doctors.php */ ?>