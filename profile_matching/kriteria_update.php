<?php
$link_data='?page=kriteria';
$link_update='?page=update_kriteria';

$nama_kriteria='';
$combo_id_jenis='';
$combo_id_jenis.='<select class="form-control" name="id_jenis" id="id_jenis" required><option value="">Pilih...</option>';
$q="select * from jenis order by nama_jenis";
$q=mysqli_query($con,$q);
while($r=mysqli_fetch_array($q)){
	$combo_id_jenis.='<option value="'.$r['id_jenis'].'">'.$r['nama_jenis'].'</option>';
}
$combo_id_jenis.='</select>';

if(isset($_POST['save'])){
	$error='';
	$id=$_POST['id'];
	$action=$_POST['action'];
	$nama_kriteria=$_POST['nama_kriteria'];
	$id_jenis=$_POST['id_jenis'];

	if($action=='add'){
		if(mysqli_num_rows(mysqli_query($con,"select * from kriteria where nama_kriteria='".$nama_kriteria."'"))>0){
			$error='Nama Kriteria sudah ada';
		}else{
			$q="insert into kriteria(nama_kriteria,id_jenis) values ('".$nama_kriteria."','".$id_jenis."')";
			mysqli_query($con,$q);
			exit("<script>location.href='".$link_data."';</script>");
		}
	}
	if($action=='edit'){
		$q=mysqli_query($con,"select * from kriteria where id_kriteria='".$id."'");
		$r=mysqli_fetch_array($q);
		$nama_kriteria_tmp=$r['nama_kriteria'];
		if(mysqli_num_rows(mysqli_query($con,"select * from kriteria where nama_kriteria='".$nama_kriteria."' and nama_kriteria<>'".$nama_kriteria_tmp."'"))>0){
			$error='Nama Kriteria sudah ada';
		}else{
			$q="update kriteria set nama_kriteria='".$nama_kriteria."',id_jenis='".$id_jenis."' where id_kriteria='".$id."'";
			mysqli_query($con,$q);
			exit("<script>location.href='".$link_data."';</script>");
		}
	}
}else{
	if(empty($_GET['action'])){$action='add';}else{$action=$_GET['action'];}
	if($action=='edit'){
		$id=$_GET['id'];
		$q=mysqli_query($con,"select * from kriteria where id_kriteria='".$id."'");
		$r=mysqli_fetch_array($q);
		$nama_kriteria=$r['nama_kriteria'];
		$combo_id_jenis='';
		$combo_id_jenis.='<select class="form-control" name="id_jenis" id="id_jenis" required><option value="">Pilih...</option>';
		$qcmb="select * from jenis order by nama_jenis";
		$qcmb=mysqli_query($con,$qcmb);
		while($rcmb=mysqli_fetch_array($qcmb)){
			if($rcmb['id_jenis']==$r['id_jenis']) { $selected = "selected"; } else { $selected = ""; }
			$combo_id_jenis.='<option value="'.$rcmb['id_jenis'].'" '.$selected.'>'.$rcmb['nama_jenis'].'</option>';
		}
		$combo_id_jenis.='</select>';
	}
	if($action=='delete'){
		$id=$_GET['id'];
		mysqli_query($con,"delete from kriteria where id_kriteria='".$id."'");
		exit("<script>location.href='".$link_data."';</script>");
	}
}
?>
<div class="box box-default">
	<div class="box-header with-border">
		<h3 class="box-title">Data Kriteria</h3>
	</div>
	<form class="form-horizontal" action="<?php echo $link_update;?>" method="post" >
		<input name="id" type="hidden" value="<?php echo $id;?>">
		<input name="action" type="hidden" value="<?php echo $action;?>">
		<div class="box-body">
		<?php
			if(!empty($error)){
				echo '<div class="alert bg-danger" role="alert">'.$error.'</div>';
			}
		?>
			<div class="form-group">
				<label for="nama_kriteria" class="col-sm-2 control-label">Nama Kriteria</label>
				<div class="col-sm-4">
					<input name="nama_kriteria" id="nama_kriteria" class="form-control" required type="text" value="<?php echo $nama_kriteria;?>">
				</div>
			</div>
			<div class="form-group">
				<label for="id_jenis" class="col-sm-2 control-label">Jenis</label>
				<div class="col-sm-4">
					<?php echo $combo_id_jenis; ?>
				</div>
			</div>
		</div>
		<div class="box-footer">
			<div class="text-center col-sm-6">
				<button type="submit" name="save" class="btn btn-success">Simpan</button>
				<a href="<?php echo $link_data;?>" class="btn btn-danger">Batal</a>
			</div>
		</div>
	</form>
</div>