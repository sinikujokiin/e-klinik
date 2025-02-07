<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Inspections extends CI_Controller {
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
		$where = [];
		$start = $this->input->get('start');
		$end = $this->input->get('end');

		$inspection = Inspection::with(['patient']);
		$doctor = user()->doctor;
		$apoteker = user()->apoteker;
		if (cekAccess($this->uri->segment(1), 'read_by')) {
			$inspection = Inspection::with(['patient'])->where(function($query) use($doctor) {
				if ($doctor) {
					$query->where('doctor_id', $doctor->id)->orWhere('doctor_id', null)->orWhere('created_by', $doctor->id);
				}
			});
		}
		if ($this->input->get()) {
		    if ($start) {
			    $inspection->where('date', '>=', $start);
		    }
		    if ($end) {
			    $inspection->where('date', '<=', $end);
		    }
		}
		$inspections = $inspection->get();
		// $inspections->get();
		// var_dump(cekAccess($this->uri->segment(1), 'read_by'));die;
		// var_dump($inspections->toSql());die;
		$data = [
			'title' 		=> 'Data Pemeriksaan',
			'breadcrumb' 	=> 'List Data Pemeriksaan',
			'inspections' 	=> $inspections
		];
		$this->template->load('templates/cms','cms/inspections/index', $data,FALSE);
	}

	public function show($id)
	{
		if (!cekAccess($this->uri->segment(1), 'detail')) {
			danger('Anda tidak memiliki akses');
			redirect('dashboard','refresh');
		}

		$idD = encrypt_decrypt('decrypt', $id);

		$inspections = Inspection::with(['patient', 'recipe.transaction', 'doctor', 'recipe.apoteker'])->find($idD);
		if (!$inspections) {
			danger('Data pemeriksaan tidak ditemukan');
			redirect('inspections','refresh');

		}

		// var_dump($inspections->toArray());die;

		$data = [
			'title' 		=> 'Data Pemeriksaan',
			'breadcrumb' 	=> "Detal Pemeriksaan - $inspections->code",
			'inspections' 	=> $inspections
		];
		$this->template->load('templates/cms','cms/inspections/show', $data,FALSE);


	}

	public function create()
	{
		if (!cekAccess($this->uri->segment(1), 'create')) {
			danger('Anda tidak memiliki akses');
			redirect('dashboard','refresh');
		}
		$lastRecord = Inspection::whereYear('created_at', date('Y'))->latest()->first();
		$lastNum 	= $lastRecord ? $lastRecord->code : 0 ;
		$strCode 	= "PRS".date("y");


		



		$treathment = Treathment::with(['children'])->where('parent_id', null)->get();
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
			'title' 		=> 'Pemeriksaan',
			'breadcrumb' 	=> 'Tambah Data Pemeriksaan',
			'patients'		=> Patient::get(),
			'treathments'	=> $treathments,
			'medicine'		=> $medicine,
			'code'			=> generateCode($lastNum, $strCode, 4)
		];

		$this->template->load('templates/cms','cms/inspections/create', $data,FALSE);
	}

	function store()
	{
		if (!cekAccess($this->uri->segment(1), 'create')) {
			danger('Anda tidak memiliki akses');
			redirect('dashboard','refresh');
		}

		$request = $this->input->post();
		// var_dump($request);die;
		if (!$request) {
			danger('Data pemeriksaan tidak ditemukan');
			redirect('inspections/create','refresh');
		}

		$this->form_validation->set_rules('patient_id', 'pasien', 'trim|required', messageError());
		$this->form_validation->set_rules('code', 'kode pemeriksaan', 'trim', messageError());
		$this->form_validation->set_rules('symptom', 'gejala/keluhan', 'trim|required', messageError());
		$this->form_validation->set_rules('diagnosis', 'diagnosa', 'trim', messageError());
		$this->form_validation->set_rules('cost', 'biaya pemeriksaan', 'trim|numeric|required', messageError());
		$this->form_validation->set_error_delimiters('<small class="text-danger"> <i class="fa fa-exclamation-circle"></i> ', '</small>');
		// var_dump($this->form_validation->run());die;
		if ($this->form_validation->run()) {
			$request['status'] = "Menunggu Pemeriksaan Dokter"; 
			$request['created_by'] = user()->id; 
			Inspection::insert($request);

			success('Berhasil menambahkan data pemeriksaan');
			redirect(base_url('inspections'));
		} else {
			$error = getErrorValidation();
			$this->session->set_flashdata('error', $error);
			redirect(base_url('inspections/create'));
		}
	}

	function process($id)
	{
		if (!cekAccess($this->uri->segment(1), 'process')) {
			danger('Anda tidak memiliki akses');
			redirect('dashboard','refresh');
		}
		$inspections = Inspection::with(['patient', 'recipe.transaction'])->find(encrypt_decrypt('decrypt', $id));
		if (!$inspections) {
			danger('Data pemeriksaan tidak ditemukan');
			redirect('inspections/create','refresh');
		}
		$types 	= Medicine::groupBy('type')->orderBy('type', 'asc')->get(['type']);


		$medicines = [];
		$type = '';
		foreach ($types as $key => $value) {
			$medicines[$value->type] =  Medicine::where('type', $value->type)->orderBy('type', 'asc')->get();
		}

		// $treathment = Treathment::with(['children'])->where('parent_id', null)->get();
		// $treathments = [];
		// $medicine = [];
		// foreach ($treathment as $key => $value) {
		// 	if ($value->medicine_query) {
		// 		$treathments[$value->id] = $value; 
		// 		$medicine[$value->id]['medicine'] = $this->db->query("$value->medicine_query")->result(); 
		// 	}else{
		// 		$treathments[$value->id] = $value; 
		// 	}
		// }

		$data = [
			'title' 		=> 'Data Pemeriksaan',
			'breadcrumb' 	=> 'Proses Data Pemeriksaan',
			'patients'		=> Patient::get(),
			// 'treathments'	=> $treathments,
			'medicines'		=> $medicines,
			'inspections' 	=> $inspections
		];
		$this->template->load('templates/cms','cms/inspections/process', $data,FALSE);
	}

	function store_process($id)
	{
		if (!cekAccess($this->uri->segment(1), 'process')) {
			danger('Anda tidak memiliki akses');
			redirect('dashboard','refresh');
		}
		$request = $this->input->post();
		$inspections = Inspection::with(['patient'])->find(encrypt_decrypt('decrypt', $id));
		if (!$inspections) {
			danger('Data pemeriksaan tidak ditemukan');
			redirect('inspections/create','refresh');
		}

		$receipt = [];
		$treathment = [];

		$total = 0;
				// var_dump($request);die;
		foreach ($request['price'] as $key => $value) {
			if (isset($request['treatment'][$key])) {
				$receipt[] = [
					'name' => $request['treatment'][$key],
					'qty'  => $request['qty'][$key],
					'price'=> $value
				];

				$total += $request['qty'][$key] * $value;

				$treathment[] = $request['treatment'][$key]; 

				$transaction = new MedicineTransaction;
				$transaction->medicine_id = $request['medic'][$key];
				$transaction->qty = $request['qty'][$key];
				$transaction->price = $request['price'][$key];
				$transaction->created_by = user()->id;
				$transaction->save();

			}
		}

		$request['treatment'] = json_encode($treathment);

		$lastRecord = Recipe::whereYear('created_at', date('Y'))->latest()->first();
		$lastNum 	= $lastRecord ? $lastRecord->code : 0 ;
		$strCode 	= "RSP".date("y");


		$recipe = new Recipe;
		$recipe->inspection_id = encrypt_decrypt('decrypt', $id);
		$recipe->code = generateCode($lastNum, $strCode, 4);
		$recipe->recipe = json_encode($receipt);
		$recipe->total = $total;
		$recipe->created_by = user()->doctor->id;
		$recipe->save();

		unset($request['price']);
		unset($request['qty']);
		// unset($request['treatment']);
		// var_dump($request);die;
		$request['doctor_id'] = Doctor::where('user_id', user()->id)->first()->id;
		$request['status'] = "Telah mendapatkan resep";
		$inspections->update($request);
		success('Berhasil memproses data pemeriksaan');
		redirect(base_url('inspections'));
	}

	function edit($id)
	{
		if (!cekAccess($this->uri->segment(1), 'process')) {
			danger('Anda tidak memiliki akses');
			redirect('dashboard','refresh');
		}
		$inspections = Inspection::with(['patient', 'recipe.transaction'])->find(encrypt_decrypt('decrypt', $id));
		if (!$inspections) {
			danger('Data pemeriksaan tidak ditemukan');
			redirect('inspections','refresh');
		}

		$types 	= Medicine::groupBy('type')->orderBy('type', 'asc')->get(['type']);


		$medicines = [];
		$type = '';
		foreach ($types as $key => $value) {
			$medicines[$value->type] =  Medicine::where('type', $value->type)->orderBy('type', 'asc')->get();
		}
		// var_dump($medicines);die;

		$data = [
			'title' 		=> 'Data Pemeriksaan',
			'breadcrumb' 	=> 'Ubah Data Pemeriksaan',
			'patients'		=> Patient::get(),
			// 'treathments'	=> $treathments,
			'medicines'		=> $medicines,
			'inspections' 	=> $inspections
		];
		$this->template->load('templates/cms','cms/inspections/edit', $data,FALSE);
	}


	function update_process($id)
	{
		if (!cekAccess($this->uri->segment(1), 'update')) {
			danger('Anda tidak memiliki akses');
			redirect('dashboard','refresh');
		}
		$request = $this->input->post();
		$inspections = Inspection::with(['patient'])->find(encrypt_decrypt('decrypt', $id));
		if (!$inspections) {
			danger('Data pemeriksaan tidak ditemukan');
			redirect('inspections/create','refresh');
		}

		if ($inspections->status == 'Menunggu Pemeriksaan Dokter') {
			$this->update($id);
		}else{
			$this->process_update($id);
		}

		success('Berhasil memproses data pemeriksaan');
		redirect(base_url('inspections'));
	}

	private function update($id)
	{

		$inspections = Inspection::with(['patient'])->find(encrypt_decrypt('decrypt', $id));
		if (!$inspections) {
			danger('Data pemeriksaan tidak ditemukan');
			redirect('inspections/create','refresh');
		}

		$request = $this->input->post();
		// var_dump($request);die;
		if (!$request) {
			danger('Data pemeriksaan tidak ditemukan');
			redirect('inspections/create','refresh');
		}

		$this->form_validation->set_rules('patient_id', 'pasien', 'trim|required', messageError());
		$this->form_validation->set_rules('code', 'kode pemeriksaan', 'trim', messageError());
		$this->form_validation->set_rules('symptom', 'gejala/keluhan', 'trim|required', messageError());
		$this->form_validation->set_rules('diagnosis', 'diagnosa', 'trim', messageError());
		$this->form_validation->set_rules('cost', 'biaya pemeriksaan', 'trim|numeric|required', messageError());
		$this->form_validation->set_error_delimiters('<small class="text-danger"> <i class="fa fa-exclamation-circle"></i> ', '</small>');
		// var_dump($this->form_validation->run());die;
		if ($this->form_validation->run()) {
			$request['status'] = "Menunggu Pemeriksaan Dokter"; 
			$request['created_by'] = user()->id; 
			$inspections->update($request);

			success('Berhasil menambahkan data pemeriksaan');
			redirect(base_url('inspections'));
		} else {
			$error = getErrorValidation();
			$this->session->set_flashdata('error', $error);
			redirect(base_url('inspections/create'));
		}
	}

	private function process_update($id)
	{
		$inspections = Inspection::with(['patient', 'recipe.transaction'])->find(encrypt_decrypt('decrypt', $id));
		// var_dump($inspections->toArray());die;
		if (!$inspections) {
			danger('Data pemeriksaan tidak ditemukan');
			redirect('inspections/create','refresh');
		}

		$request = $this->input->post();
		// var_dump($request);die;
		if (!$request) {
			danger('Data pemeriksaan tidak ditemukan');
			redirect('inspections/create','refresh');
		}

		$receipt = [];
		$treathment = [];

		$total = 0;
				// var_dump($request);die;
		foreach ($request['price'] as $key => $value) {
			if (isset($request['treatment'][$key])) {
				$receipt[] = [
					'name' => $request['treatment'][$key],
					'qty'  => $request['qty'][$key],
					'price'=> $value
				];

				$total += $request['qty'][$key] * $value;

				$treathment[] = $request['treatment'][$key]; 


				$transaction = MedicineTransaction::where('medicine_id',$request['medic'][$key])->where('created_at', $inspections->recipe->created_at)->first();
				if (!$transaction) {
					$transaction = new MedicineTransaction;
				}
				$transaction->medicine_id = $request['medic'][$key];
				$transaction->qty = $request['qty'][$key];
				$transaction->price = $request['price'][$key];
				$transaction->created_by = user()->id;
				$transaction->created_at = $inspections->recipe->created_at;
				$transaction->save();

			}else{
				$recipesold = MedicineTransaction::where('medicine_id', $request['medic'][$key])->where('created_at', $inspections->recipe->created_at)->first();
				if ($recipesold) {
					$recipesold->delete();
				}
			}
		}

		$request['treatment'] = json_encode($treathment);

		$lastRecord = Recipe::whereYear('created_at', date('Y'))->latest()->first();
		$lastNum 	= $lastRecord ? $lastRecord->code : 0 ;
		$strCode 	= "RSP".date("y");


		$recipe = Recipe::where('inspection_id', encrypt_decrypt('decrypt', $id))->first();
		$recipe->inspection_id = encrypt_decrypt('decrypt', $id);
		// $recipe->code = generateCode($lastNum, $strCode, 4);
		$recipe->recipe = json_encode($receipt);
		$recipe->total = $total;
		$recipe->created_by = user()->doctor->id;
		$recipe->save();

		unset($request['price']);
		unset($request['qty']);
		// unset($request['treatment']);
		// var_dump($request);die;
		$request['doctor_id'] = Doctor::where('user_id', user()->id)->first()->id;
		$request['status'] = "Telah mendapatkan resep";
		$inspections->update($request);
	}


	function destroy($id){
		if (!cekAccess($this->uri->segment(1), 'delete')) {
			danger('Anda tidak memiliki akses');
			redirect('dashboard','refresh');
		}
		$id = encrypt_decrypt('decrypt', $id);
		$inspections = Inspection::with(['recipe.transaction'])->find($id);
		if (!$inspections) {

			danger('Data pemeriksaan tidak ditemukan');
			redirect(base_url('inspections'),'refresh');
		}

		if ($inspections->recipe) {
			Recipe::find($inspections->recipe->id)->delete();
			MedicineTransaction::where('created_at', $inspections->recipe->created_at)->delete();
		}

		$inspections->delete();

		success('Berhasil menghapus data pemeriksaan');
		redirect(base_url('inspections'),'refresh');
	}
}

/* End of file Inspections.php */
/* Location: ./application/controllers/Inspections.php */ ?>