<?php 
if (!function_exists('getMenu')) {
	function getMenu()
	{
		$role_id = user()->role_id;
		return Menu::with(['children' => function($query) use ($role_id){
			$query->select('menus.*', 'm.name as parent_name', 'm.id as id_parent');
			$query->join('menus as m', 'menus.parent_id', '=', 'm.id');
			$query->join('role_accesses', 'role_accesses.menu_id', '=', 'menus.id');
			$query->where('role_id', $role_id);
			$query->orderBy('sort', 'asc');
		}])
		->select('menus.*', 'role_accesses.menu_id', 'role_accesses.role_id')
		->join('role_accesses', 'role_accesses.menu_id', '=', 'menus.id')
		->where(['parent_id' => null, 'role_id' => $role_id])->orderBy('sort', 'asc')->get();
		// var_dump($menu->toArray());die;
	}
}

if (!function_exists('cekAccess')) {
	function cekAccess($url, $action)
	{
		$status = false;
		$role_id = user()->role_id;
		$cekMenu = Menu::select('menus.url', 'menus.id', 'role_accesses.*')->where(['url' =>  $url, 'role_id' => $role_id])->join('role_accesses', 'role_accesses.menu_id', '=', 'menus.id')->first();
		if ($cekMenu) {
			$akses = json_decode($cekMenu->access);
			if (is_int(array_search($action, $akses ? $akses : []))) {
				return true;
			}
		}
	}
}


if (!function_exists('getErrorValidation')) {
	function getErrorValidation()
	{
		$CI = &get_instance();

		$forms = $CI->input->post();
		// var_dump($forms);die;
		$response = [];
		foreach ($forms as $key => $value) {
			if ($key != 'id') {
				$response[$key] = form_error($key);
			}
		}
		return $response;
	}
}

if (!function_exists('encrypt_decrypt')) {
	function encrypt_decrypt($action, $msg) {

		$output = false;
	    $encrypt_method = "AES-256-CBC";
	    $secret_key = '38ba3aa33076bc617ca8b04a173e7f424930da18';
	    $secret_iv = 'e-apotek';
	    // hash
	    $key = hash('sha256', $secret_key);

	    // iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
	    $iv = substr(hash('sha256', $secret_iv), 0, 16);
	    if ($action == 'encrypt'){
	        $output = openssl_encrypt($msg, $encrypt_method, $key, 0, $iv);
	        $output = base64_encode($output);
	    } else if($action == 'decrypt') {
	        $output = openssl_decrypt(base64_decode($msg), $encrypt_method, $key, 0, $iv);
	    }
	    return $output;
	}

}

if (!function_exists('date_format_indo')) {
	function date_format_indo($date){
        if($date != '0000-00-00'){
            $date = explode('-', $date);
  
            $data = $date[2] . ' ' . month($date[1]) . ' '. $date[0];
        }else{
            $data = 'Format tanggal salah';
        }
  
        return $data;
    }
  
}


if (!function_exists('day')) {
	function day($day){
 
		switch($day){
			case 'Sun':
				$day = "Minggu";
			break;
	 
			case 'Mon':			
				$day = "Senin";
			break;
	 
			case 'Tue':
				$day = "Selasa";
			break;
	 
			case 'Wed':
				$day = "Rabu";
			break;
	 
			case 'Thu':
				$day = "Kamis";
			break;
	 
			case 'Fri':
				$day = "Jumat";
			break;
	 
			case 'Sat':
				$day = "Sabtu";
			break;
			
			default:
				$day = "Tidak di ketahui";		
			break;
		}
	 
		return $day;
	 
	}
}

if (!function_exists('month')) {
	function month($month) {
  
        switch ($month) {
            case 1:
                $month = "Januari";
                break;
            case 2:
                $month = "Februari";
                break;
            case 3:
                $month = "Maret";
                break;
            case 4:
                $month = "April";
                break;
            case 5:
                $month = "Mei";
                break;
            case 6:
                $month = "Juni";
                break;
            case 7:
                $month = "Juli";
                break;
            case 8:
                $month = "Agustus";
                break;
            case 9:
                $month = "September";
                break;
            case 10:
                $month = "Oktober";
                break;
            case 11:
                $month = "November";
                break;
            case 12:
                $month = "Desember";
                break;
        }
        return $month;
    }

}

if (!function_exists('covertToWebp')) {
    function covertToWebp($url = null, $file = null)
    {
    	$slug = explode(".", $file);
		$ext = $slug[1];
		if ($ext === 'jpg' || $ext === 'jpeg') {
		    $im = imagecreatefromjpeg($url.$file);
		    $output = $url.$slug[0].'.webp';
		    $webp = imagewebp($im, $output, 70);
		} elseif ($ext === 'png') {
		    $im = imagecreatefrompng($url.$file);
		    imagepalettetotruecolor($im);

		    imageAlphaBlending($im, true); // alpha channel
		    imageSaveAlpha($im, true); // save alpha setting

			$output = $url.$slug[0].'.webp';
		    $webp = imagewebp($im, $output);
		}
		unlink($url.$file);
		imagedestroy($im);

		return $slug[0].'.webp';
    }

}


if (!function_exists('messageError')) {
	function messageError()
	{
		$error =[
			'required' 			=> '%s tidak boleh kosong',
			// 'trim' => '%s tidak sesuai format',
			'numeric' 			=> '%s harus berisi angka',
			'valid_email' 		=> 'format %s tidak valid',
			'is_unique' 		=> '%s sudah terdaftar',
			'min_length' 		=> '%s minimal %s karakter',
			'max_length' 		=> '%s maksimal %s karakter',
			'exact_length' 		=> 'panjang %s harus %s karakter',
			'valid_ip' 			=> '%s tidak valid',
			'in_list'			=> '%s tidak termasuk dalam list',
			// 'alpha_special' 	=> '%s tidak sesuai format',
			'alpha_numeric' 	=> '%s hanya karakter dan angka',
			'alpha_numeric' 	=> '%s hanya karakter dan angka',
			'numeric_spaces' 	=> '%s hanya karakter, angka dan spasi',
			'alpha_dash' 		=> '%s hanya karakter, angka, spasi, underscores(_) dan strip(-)',
			'matches'			=> '%s tidak sesuai dengan %s'
		];

		return $error;
	}
}


if (!function_exists('user')) {
	function user()
	{
		$CI = &get_instance();
		$session = $CI->session->userdata('user_session');
		if ($session) {
			$sess_id = encrypt_decrypt("encrypt", 'id');
			$id = encrypt_decrypt('decrypt',$session[$sess_id]);

			$user = Account::with(['doctor', 'apoteker'])->find($id);

			return $user;
			exit();	
		}
	}
}

if (!function_exists('isLogin')) {
	function isLogin()
	{
		$CI = &get_instance();
		$url = $CI->uri->segment(1);
		$session = $CI->session->userdata('user_session');
		if ($session) {
			if (user()->token !== $session['session']) {
				return ['status' => false, 'msg' => 'Token anda tidak valid', 'redirect' => 'login'];
			}

			$role_id = user()->role_id;
			$cekMenu = Menu::join('role_accesses', 'role_accesses.menu_id', '=' ,'menus.id')->where(['url' => $url, 'role_id' => $role_id])->first();
			if ($cekMenu) {
				return TRUE;
			}else{
				return ['status' => false, 'msg' => 'Anda tidak memiliki akses', 'redirect' => '403'];
			}
		}else{
			return ['status' => false, 'msg' => 'Anda belum login, silahkan login terlebih dahulu', 'redirect' => 'login'];
		}
	}
}

if (!function_exists('success')) {
	function success($msg)
	{
		$CI = &get_instance();
		$CI->session->set_flashdata('alert', '
			<div class="alert alert-success d-flex align-items-center" role="alert">
			<i class="bi bi-check-circle"></i> 
			  <div class="ml-3">
			   '.$msg.'
			  </div>
			</div>
			');
		return $CI->session->userdata('alert');

	}
}
if (!function_exists('danger')) {
	function danger($msg)
	{
		$CI = &get_instance();
		$CI->session->set_flashdata('alert', '
			<div class="alert alert-danger d-flex align-items-center" role="alert">
			<i class="bi bi-exclamation-octagon-fill"></i>	 
			  <div class="ml-3">
			   '.$msg.'
			  </div>
			</div>
			');
		return $CI->session->userdata('alert');
	}
}
if (!function_exists('info')) {
	function info($msg)
	{
		$CI = &get_instance();
		$CI->session->set_flashdata('alert', '
			<div class="alert alert-info d-flex align-items-center" role="alert">
			<i class="bi bi-check-circle"></i> 
			  <div class="ml-3">
			   '.$msg.'
			  </div>
			</div>
			');
		return $CI->session->userdata('alert');
		
	}
}


if (!function_exists('web')) {
	function web()
	{
		return json_decode(file_get_contents('setting.json'));
	}
}
if (!function_exists('generateCode')) {
	function generateCode($lastNum, $key, $totalChar = 0)
    {

        $newNum = intval(substr($lastNum, strlen($key))) + 1;
        $newNumbers = str_pad($newNum, $totalChar, "0", STR_PAD_LEFT);
        $code = $key . $newNumbers;
        return $code;
    }
}




 ?>