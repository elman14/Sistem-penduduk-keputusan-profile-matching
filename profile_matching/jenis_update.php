<?php
$link_data='?page=jenis';
$link_update='?page=update_jenis';

$nama_jenis='';
$nilai='';

if(isset($_POST['save'])){
	$error='';
	$id=$_POST['id'];
	$action=$_POST['action'];
	$nilai=$_POST['nilai'];

	if(empty($error)){
		if($action=='edit'){
			$q="update jenis set nilai='".$nilai."' where id_jenis='".$id."'";
			mysqli_query($con,$q);
			exit("<script>location.href='".$link_data."';</script>");
		}
	}
}else{
	if(empty($_GET['action'])){$action='';}else{$action=$_GET['action'];}
	if($action=='edit'){
		$id=$_GET['id'];
		$q=mysqli_query($con,"select * from jenis where id_jenis='".$id."'");
		$r=mysqli_fetch_array($q);
		$nama_jenis=$r['nama_jenis'];
		$nilai=$r['nilai'];
	}
}
?>
<div class="box box-default">
	<div class="box-header with-border">
		<h3 class="box-title">Data Jenis Kriteria</h3>
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
				<label for="nama_jenis" class="col-sm-2 control-label">Nama Jenis</label>
				<div class="col-sm-4">
					<input name="nama_jenis" id="nama_jenis" class="form-control" readonly type="text" value="<?php echo $nama_jenis;?>">
				</div>
			</div>
			<div class="form-group">
				<label for="nilai" class="col-sm-2 control-label">Nilai</label>
				<div class="col-sm-4">
					<input name="nilai" id="nilai" required step="0.01" type="number" class="form-control" value="<?php echo $nilai;?>">
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