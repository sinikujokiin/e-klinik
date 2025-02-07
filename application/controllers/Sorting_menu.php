<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sorting_menu extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		// var_dump(isset(isLogin()['status']));die;
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
		$menu = Menu::with(['children' => function($query){
					$query->orderBy('sort', 'asc');
				}])
		->orderBy('sort', 'asc')
		->where('parent_id', null)->get();
		$data = [
			'title' => 'Urutan Menu',
			'breadcrumb' => 'Urutan Menu',
			'menu'  => $menu,
		];
		$this->template->load('templates/cms','cms/menu/sorting', $data,FALSE);
	}

	function store()
	{
		if (!cekAccess($this->uri->segment(1), 'update')) {
			danger('Anda tidak memiliki akses');
			redirect('dashboard','refresh');
		}
		$request = $this->input->post();

		$sort = 1;
		foreach ($request['data'] as $value) {
			$menu = Menu::find(encrypt_decrypt('decrypt', $value['id']));
			$menu->sort = $sort++;
			$menu->save();

			$sort1 = 1;
			if (isset($value['children'])) {
				foreach ($value['children'] as $value1) {
					$menu = Menu::find(encrypt_decrypt('decrypt', $value1['id']));
					$menu->sort = $sort1++;
					$menu->save();
				}
				
			}
		}

		echo json_encode(true);
	}

}

/* End of file Sorting_menu.php */
/* Location: ./application/controllers/Sorting_menu.php */ ?>