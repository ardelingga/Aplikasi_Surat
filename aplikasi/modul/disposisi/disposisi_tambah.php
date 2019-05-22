<?php
if (!defined('nsi')) { exit(); }

$form_error = array();
if(isset($_POST['submit'])) {
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
		// insert db
		$data = array(
				'no_disposisi' 			=> $_POST['no_disposisi'],
				'tgl_disposisi' 		=> $_POST['tgl_disposisi'],
				'no_agenda' 			=> $_POST['no_agenda'],
				'perihal' 				=> $_POST['perihal'],
				'asal_surat' 			=> $_POST['asal_surat'],
				'intruksi' 				=> $_POST['intruksi'],
				'diteruskan' 			=> $_POST['diteruskan']
			);
		$insert = $db->tambah('tbl_disposisi', $data);
		if($insert > 0) {
			set_notif('simpan_ok', 1);
			redirect('?m=disposisi');
		} else {
			$form_error[] = 'Tidak dapat disimpan dalam database';
		}
	}
}

set_web('judul', 'Tambah Data Disposisi');
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
				<h3 class="box-title" style=""><b>Tambah Data Disposisi</b></h3>
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
						<input type="text" placeholder="Masukkan No Disposisi" id="no_disposisi" name="no_disposisi" class="form-control">
					</div>

					<div class="form-group">
						<label> Tanggal Disposisi </label>
						<div class="input-group">
							<div class="input-group-addon">
								<i class="fa fa-calendar"></i>
							</div>

							<input type="text" placeholder="Masukan Tanggal Disposisi" id="tgl_disposisi" name="tgl_disposisi" class="form-control datepicker">
						</div>
					</div>

					<div class="form-group">
						<label for="no_agenda"> Nomor Agenda </label>
						<br>

						<select id="no_agenda" name="no_agenda" class="form-control select2" style="width : 200px;">
							<option value=""> Silahkan Pilih</option>
							<?php
							foreach ($tbl_surat_masuk as $row_no_agenda ) {
								echo '<option value="'.$row_no_agenda->id.'">'.$row_no_agenda->no_agenda.'</option>';
							}
							?>
						</select>
					</div>

					<div class="form-group">
						<label for="perihal">Perihal</label>
						<input type="text" placeholder="Masukkan Perihal" id="perihal" name="perihal" class="form-control">
					</div>

					<div class="form-group">
						<label for="asal_surat">Asal Surat</label>
						<input type="text" placeholder="Masukkan Asal Surat" id="asal_surat" name="asal_surat" class="form-control">
					</div>

					<div class="form-group">
						<label for="intruksi">Intruksi/Informasi</label>
						<input type="text" placeholder="Masukkan Intruksi / Informasi" id="intruksi" name="intruksi" class="form-control">
					</div>

					<div class="form-group">
						<label for="diteruskan"> Diteruskan Kepada </label>
						<br>

						<select id="diteruskan" name="diteruskan" class="form-control select2" style="width : 250px;">
							<option value=""> Silahkan Pilih</option>
							<?php
							foreach ($tbl_petugas as $row_nama_petugas ) {
								echo '<option value="'.$row_nama_petugas->id.'">'.$row_nama_petugas->nama_petugas.'</option>';
							}
							?>
						</select>
					</div>



				</div><!-- /.box-body -->
				<div class="box-footer">
					<button type="submit" name="submit" class="btn btn-primary btn-sm"> <i class="fa fa-save"></i> Tambah </button>
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