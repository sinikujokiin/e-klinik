<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Patients extends CI_Controller {

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
		$patients = Patient::get();
		$data = [
			'title' 		=> 'Data Pasien',
			'breadcrumb' 	=> 'List Data Pasien',
			'patients' 	=> $patients
		];
		$this->template->load('templates/cms','cms/patients/index', $data,FALSE);
	}

	public function create()
	{
		if (!cekAccess($this->uri->segment(1), 'create')) {
			danger('Anda tidak memiliki akses');
			redirect('dashboard','refresh');
		}
		$lastRecord = Patient::whereYear('created_at', date('Y'))->latest()->first();
		$lastNum 	= $lastRecord ? $lastRecord->code : 0 ;
		$strCode 	= "RM".date("y");

		$data = [
			'title' 		=> 'Pasien',
			'breadcrumb' 	=> 'Tambah Data Pasien',
			'code'			=> generateCode($lastNum, $strCode, 4)
		];

		$this->template->load('templates/cms','cms/patients/create', $data,FALSE);
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
			redirect('patients/create','refresh');
		}

		$this->form_validation->set_rules('code', 'kode', 'trim|required|is_unique_soft[patients.code]', messageError());
		$this->form_validation->set_rules('name', 'nama pasien', 'trim|required', messageError());
		$this->form_validation->set_rules('pob', 'tempat lahir', 'trim|xss_clean', messageError());
		$this->form_validation->set_rules('dob', 'tanggal lahir', 'trim', messageError());
		$this->form_validation->set_rules('address', 'alamat', 'trim|xss_clean', messageError());
		$this->form_validation->set_rules('phone', 'no. hp', 'trim|numeric|min_length[10]|max_length[15]', messageError());
		$this->form_validation->set_rules('email', 'email', 'trim|valid_email', messageError());
		$this->form_validation->set_rules('gender', 'jenis kelamin', 'trim', messageError());
		$this->form_validation->set_rules('status', 'status', 'trim', messageError());
		$this->form_validation->set_rules('type', 'pengobatan', 'trim', messageError());
		$this->form_validation->set_rules('bpjs_number', 'Nomer BPJS', 'trim', messageError());
		$this->form_validation->set_error_delimiters('<small class="text-danger"> <i class="fa fa-exclamation-circle"></i> ', '</small>');
		// var_dump($this->form_validation->run());die;
		if ($this->form_validation->run()) {
			$year = date_diff(date_create($request['dob']), date_create())->y;
			$month = date_diff(date_create($request['dob']), date_create())->m;
			$request['age'] 	= json_encode(['year' => $year, 'month' => $month]);
			$request['status'] 	= isset($request['status']) ? "Aktif" : "Tidak Aktif"; 
			if ($request['type'] == 'UMUM') {
				unset($request['bpjs']);
			}
			Patient::insert($request);

			success('Berhasil menambahkan data pasien');
			redirect(base_url('patients'));
		} else {
			$error = getErrorValidation();
			$error['gender'] = strip_tags(form_error('gender'));
			$this->session->set_flashdata('error', $error);
			redirect(base_url('patients/create'));
		}

	}

	function edit($id)
	{
		if (!cekAccess($this->uri->segment(1), 'update')) {
			danger('Anda tidak memiliki akses');
			redirect('dashboard','refresh');
		}
		$id = encrypt_decrypt('decrypt', $id);
		$patients = Patient::find($id);
		if (!$patients) {
			danger('Data pasien tidak ditemukan');
			redirect(base_url('patients'),'refresh');
		}
		$data = [
			'title' 		=> 'Pasien',
			'breadcrumb' 	=> 'Ubah Data Pasien',
			'patients' 	=> $patients
		];

		$this->template->load('templates/cms','cms/patients/edit', $data,FALSE);

	}

	function update($id)
	{
		if (!cekAccess($this->uri->segment(1), 'create')) {
			danger('Anda tidak memiliki akses');
			redirect('dashboard','refresh');
		}

		$request = $this->input->post();
		// var_dump($request);die;
		if (!$request) {
			danger('Data tidak valid');
			redirect('patients/edit/'.$id,'refresh');
		}

		$patients = Patient::find(encrypt_decrypt('decrypt',$id));
		if (!$patients) {
			danger('Data pasien tidak ditemukan');
			redirect('patients/edit/'.$id,'refresh');
		}

		$is_unique = '';
		if ($request['code'] != $patients->code) {
			$is_unique = '|is_unique_soft[patients.code]';
		}

		
		$this->form_validation->set_rules('code', 'kode', 'trim|required'.$is_unique, messageError());
		$this->form_validation->set_rules('name', 'nama pasien', 'trim|required', messageError());
		$this->form_validation->set_rules('pob', 'tempat lahir', 'trim|xss_clean', messageError());
		$this->form_validation->set_rules('dob', 'tanggal lahir', 'trim', messageError());
		$this->form_validation->set_rules('address', 'alamat', 'trim|xss_clean', messageError());
		$this->form_validation->set_rules('phone', 'no. hp', 'trim|numeric|min_length[10]|max_length[15]', messageError());
		$this->form_validation->set_rules('email', 'email', 'trim|valid_email', messageError());
		$this->form_validation->set_rules('gender', 'jenis kelamin', 'trim', messageError());
		$this->form_validation->set_rules('status', 'status', 'trim', messageError());
		$this->form_validation->set_rules('type', 'pengobatan', 'trim', messageError());
		$this->form_validation->set_rules('bpjs_number', 'Nomer BPJS', 'trim', messageError());
		$this->form_validation->set_error_delimiters('<small class="text-danger"> <i class="fa fa-exclamation-circle"></i> ', '</small>');
		// var_dump($this->form_validation->run());die;
		if ($this->form_validation->run()) {
			$year = date_diff(date_create($request['dob']), date_create())->y;
			$month = date_diff(date_create($request['dob']), date_create())->m;
			$request['age'] 	= json_encode(['year' => $year, 'month' => $month]);
			$request['status'] 	= isset($request['status']) ? "Aktif" : "Tidak Aktif";
			if ($request['type'] == 'UMUM') {
				unset($request['bpjs']);
			}

			$patients->update($request);

			success('Berhasil mengubah data pasien');
			redirect(base_url('patients'));
		} else {
			$error = getErrorValidation();
			$error['gender'] = strip_tags(form_error('gender'));
			
			$this->session->set_flashdata('error', $error);
			redirect(base_url('patients/create'));
		}
	}

	function destroy($id){
		if (!cekAccess($this->uri->segment(1), 'delete')) {
			danger('Anda tidak memiliki akses');
			redirect('dashboard','refresh');
		}
		$id = encrypt_decrypt('decrypt', $id);
		$patients = Patient::find($id);
		if (!$patients) {

			danger('Data pasien tidak ditemukan');
			redirect(base_url('patients'),'refresh');
		}


		$patients->delete();

		success('Berhasil menghapus data pasien');
		redirect(base_url('patients'),'refresh');
	}

	function history($id)
	{
		if (!cekAccess($this->uri->segment(1), 'update')) {
			danger('Anda tidak memiliki akses');
			redirect('dashboard','refresh');
		}
		$id = encrypt_decrypt('decrypt', $id);
		$patients = Patient::find($id);
		if (!$patients) {
			danger('Data riwayat pasien tidak ditemukan');
			redirect(base_url('patients'),'refresh');
		}
		$start = $this->input->get('start');
		$end = $this->input->get('end');
		$patients = Patient::with(['rm' => function($query) use($start,$end){
			if ($start) {
				$query->where('date', '>=', $start);
			}
			if ($end) {
				$query->where('date', '<=', $end);
			}
		}])->find($id);
		$data = [
			'title' 		=> "Riwayat Pasien $patients->code - $patients->name",
			'breadcrumb' 	=> "$patients->code - $patients->name",
			'patients' 	=> $patients
		];

		$this->template->load('templates/cms','cms/patients/history', $data,FALSE);
	}

}

/* End of file Patients.php */
/* Location: ./application/controllers/Patients.php */ ?>