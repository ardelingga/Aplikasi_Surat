<?php
if (!defined('nsi')) { exit(); }


function cek_login() {
	if(isset($_SESSION['uname'])) {
		return true;
	} else {
		redirect('?m=login');
	}
}

function cek_level($level) {
	$akses = false;
	if(isset($_SESSION['level'])) {
		$level_arr = explode(',', $level);
		foreach ($level_arr as $level_val) {
			if($_SESSION['level'] == trim($level_val)) {
				$akses = true;
			}
		}
	}
	return $akses;
}

function set_notif($name, $text) {
	$_SESSION['notif_'.$name] = $text;	
}

function get_notif($name) {
	if(isset($_SESSION['notif_'.$name])) {
		$notif = $_SESSION['notif_'.$name];
		unset($_SESSION['notif_'.$name]);
		return $notif;
	} else {
		return false;
	}
}

function redirect($url) {
	header('Location: '. BASE_URL . '/' . $url);
	exit();
}

function site_url($url) {
	return BASE_URL . '/' . $url;
}

function view_layout($file) {
	global $web;
	require LAY_DIR . '/' . $file;
}

function set_web($item, $val = '') {
	global $web;
	if($item == 'judul') {
		$web[$item] = $val.' - '.$web['nama_aplikasi'];
	} else {
		$web[$item] = $val;
	}

}

function human2byte($val) {
	$number=substr($val,0,-2);
	switch(strtoupper(substr($val,-2))) {
		case "KB":
			return $number*1024;
		case "MB":
			return $number*pow(1024,2);
		case "GB":
			return $number*pow(1024,3);
		case "TB":
			return $number*pow(1024,4);
		case "PB":
			return $number*pow(1024,5);
		default:
			return $val;
	}
}

function byte2human($val) {
	$mod = 1024;
	$units = explode(' ','B KB MB GB TB PB');
	for ($i = 0; $val >= $mod; $i++) {
		$val /= $mod;
	}
	return round($val, 2) . ' ' . $units[$i];
}

function get_img_avatar($uname = false) {
	if($uname) {
		$filename = $uname;
	} else {
		$filename = $_SESSION['uname'];
	}
	$cek_file = ROOT_DIR . '/uploads/users/'.$filename.'.jpg';
	if(file_exists($cek_file)) {
		return BASE_URL . '/uploads/users/'.$filename.'.jpg';
	} else {
		return BASE_URL . '/assets/dist/img/avatar04.png';
	}
}

// fungsi untuk mengubah tanggal menjadi format bahasa indonesia, contoh: 14 Mar 2014 
function tgl_indo_pot($tgl){
  $tanggal = substr($tgl,8,2);
  $bulan   = ambil_bulan(substr($tgl,5,2)); // konversi menjadi nama bulan bahasa indonesia
  $tahun   = substr($tgl,0,4);
  return $tanggal.'-'.$bulan.'-'.$tahun;     
} 

// fungsi untuk mengubah angka bulan menjadi nama bulan 3 huruf
function ambil_bulan($bln){
  if ($bln=="01") return "Jan";
  elseif ($bln=="02") return "Feb";
  elseif ($bln=="03") return "Mar";
  elseif ($bln=="04") return "Apr";
  elseif ($bln=="05") return "Mei";
  elseif ($bln=="06") return "Jun";
  elseif ($bln=="07") return "Jul";
  elseif ($bln=="08") return "Agt";
  elseif ($bln=="09") return "Sep";
  elseif ($bln=="10") return "Okt";
  elseif ($bln=="11") return "Nop";
  elseif ($bln=="12") return "Des";
} 

// fungsi untuk mengubah angka bulan menjadi nama bulan
function ambilbulan($bln){
  if ($bln=="01") return "Januari";
  elseif ($bln=="02") return "Februari";
  elseif ($bln=="03") return "Maret";
  elseif ($bln=="04") return "April";
  elseif ($bln=="05") return "Mei";
  elseif ($bln=="06") return "Juni";
  elseif ($bln=="07") return "Juli";
  elseif ($bln=="08") return "Agustus";
  elseif ($bln=="09") return "September";
  elseif ($bln=="10") return "Oktober";
  elseif ($bln=="11") return "November";
  elseif ($bln=="12") return "Desember";
} 

// fungsi untuk mengubah tanggal menjadi format bahasa indonesia, contoh: 14 Maret 2014 
function tgl_indo($tgl){
	$tanggal = substr($tgl,8,2);
	$bulan   = ambilbulan(substr($tgl,5,2)); // konversi menjadi nama bulan bahasa indonesia
	$tahun   = substr($tgl,0,4);
	return $tanggal.' '.$bulan.' '.$tahun;		 
}

function load_script($item) {
	global $web;
	switch ($item) {
		case 'table':
			$web['style_css'][] = 'nsi/bootstrap-table-1.10.1/bootstrap-table.min.css';

			$web['script_js'][] = 'nsi/bootstrap-table-1.10.1/bootstrap-table.min.js';
			$web['script_js'][] = 'nsi/bootstrap-table-1.10.1/bootstrap-table-id-ID.js';
			break;
		case 'modal':
			$web['style_css2'][] = 'nsi/bootstrap-modal-2.2.6/css/bootstrap-modal.css';
			$web['style_css2'][] = 'nsi/bootstrap-modal-2.2.6/css/bootstrap-modal-bs3patch.css';

			$web['script_js'][] = 'nsi/bootstrap-modal-2.2.6/js/bootstrap-modalmanager.js';
			$web['script_js'][] = 'nsi/bootstrap-modal-2.2.6/js/bootstrap-modal.js';
			break;
		case 'select2':
			$web['style_css'][] = 'plugins/select2/select2.min.css';
			$web['script_js'][] = 'plugins/select2/select2.full.min.js';
			break;
		case 'timepicker':
			$web['style_css'][] = 'plugins/timepicker/bootstrap-timepicker.min.css';
			$web['script_js'][] = 'plugins/timepicker/bootstrap-timepicker.min.js';
			break;
		case 'datepicker':
			$web['style_css'][] = 'plugins/datepicker/datepicker3.css';
			$web['script_js'][] = 'plugins/datepicker/bootstrap-datepicker.js';
			$web['script_js'][] = 'plugins/datepicker/locales/bootstrap-datepicker.id.js';
			break;


		default:
			break;
	}
}