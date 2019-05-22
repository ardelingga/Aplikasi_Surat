
<li <?php echo $web['modul'] == 'home' ? 'class="active"' : ''; ?>>
	<a href="<?php echo BASE_URL;?>/?m=home"><i class="fa fa-home"></i> <span>Home</span></a>
</li>
<li <?php echo $web['modul'] == 'petugas' ? 'class="active"' : ''; ?>>
	<a href="<?php echo BASE_URL;?>/?m=petugas"><i class="fa fa-users"></i> <span>Petugas</span></a>
</li>
<li <?php echo $web['modul'] == 'surat_masuk' ? 'class="active"' : ''; ?>>
	<a href="<?php echo BASE_URL;?>/?m=surat_masuk"><i class="fa fa-envelope-o"></i> <span>Surat Masuk</span></a>
</li>
<li <?php echo $web['modul'] == 'surat_keluar' ? 'class="active"' : ''; ?>>
	<a href="<?php echo BASE_URL;?>/?m=surat_keluar"><i class="fa fa-paper-plane"></i> <span>Surat Keluar</span></a>
</li>
<li <?php echo $web['modul'] == 'disposisi' ? 'class="active"' : ''; ?>>
	<a href="<?php echo BASE_URL;?>/?m=disposisi"><i class="fa fa-file-text"></i> <span>Disposisi</span></a>
</li>
<li <?php echo $web['modul'] == 'pengguna' ? 'class="active"' : ''; ?>>
	<a href="<?php echo BASE_URL;?>/?m=pengguna"><i class="fa fa-user"></i> <span>Pengguna</span></a>
</li>

 

<?php
$master_data_arr = array('pengguna', 'data_siswa', 'lainya');
if(in_array($web['modul'], $master_data_arr)) {
	$menu_master_data_active = 'active';
	$menu_master_data_open = 'menu-open';
} else {
	$menu_master_data_active = '';
	$menu_master_data_open = '';
}
?>

<!-- <li class="treeview <?php echo $menu_master_data_active;?>">
	<a href="#"><i class="fa fa-folder"></i> <span>Master Data</span> <i class="fa fa-angle-left pull-right"></i></a>
	<ul class="treeview-menu <?php echo $menu_master_data_open;?>">
		<li <?php echo $web['modul'] == 'data_siswa' ? 'class="active"' : ''; ?>>
			<a href="<?php echo BASE_URL;?>/?m=data_siswa"><i class="fa fa-user"></i> Data Siswa</a>
		</li>
		<li <?php echo $web['modul'] == 'pengguna' ? 'class="active"' : ''; ?>>
			<a href="<?php echo BASE_URL;?>/?m=pengguna"><i class="fa fa-user"></i> Pengguna</a>
		</li>
	</ul>
</li> -->