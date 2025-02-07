<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Medicines extends CI_Controller {

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
		$medicines = Medicine::get();
		$data = [
			'title' 		=> 'Data Obat',
			'breadcrumb' 	=> 'List Data Obat',
			'medicines' 	=> $medicines
		];
		$this->template->load('templates/cms','cms/medicines/index', $data,FALSE);
	}

	public function create()
	{
		if (!cekAccess($this->uri->segment(1), 'create')) {
			danger('Anda tidak memiliki akses');
			redirect('dashboard','refresh');
		}
		$lastRecord = Medicine::latest()->first();
		$lastNum 	= $lastRecord ? $lastRecord->code : 0 ;
		$strCode 	= "OBT";

		$units 	= Medicine::groupBy('unit')->orderBy('unit', 'asc')->get(['unit']);
		$type 	= Medicine::groupBy('type')->orderBy('type', 'asc')->get(['type']);
		$data = [
			'title' 		=> 'Obat',
			'breadcrumb' 	=> 'Tambah Data Obat',
			'units'			=> $units,
			'type'			=> $type,
			'code'			=> generateCode($lastNum, $strCode, 4)
		];

		$this->template->load('templates/cms','cms/medicines/create', $data,FALSE);
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
			redirect('medicines/create','refresh');
		}

		if ($_FILES['image']['name'] != '') {
			$this->form_validation->set_rules('image', 'gambar', 'trim|callback_upload_image', messageError());
		}
		$this->form_validation->set_rules('code', 'kode', 'trim|required|is_unique_soft[medicines.code]', messageError());
		$this->form_validation->set_rules('name', 'nama obat', 'trim|required', messageError());
		$this->form_validation->set_rules('description', 'deskripsi', 'trim|xss_clean', messageError());
		$this->form_validation->set_rules('stock', 'stok', 'trim|numeric', messageError());
		$this->form_validation->set_rules('stock_min', 'stok minimal', 'trim|numeric', messageError());
		$this->form_validation->set_rules('unit', 'unit', 'trim', messageError());
		$this->form_validation->set_rules('purchase_price', 'harga beli', 'trim|numeric', messageError());
		$this->form_validation->set_rules('selling_price', 'harga jual', 'trim|numeric', messageError());
		$this->form_validation->set_rules('status', 'status', 'trim', messageError());
		$this->form_validation->set_rules('type', 'kategori obat', 'trim|required', messageError());
		$this->form_validation->set_error_delimiters('<small class="text-danger"> <i class="fa fa-exclamation-circle"></i> ', '</small>');
		// var_dump($this->form_validation->run());die;
		if ($this->form_validation->run()) {
			if ($_FILES['image']['name'] != '') {
				$request['image'] = $this->session->userdata('image');
				$this->session->unset_userdata('image');
			}
			$request['status'] = isset($request['status']) ? "Aktif" : "Tidak Aktif"; 
			Medicine::insert($request);

			success('Berhasil menambahkan data obat');
			redirect(base_url('medicines'));
		} else {
			$error = getErrorValidation();
			$error['image'] = strip_tags(form_error('image'));

			if (form_error('image') && $_FILES['image']['name']) {
				unlink($this->session->userdata('image'));
			}
			$this->session->set_flashdata('error', $error);
			redirect(base_url('medicines/create'));
		}

	}

	function edit($id)
	{
		if (!cekAccess($this->uri->segment(1), 'update')) {
			danger('Anda tidak memiliki akses');
			redirect('dashboard','refresh');
		}
		$id = encrypt_decrypt('decrypt', $id);
		$medicines = Medicine::find($id);
		if (!$medicines) {
			danger('Data obat tidak ditemukan');
			redirect(base_url('medicines'),'refresh');
		}
		$units = Medicine::groupBy('unit')->orderBy('unit', 'asc')->get(['unit']);
		$type = Medicine::groupBy('type')->orderBy('type', 'asc')->get(['type']);

		$data = [
			'title' 		=> 'Obat',
			'breadcrumb' 	=> 'Ubah Data Obat',
			'medicines' 	=> $medicines,
			'units' 		=> $units,
			'type' 		=> $type
		];

		$this->template->load('templates/cms','cms/medicines/edit', $data,FALSE);

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
			redirect('medicines/edit/'.$id,'refresh');
		}

		$medicines = Medicine::find(encrypt_decrypt('decrypt',$id));
		if (!$medicines) {
			danger('Data obat tidak ditemukan');
			redirect('medicines/edit/'.$id,'refresh');
		}

		$is_unique = '';
		if ($request['code'] != $medicines->code) {
			$is_unique = '|is_unique_soft[medicines.code]';
		}

		if ($_FILES['image']['name'] != '') {
			$this->form_validation->set_rules('image', 'gambar', 'trim|callback_upload_image', messageError());
		}
		$this->form_validation->set_rules('code', 'kode', 'trim|required'.$is_unique, messageError());
		$this->form_validation->set_rules('name', 'nama obat', 'trim|required', messageError());
		$this->form_validation->set_rules('description', 'deskripsi', 'trim|xss_clean', messageError());
		$this->form_validation->set_rules('stock', 'stok', 'trim|numeric', messageError());
		$this->form_validation->set_rules('stock_min', 'stok minimal', 'trim|numeric', messageError());
		$this->form_validation->set_rules('unit', 'unit', 'trim', messageError());
		$this->form_validation->set_rules('purchase_price', 'harga beli', 'trim|numeric', messageError());
		$this->form_validation->set_rules('selling_price', 'harga jual', 'trim|numeric', messageError());
		$this->form_validation->set_rules('status', 'status', 'trim', messageError());
		$this->form_validation->set_rules('type', 'kategori obat', 'trim|required', messageError());
		$this->form_validation->set_error_delimiters('<small class="text-danger"> <i class="fa fa-exclamation-circle"></i> ', '</small>');
		// var_dump($this->form_validation->run());die;
		if ($this->form_validation->run()) {
			if ($_FILES['image']['name'] != '') {
				$request['image'] = $this->session->userdata('image');
				$this->session->unset_userdata('image');
			}
			$request['status'] = isset($request['status']) ? "Aktif" : "Tidak Aktif"; 
			$medicines->update($request);

			success('Berhasil menambahkan data obat');
			redirect(base_url('medicines'));
		} else {
			$error = getErrorValidation();
			$error['image'] = strip_tags(form_error('image'));

			if (form_error('image') && $_FILES['image']['name']) {
				unlink($this->session->userdata('image'));
			}
			$this->session->set_flashdata('error', $error);
			redirect(base_url('medicines/create'));
		}
	}

	function destroy($id){
		if (!cekAccess($this->uri->segment(1), 'delete')) {
			danger('Anda tidak memiliki akses');
			redirect('dashboard','refresh');
		}
		$id = encrypt_decrypt('decrypt', $id);
		$medicines = Medicine::find($id);
		if (!$medicines) {

			danger('Data obat tidak ditemukan');
			redirect(base_url('medicines'),'refresh');
		}


		$medicines->delete();

		success('Berhasil menghapus data obat');
		redirect(base_url('medicines'),'refresh');
	}


	function upload_image()
	{
		$path = '/uploads/medicines/';
		if (!is_dir($path)) {
			// mkdir($path, 0777, TRUE);
		}
		$config['upload_path'] = '.'.$path;
		$config['allowed_types'] = 'gif|jpg|png|jpeg|webp';
		$config['file_name'] = uniqid().'-'.date('y-m-d').'-'.$_FILES['image']['name'];
		$config['overwrite'] = true;
		$this->load->library('upload', $config);
		$this->upload->initialize($config);
		if ( ! $this->upload->do_upload('image')){
			$this->form_validation->set_message('upload_image', $this->upload->display_errors());
			return FALSE;
		}else{
			$ext = explode('.', $this->upload->data('file_name'));
			$ext = end($ext);
			$webp = $this->upload->data('file_name');
			if ($ext != 'webp') {
				// $webp = covertToWebp('.'.$path, $this->upload->data('file_name'));
			}
			$file = $this->session->set_userdata('image', $path.$webp);
			return TRUE;
		}
	}

}

/* End of file Medicines.php */
/* Location: ./application/controllers/Medicines.php */ ?>