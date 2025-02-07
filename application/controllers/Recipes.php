<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Recipes extends CI_Controller {

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
		$recipes = Recipe::with(['doctor', 'inspection'])->get();
		// var_dump($recipes->toArray());die;
		$data = [
			'title' 		=> 'Data Resep Obat',
			'breadcrumb' 	=> 'List Data Resep Obat',
			'recipes' 	=> $recipes
		];
		$this->template->load('templates/cms','cms/recipes/index', $data,FALSE);
	}

	function print($id)
	{
		if (!cekAccess($this->uri->segment(1), 'print')) {
			danger('Anda tidak memiliki akses');
			redirect('dashboard','refresh');
		}

		$idD = encrypt_decrypt('decrypt', $id);
		$recipes = Recipe::with(['inspection', 'transaction', 'doctor'])->find($idD);

		if (!$recipes) {
			danger('Data resep tidak ditemukan');
			redirect(base_url('recipes'),'refresh');
		}

		$data = [
			'title' 		=> 'Data Resep Obat',
			'breadcrumb' 	=> "Detail Resep Obat $recipes->code",
			'recipes' 	=> $recipes
		];
		$this->template->load('templates/cms','cms/recipes/show', $data,FALSE);
	}

	function process($id)
	{
		if (!cekAccess($this->uri->segment(1), 'process')) {
			danger('Anda tidak memiliki akses');
			redirect('dashboard','refresh');
		}

		$request = $this->input->post();

		$recipes = Recipe::with(['transaction','doctor', 'inspection'])->find(encrypt_decrypt('decrypt',$id));
		if (!$recipes) {
			danger('Data resep tidak ditemukan');
			redirect(base_url('recipes'),'refresh');
		}

		if ($request && $recipes->status != 'Selesai') {
			foreach ($recipes->transaction as $key => $value) {

				$medic = Medicine::find($value->medicine->id);
				$medic->stock = $medic->stock - $value->qty;
				$medic->save();

			}
			$inspection = Inspection::find($recipes->inspection_id);
			$inspection->status = 'Selesai';
			$inspection->save();

			if (user()->apoteker) {
				$recipes->apoteker_id = user()->apoteker->id;
			}
			$recipes->status = 'selesai';
			$recipes->save();
		}

		$data = [
			'title' 		=> 'Resep',
			'breadcrumb' 	=> 'Proses Resep '.$recipes->code,
			'recipes' 	=> $recipes,
		];

		$this->template->load('templates/cms','cms/recipes/process', $data,FALSE);
	}

}

/* End of file Recipes.php */
/* Location: ./application/controllers/Recipes.php */ ?>