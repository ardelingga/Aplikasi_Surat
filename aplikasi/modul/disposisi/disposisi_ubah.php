<?php
if (!defined('nsi')) { exit(); }

$id = $_GET['id'];

$query = "SELECT * FROM `tbl_disposisi` WHERE `id` = '".$id."' ";
$row = $db->select_one($query);
if(!$row) {
	set_notif('data_tidak_ada', 1);
	redirect('?m=disposisi');
}

$form_error = array();
if(isset($_POST['submit'])) {
	$data_arr = array();
	if(trim($_POST['no_disposisi']) == '') {
		$form_error[] = 'No Disposisi harus diisi';
	}
	if(trim($_POST['tgl_disposisi']) == '') {
		$form_error[] = 'Tanggal Disposisi harus diisi';
	}
	if(trim($_POST['no_agenda']) == '') {
		$form_error[] = 'No Agenda harus diisi';
	}
	if(trim($_POST['perihal']) == '') {
		$form_error[] = 'Perihal harus diisi';
	}
	if(trim($_POST['asal_surat']) == '') {
		$form_error[] = 'Asal Surat harus diisi';
	}
	if(trim($_POST['intruksi']) == '') {
		$form_error[] = 'Intruksi/Informasi harus diisi';
	}
	if(trim($_POST['diteruskan']) == '') {
		$form_error[] = 'Diteruskan harus diisi';
	}

	if(empty($form_error)) {
		// update db
		$data = array(
			'no_disposisi' 			=> $_POST['no_disposisi'],
			'tgl_disposisi' 		=> $_POST['tgl_disposisi'],
			'no_agenda' 			=> $_POST['no_agenda'],
			'perihal' 				=> $_POST['perihal'],
			'asal_surat' 			=> $_POST['asal_surat'],
			'intruksi' 				=> $_POST['intruksi'],
			'diteruskan' 			=> $_POST['diteruskan']
			);
		if(trim($_POST['upass']) != '') {
			$data['upass']	= md5($_POST['upass']);
		}

		$where = array('id' => $id);
		$update = $db->ubah('tbl_disposisi', $data, $where);
		if($update) {
			set_notif('ubah_ok', 1);
			redirect('?m=disposisi');
		} else {
			$form_error[] = 'Tidak dapat disimpan dalam database';
		}
	}
}

$web['judul'] = 'Ubah Data Disposisi';
load_script('select2');
load_script('datepicker');
view_layout('v_atas.php');


$sql_no_agenda = "SELECT id, no_agenda FROM tbl_surat_masuk ORDER BY no_agenda";
$tbl_surat_masuk = $db->select($sql_no_agenda);

$sql_diteruskan = "SELECT id, nama_petugas FROM tbl_petugas ORDER BY nama_petugas";
$tbl_petugas = $db->select($sql_diteruskan);
?>

<div class="row">
	<div class="col-md-12">
		<div class="box box-success">
			<div class="box-header with-border" align="center">
				<h3 class="box-title" style=""><b>Ubah Data Disposisi</b></h3>
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
						<label for="no_disposisi">No Disposisi</label>
						<input type="text" placeholder="Masukkan No Disposisi" id="no_disposisi" name="no_disposisi" class="form-control" value="<?php echo $row->no_disposisi; ?>">
					</div>

					<div class="form-group">
						<label> Tanggal Disposisi </label>
						<div class="input-group">
							<div class="input-group-addon">
								<i class="fa fa-calendar"></i>
							</div>

							<input type="text" placeholder="Masukan Tanggal Surat" id="tgl_disposisi" name="tgl_disposisi" class="form-control datepicker" value="<?php echo $row->tgl_disposisi; ?>">
						</div>
					</div>

					<div class="form-group">
						<label for="no_agenda"> Nomor Agenda </label>
						<br>
						<select id="no_agenda" name="no_agenda" class="form-control select2" value="<?php echo $row->no_agenda; ?>" style="width : 200px;">
							<option value=""> Silahkan Pilih</option>
							<?php
							$sql_no_agenda = "SELECT id, no_agenda FROM tbl_surat_masuk ORDER BY no_agenda";
							$tbl_surat_masuk = $db->select($sql_no_agenda);
							foreach ($tbl_surat_masuk as $val ) {
								if ($val->id == $row->no_agenda) {
									echo '<option value="'.$val->id.'" selected="selected">'.$val->no_agenda.'</option>';
								}else{
									echo '<option value="'.$val->id.'">'.$val->no_agenda.'</option>';
								}
							}
							?>
						</select>
					</div>

					<div class="form-group">
						<label for="perihal">Perihal</label>
						<input type="text" placeholder="Masukkan Perihal" id="perihal" name="perihal" class="form-control" value="<?php echo $row->perihal; ?>">
					</div>

					<div class="form-group">
						<label for="asal_surat">Asal Surat</label>
						<input type="text" placeholder="Masukkan Asal Surat" id="asal_surat" name="asal_surat" class="form-control" value="<?php echo $row->asal_surat; ?>">
					</div>

					<div class="form-group">
						<label for="intruksi">Intruksi/Informasi</label>
						<input type="text" placeholder="Masukkan Intruksi / Informasi" id="intruksi" name="intruksi" class="form-control" value="<?php echo $row->intruksi; ?>">
					</div>

					<div class="form-group">
						<label for="diteruskan"> Diteruskan Kepada </label>
						<br>

						<select id="diteruskan" name="diteruskan" class="form-control select2" value="<?php echo $row->diteruskan; ?>" style="width : 250px;">
							<option value=""> Silahkan Pilih</option>
							<?php
							$sql_diteruskan = "SELECT id, nama_petugas FROM tbl_petugas ORDER BY nama_petugas";
							$tbl_petugas = $db->select($sql_diteruskan);
							foreach ($tbl_petugas as $val ) {
								if ($val->id == $row->diteruskan) {
									echo '<option value="'.$val->id.'" selected="selected">'.$val->nama_petugas.'</option>';
								}else{
									echo '<option value="'.$val->id.'">'.$val->nama_petugas.'</option>';
								}
							}
							?>
						</select>
					</div>


				</div><!-- /.box-body -->
				<div class="box-footer">
					<button type="submit" name="submit" class="btn btn-primary btn-sm"> <i class="fa fa-save"></i> Ubah </button>
					<a href="<?php echo site_url('?m=disposisi');?>" class="btn btn-warning btn-sm pull-right"> <i class="fa fa-angle-double-left"></i> Kembali </a>
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
		$('.datepicker').datepicker({
			language:  'id',
			weekStart: 1,
			autoclose: true,
			format: "yyyy-mm-dd",
			todayHighlight: true,
			clearBtn : false,
			todayBtn: false
		}); 
	});
</script>
<?php
view_layout('v_bawah2.php');