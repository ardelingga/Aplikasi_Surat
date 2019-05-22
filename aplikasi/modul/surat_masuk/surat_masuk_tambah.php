<?php
if (!defined('nsi')) { exit(); }

$form_error = array();
if(isset($_POST['submit'])) {
	if(trim($_POST['no_agenda']) == '') {
		$form_error[] = 'Nomor Agenda diisi';
	}
	if(trim($_POST['no_surat']) == '') {
		$form_error[] = 'Nomor Surat harus diisi';
	}
	if(trim($_POST['tgl_surat']) == '') {
		$form_error[] = 'Tanggal Surat harus diisi';
	}
	if(trim($_POST['jenis_surat']) == '') {
		$form_error[] = 'Jenis Surat harus diisi';
	}
	if(trim($_POST['dari']) == '') {
		$form_error[] = 'Dari harus diisi';
	}
	if(trim($_POST['kepada']) == '') {
		$form_error[] = 'Kepada harus diisi';
	}
	if(trim($_POST['perihal']) == '') {
		$form_error[] = 'Perihal harus diisi';
	}
	if(trim($_POST['petugas_penerima']) == '') {
		$form_error[] = 'Petugas Penerima harus diisi';
	}

	if(empty($form_error)) {
		// insert db
		$data = array(
			'no_agenda' 			=> $_POST['no_agenda'],
			'no_surat' 				=> $_POST['no_surat'],
			'tgl_surat' 			=> $_POST['tgl_surat'],
			'jenis_surat' 			=> $_POST['jenis_surat'],
			'dari' 					=> $_POST['dari'],
			'kepada' 				=> $_POST['kepada'],
			'perihal' 				=> $_POST['perihal'],
			'petugas_penerima' 		=> $_POST['petugas_penerima']
			);
		$insert = $db->tambah('tbl_surat_masuk', $data);
		if($insert > 0) {
			set_notif('simpan_ok', 1);
			redirect('?m=surat_masuk');
		} else {
			$form_error[] = 'Tidak dapat disimpan dalam database';
		}
	}
}

$sql_petugas_penerima = "SELECT id, nama_petugas FROM tbl_petugas ORDER BY nama_petugas";
$tbl_petugas = $db->select($sql_petugas_penerima);

set_web('judul', 'Tambah Data surat_masuk');
load_script('select2');
load_script('datepicker');
view_layout('v_atas.php');

?>

<div class="row">
	<div class="col-md-12">
		<div class="box box-success">
			<div class="box-header with-border" align="center">
				<h3 class="box-title" style=""><b>Tambah Data Surat Masuk</b></h3>
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
						<label for="no_agenda">No Agenda</label>
						<input type="text" placeholder="Masukan No Agenda" id="no_agenda" name="no_agenda" class="form-control">
					</div>

					<div class="form-group">
						<label for="no_surat">No Surat</label>
						<input type="text" placeholder="Masukan No Surat" id="no_surat" name="no_surat" class="form-control">
					</div>

					<div class="form-group">
						<label> Tanggal Surat </label>
						<div class="input-group">
							<div class="input-group-addon">
								<i class="fa fa-calendar"></i>
							</div>

							<input type="text" placeholder="Masukan Tanggal Surat" id="tgl_surat" name="tgl_surat" class="form-control datepicker">
						</div>
					</div>

					<div class="form-group">
						<label>Jenis Surat</label>
						<br />
						<select id="jenis_surat" name="jenis_surat" class="form-control select2" style="width: 200px;">
							<option value="Surat Resmi">Surat Resmi</option>
							<option value="Surat Dinas">Surat Dinas</option>
							<option value="Surat Niaga">Surat Niaga</option>
						</select>
					</div>

					<div class="form-group">
						<label for="dari">Dari</label>
						<input type="text" placeholder="Masukan Dari" id="dari" name="dari" class="form-control">
					</div>

					<div class="form-group">
						<label for="kepada">Kepada</label>
						<input type="text" placeholder="Masukan Kepada" id="kepada" name="kepada" class="form-control">
					</div>

					<div class="form-group">
						<label for="perihal">Perihal</label>
						<input type="text" placeholder="Masukan Perihal" id="perihal" name="perihal" class="form-control">
					</div>

					<div class="form-group">
						<label for="petugas_penerima"> Petugas Penerima </label>
						<br>

						<select id="petugas_penerima" name="petugas_penerima" class="form-control select2" style="width : 250px;">
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
					<a href="<?php echo site_url('?m=surat_masuk');?>" class="btn btn-warning btn-sm pull-right"> <i class="fa fa-angle-double-left"></i> Kembali </a>
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