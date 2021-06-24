<?php
$link_data='?page=selisih';
$link_update='?page=update_selisih';

$nilai_selisih='';
$bobot='';
$keterangan='';

if(isset($_POST['save'])){
	$error='';
	$id=$_POST['id'];
	$action=$_POST['action'];
	$nilai_selisih=$_POST['nilai_selisih'];
	$bobot=$_POST['bobot'];
	$keterangan=$_POST['keterangan'];

	if(empty($error)){
		if($action=='add'){
			if(mysqli_num_rows(mysqli_query($con,"select * from selisih where nilai_selisih='".$nilai_selisih."'"))>0){
				$error='Nilai Selisih sudah ada';
			}else{
				$q="insert into selisih(nilai_selisih,bobot,keterangan) values ('".$nilai_selisih."','".$bobot."','".$keterangan."')";
				mysqli_query($con,$q);
				exit("<script>location.href='".$link_data."';</script>");
			}
		}
		if($action=='edit'){
			$q=mysqli_query($con,"select * from selisih where id_selisih='".$id."'");
			$r=mysqli_fetch_array($q);
			$nilai_selisih_tmp=$r['nilai_selisih'];
			if(mysqli_num_rows(mysqli_query($con,"select * from selisih where nilai_selisih='".$nilai_selisih."' and nilai_selisih<>'".$nilai_selisih_tmp."'"))>0){
				$error='Nilai Selisih sudah ada';
			}else{
				$q="update selisih set nilai_selisih='".$nilai_selisih."',bobot='".$bobot."',keterangan='".$keterangan."' where id_selisih='".$id."'";
				mysqli_query($con,$q);
				exit("<script>location.href='".$link_data."';</script>");
			}
		}
	}
}else{
	if(empty($_GET['action'])){$action='add';}else{$action=$_GET['action'];}
	if($action=='edit'){
		$id=$_GET['id'];
		$q=mysqli_query($con,"select * from selisih where id_selisih='".$id."'");
		$r=mysqli_fetch_array($q);
		$nilai_selisih=$r['nilai_selisih'];
		$bobot=$r['bobot'];
		$keterangan=$r['keterangan'];
	}
	if($action=='delete'){
		$id=$_GET['id'];
		mysqli_query($con,"delete from selisih where id_selisih='".$id."'");
		exit("<script>location.href='".$link_data."';</script>");
	}
}
?>
<div class="box box-default">
	<div class="box-header with-border">
		<h3 class="box-title">Data Selisih</h3>
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
				<label for="nilai_selisih" class="col-sm-2 control-label">Nilai Selisih</label>
				<div class="col-sm-4">
					<input name="nilai_selisih" id="nilai_selisih" required type="number" class="form-control" value="<?php echo $nilai_selisih;?>">
				</div>
			</div>
			<div class="form-group">
				<label for="bobot" class="col-sm-2 control-label">Bobot</label>
				<div class="col-sm-4">
					<input name="bobot" id="bobot" required type="number" step="0.01" class="form-control" value="<?php echo $bobot;?>">
				</div>
			</div>
			<div class="form-group">
				<label for="keterangan" class="col-sm-2 control-label">Keterangan</label>
				<div class="col-sm-4">
					<textarea name="keterangan" id="keterangan" class="form-control" required rows="3"><?php echo $keterangan;?></textarea>
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