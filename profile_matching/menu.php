<?php
$page = isset($_GET['page']) ? $_GET['page'] : "";
?>
<li <?php if($page=="") echo 'class="active"'; ?>><a href="./"><i class="fa fa-circle"></i> <span>Home</span></a></li>
<li <?php if($page=="jenis" || $page=="update_jenis") echo 'class="active"'; ?>><a href="?page=jenis"><i class="fa fa-circle"></i> <span>Jenis Kriteria</span></a></li>
<li <?php if($page=="selisih" || $page=="update_selisih") echo 'class="active"'; ?>><a href="?page=selisih"><i class="fa fa-circle"></i> <span>Selisih</span></a></li>
<li <?php if($page=="kriteria" || $page=="update_kriteria" || $page=="subkriteria" || $page=="update_subkriteria") echo 'class="active"'; ?>><a href="?page=kriteria"><i class="fa fa-circle"></i> <span>Kriteria</span></a></li>
<li <?php if($page=="alternatif" || $page=="update_alternatif" || $page=="lihat_alternatif") echo 'class="active"'; ?>><a href="?page=alternatif"><i class="fa fa-circle"></i> <span>Alternatif</span></a></li>
<li <?php if($page=="penilaian") echo 'class="active"'; ?>><a href="?page=penilaian"><i class="fa fa-circle"></i> <span>Penilaian</span></a></li>
<li <?php if($page=="admin" || $page=="update_admin") echo 'class="active"'; ?>><a href="?page=admin"><i class="fa fa-circle"></i> <span>Admin</span></a></li>
<li><a href="logout.php"><i class="fa fa-sign-out"></i> <span>Logout</span></a></li>