<?php
if (!defined('nsi')) { exit(); }

$id = $_GET['id'];

$query = "SELECT * FROM `data_pengguna` WHERE `id` = '".$id."' ";
$row = $db->select_one($query);
if(!$row) {
	set_notif('data_tidak_ada', 1);
	redirect('?m=pengguna');
}

$form_error = array();
if(isset($_POST['submit'])) {
	$data_arr = array();
	if(trim($_POST['nama']) == '') {
		$form_error[] = 'Nama harus diisi';
	}
	if(trim($_POST['uname']) == '') {
		$form_error[] = 'Username harus diisi';
	}

	if(empty($form_error)) {
		// update db
		$data = array(
			'nama' 		=> $_POST['nama'],
			'uname' 		=> $_POST['uname'],
			'level' 		=> $_POST['level'],
			'aktif' 		=> $_POST['aktif']
			);
		if(trim($_POST['upass']) != '') {
			$data['upass']	= md5($_POST['upass']);
		}

		$where = array('id' => $id);
		$update = $db->ubah('data_pengguna', $data, $where);
		if($update) {
			set_notif('ubah_ok', 1);
			redirect('?m=pengguna');
		} else {
			$form_error[] = 'Tidak dapat disimpan dalam database';
		}
	}
}

$web['judul'] = 'Ubah Data Pengguna';
load_script('select2');
view_layout('v_atas.php');

?>

<div class="row">
	<div class="col-md-">
		<div class="box box-success">
			<div class="box-header with-border" align="center">
				<h3 class="box-title" style=""><b>Ubah Data Pengguna</b></h3>
				<div class="box-tools pull-right">
					<button data-widget ="collapse" class="btn btn-box-tool"><i class="fa fa-minus"></i></button>
				</div><!-- /.box-tools -->
			</div><!-- /.box-header -->

			<form method="POST">
				<div class="box-body">
					<?php if($form_error) { ?>
					<div id="alert-simpan" class="alert alert-danger alert-dismissable fade in">
						<button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
						<h4><i class="fa fa-warning"></i> Error, Data tidak dapat disimpan.</h4>
						<?php 
						foreach ($form_error as $val) {
							echo '<p>'.$val.'</p>';
						} 
						?>
					</div>					
					<?php } ?>


					<div class="form-group">
						<label for="nama">Nama</label>
						<input type="text" placeholder="Masukkan Nama" id="nama" name="nama" class="form-control" value="<?php echo $row->nama; ?>">
					</div>

					<div class="form-group">
						<label for="uname">Username</label>
						<input type="text" placeholder="Masukkan Username" id="uname" name="uname" class="form-control" value="<?php echo $row->uname; ?>">
					</div>

					<div class="form-group">
						<label for="upass">Password</label>
						<input type="password" placeholder="" id="upass" name="upass" class="form-control">
						<p class="help-block">Kosongkan jika tidak ingin ubah password.</p>
					</div>

					<div class="form-group">
						<label>Level</label>
						<br />
						<select id="level" name="level" class="form-control select2" style="width: 100px;">
							<option value="operator" <?php echo $row->level == 'operator' ? 'selected="selected"' : ''; ?>>Operator</option>
							<option value="admin"	 <?php echo $row->level == 'admin' ? 'selected="selected"' : ''; ?>>Admin</option>
						</select>
					</div>

					<div class="form-group">
						<label>Aktif</label>
						<br />
						<select id="aktif" name="aktif" class="form-control select2" style="width: 70px;">
							<option value="Y" <?php echo $row->aktif == 'Y' ? 'selected="selected"' : ''; ?>>Ya</option>
							<option value="T" <?php echo $row->aktif == 'T' ? 'selected="selected"' : ''; ?>>Tidak</option>
						</select>
					</div>


				</div><!-- /.box-body -->
				<div class="box-footer">
					<button type="submit" name="submit" class="btn btn-primary btn-sm"> <i class="fa fa-save"></i> Ubah </button>
					<a href="<?php echo site_url('?m=pengguna');?>" class="btn btn-warning btn-sm pull-right"> <i class="fa fa-angle-double-left"></i> Kembali </a>
				</div>
			</form>

		</div><!-- /.box -->
	</div>
</div>



<?php view_layout('v_bawah1.php'); ?>

<script type="text/javascript">
	$(function() {
		$('#nama').focus();
		$('.select2').select2();
	});
</script>
<?php
view_layout('v_bawah2.php');