<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Payment_reports extends CI_Controller {

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
		$report = Inspection::with('recipe')->where('status', 'selesai');
		if ($this->input->get()) {
			    if ($start) {
				    $report->where('date', '>=', "$start");
			    }
			    if ($end) {
				    $report->where('date', '<=', "$end");
			    }
		}
		$report->where('status', 'selesai');
	    $reports = $report->get();
		// var_dump($reports);die;
		$data = [
			'title' 		=> 'Laporan Pembayaran',
			'breadcrumb' 	=> 'List Laporan Pembayaran',
			'reports' 	=> $reports
		];
		$this->template->load('templates/cms','cms/reports/payment', $data,FALSE);
	}

}

/* End of file Payment_reports.php */
/* Location: ./application/controllers/Payment_reports.php */ ?>