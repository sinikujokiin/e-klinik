<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

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

		$stockMin  = Medicine::whereColumn('stock', '<=', 'stock_min')->limit(5)->orderBy('stock', 'asc')->get();
		$lastOut   = MedicineTransaction::with('medicine')->limit(5)->get();	

		$patients = Patient::count();
		$doctors = Doctor::count();
		$apoteker = Pharmacist::count();
		$medicines = Medicine::count();
		$recipes = Recipe::count();
		$inspections = Inspection::count();

		$data = [
			'title' => 'Dashboard',
			'stockMin' => $stockMin,
			'lastOut' => $lastOut,
			'patients' => $patients,
			'doctors' => $doctors,
			'apoteker' => $apoteker,
			'medicines' => $medicines,
			'recipes' => $recipes,
			'inspections' => $inspections,
		];
		$this->template->load('templates/cms','cms/dashboard', $data,FALSE);
	}

}

/* End of file Dashboard.php */
/* Location: ./application/controllers/Dashboard.php */ ?>