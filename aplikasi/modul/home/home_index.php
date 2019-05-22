<?php
if (!defined('nsi')) { exit(); }

set_web('judul', 'Home');
view_layout('v_atas.php');

if(get_notif('level_ditolak')) {
	?>
	<div class="alert alert-danger alert-dismissible">
		<button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
		<h4><i class="icon fa fa-ban"></i> Akses ditolak!</h4>
		Anda tidak berhak.
	</div>
	<?php
}
//Tabel Petugas
$sql_petugas = "SELECT * FROM tbl_petugas";
$query_total = $db->query($sql_petugas);
$total_petugas = $query_total->num_rows();

//Tabel Surat Masuk
$sql_surat_masuk = "SELECT * FROM tbl_surat_masuk";
$query_total = $db->query($sql_surat_masuk);
$total_surat_masuk = $query_total->num_rows();

//Tabel Petugas
$sql_surat_keluar = "SELECT * FROM tbl_surat_keluar";
$query_total = $db->query($sql_surat_keluar);
$total_surat_keluar = $query_total->num_rows();

//Tabel Petugas
$sql_disposisi = "SELECT * FROM tbl_disposisi";
$query_total = $db->query($sql_disposisi);
$total_disposisi = $query_total->num_rows();

//Tabel Petugas
$sql_pengguna = "SELECT * FROM data_pengguna";
$query_total = $db->query($sql_pengguna);
$total_pengguna = $query_total->num_rows();

?>

<div class="row">
	<div class="col-md-4">
		<div class="small-box bg-aqua">
			<div class="inner">
				<h3><?php echo $total_petugas; ?></h3>

				<p>Petugas</p>
			</div>
			<div class="icon">
				<i class="fa fa-users"></i>
			</div>

			<a href="<?php echo site_url('?m=petugas');?>" class="small-box-footer">Informasi Lebih Lanjut <i class="fa fa-arrow-circle-right"></i></a>

		</div>

	</div>

	<div class="col-md-4">
		<div class="small-box bg-green">
			<div class="inner">
				<h3><?php echo $total_surat_masuk; ?></h3>

				<p>Surat Masuk</p>
			</div>
			<div class="icon">
				<i class="fa fa-envelope-o"></i>
			</div>
			<a href="<?php echo site_url('?m=surat_masuk');?>" class="small-box-footer">Informasi Lebih Lanjut <i class="fa fa-arrow-circle-right"></i></a>
		</div>

	</div>

	<div class="col-md-4">
		<div class="small-box bg-yellow">
			<div class="inner">
				<h3><?php echo $total_surat_keluar; ?></h3>

				<p>Surat Keluar</p>
			</div>
			<div class="icon">
				<i class="fa fa-paper-plane"></i>
			</div>
			<a href="<?php echo site_url('?m=surat_keluar');?>" class="small-box-footer">Informasi Lebih Lanjut <i class="fa fa-arrow-circle-right"></i></a>
		</div>

	</div>
	<div class="col-md-6">
		<div class="small-box bg-red">
			<div class="inner">
				<h3><?php echo $total_disposisi; ?></h3>

				<p>Disposisi</p>
			</div>
			<div class="icon">
				<i class="fa fa-file-text-o"></i>
			</div>
			<a href="<?php echo site_url('?m=disposisi');?>" class="small-box-footer">Informasi Lebih Lanjut <i class="fa fa-arrow-circle-right"></i></a>
		</div>

	</div>
	<div class="col-md-6">
		<div class="small-box bg-purple">
			<div class="inner">
				<h3><?php echo $total_pengguna; ?></h3>

				<p>Pengguna</p>
			</div>
			<div class="icon">
				<i class="fa fa-user"></i>
			</div>
			<a href="<?php echo site_url('?m=pengguna');?>" class="small-box-footer">Informasi Lebih Lanjut <i class="fa fa-arrow-circle-right"></i></a>
		</div>

	</div>



</div>

<?php


view_layout('v_bawah1.php');
view_layout('v_bawah2.php');