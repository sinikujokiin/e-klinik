<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Treathments extends CI_Controller {

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

		$treathment = Treathment::select('treathments.*', 't.name as parent_name', 't.id as id_parent')
		->join('treathments as t', 'treathments.parent_id', '=', 't.id', 'left')->get();
		$treathments = [];
		$medicine = [];
		foreach ($treathment as $key => $value) {
			if ($value->medicine_query) {
				$treathments[$value->id] = $value; 
				$medicine[$value->id]['medicine'] = $this->db->query("$value->medicine_query")->result(); 
			}else{
				$treathments[$value->id] = $value; 
			}
		}
		$data = [
			'title' => 'Tindakan',
			'breadcrumb' => 'List Tindakan',
			'treathments'  => $treathments,
			'medicine'		=> $medicine
		];
		$this->template->load('templates/cms','cms/treathments/index', $data,FALSE);
	}

	public function create()
	{
		if (!cekAccess($this->uri->segment(1), 'create')) {
			danger('Anda tidak memiliki akses');
			redirect('dashboard','refresh');
		}
		$data = [
			'title' => 'Tindakan',
			'breadcrumb' => 'Tambah Data Tindakan',
			'parent' => Treathment::where('parent_id', null)->get()
		];

		$this->template->load('templates/cms','cms/treathments/create', $data,FALSE);
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
			danger('Data tindakan tidak ditemukan');
			redirect('treathments/create','refresh');
		}

		$this->form_validation->set_rules('name', 'nama tindakan', 'trim|required', messageError());
		$this->form_validation->set_rules('medicine_query', 'query', 'trim', messageError());
		$this->form_validation->set_rules('price', 'harga', 'trim|required|numeric', messageError());
		$this->form_validation->set_rules('parent_id', 'parent', 'trim', messageError());
		$this->form_validation->set_rules('status', 'status', 'trim', messageError());
		$this->form_validation->set_error_delimiters('<small class="text-danger"> <i class="fa fa-exclamation-circle"></i> ', '</small>');
		// var_dump($this->form_validation->run());die;
		if ($this->form_validation->run()) {

			$request['parent_id'] = $request['parent_id'] ? $request['parent_id'] : null; 
			$request['status'] = isset($request['status']) ? "Aktif" : "Tidak Aktif"; 
			Treathment::insert($request);

			success('Berhasil menambahkan data tindakan');
			redirect(base_url('treathments'));
		} else {
			$error = getErrorValidation();
			$this->session->set_flashdata('error', $error);
			redirect(base_url('treathments/create'));
		}

	}

}

/* End of file Treathments.php */
/* Location: ./application/controllers/Treathments.php */ ?>