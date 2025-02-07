<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Medicine_reports extends CI_Controller {

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
		$start = $this->input->get('start');
		$end = $this->input->get('end');
		$report = MedicineTransaction::with('medicine');
		if ($this->input->get()) {
			    if ($start) {
				    $report->whereDate('created_at', '>=', "$start");
			    }
			    if ($end) {
				    $report->whereDate('created_at', '<=', "$end");
			    }
		}
	    $reports = $report->get();
		$data = [
			'title' 		=> 'Laporan Obat',
			'breadcrumb' 	=> 'List Laporan Obat',
			'reports' 	=> $reports
		];
		$this->template->load('templates/cms','cms/reports/medicine', $data,FALSE);
	}

}

/* End of file Medicine_reports.php */
/* Location: ./application/controllers/Medicine_reports.php */ ?>