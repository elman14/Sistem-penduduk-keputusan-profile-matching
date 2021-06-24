<?php
$id_kriteria=$_GET['idk'];
$link_data='?page=subkriteria&idk='.$id_kriteria;
$link_update='?page=update_subkriteria&idk='.$id_kriteria;

$nama_subkriteria='';
$nilai='';

if(isset($_POST['save'])){
	$error='';
	$id=$_POST['id'];
	$action=$_POST['action'];
	$nama_subkriteria=$_POST['nama_subkriteria'];
	$nilai=$_POST['nilai'];

	if($action=='add'){
		$q="insert into subkriteria(id_kriteria,nama_subkriteria,nilai) values ('".$id_kriteria."','".$nama_subkriteria."','".$nilai."')";
		mysqli_query($con,$q);
		exit("<script>location.href='".$link_data."';</script>");
	}
	if($action=='edit'){
		$q="update subkriteria set nama_subkriteria='".$nama_subkriteria."',nilai='".$nilai."' where id_subkriteria='".$id."'";
		mysqli_query($con,$q);
		exit("<script>location.href='".$link_data."';</script>");
	}
}else{
	if(empty($_GET['action'])){$action='add';}else{$action=$_GET['action'];}
	if($action=='edit'){
		$id=$_GET['id'];
		$q=mysqli_query($con,"select * from subkriteria where id_subkriteria='".$id."'");
		$r=mysqli_fetch_array($q);
		$nama_subkriteria=$r['nama_subkriteria'];
		$nilai=$r['nilai'];
	}
	if($action=='delete'){
		$id=$_GET['id'];
		mysqli_query($con,"delete from subkriteria where id_subkriteria='".$id."'");
		exit("<script>location.href='".$link_data."';</script>");
	}
}
?>
<div class="box box-default">
	<div class="box-header with-border">
		<h3 class="box-title">Data Subkriteria</h3>
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
				<label for="nama_subkriteria" class="col-sm-2 control-label">Nama Subkriteria</label>
				<div class="col-sm-4">
					<input name="nama_subkriteria" id="nama_subkriteria" class="form-control" required type="text" value="<?php echo $nama_subkriteria;?>">
				</div>
			</div>
			<div class="form-group">
				<label for="nilai" class="col-sm-2 control-label">Nilai</label>
				<div class="col-sm-4">
					<input name="nilai" id="nilai" required type="number" class="form-control" value="<?php echo $nilai;?>">
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