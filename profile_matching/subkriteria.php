<?php
$id_kriteria=$_GET['idk'];
$link_kriteria='?page=kriteria';
$link_data='?page=subkriteria&idk='.$id_kriteria;
$link_update='?page=update_subkriteria&idk='.$id_kriteria;

$r_kriteria=mysqli_fetch_array(mysqli_query($con,"select * from kriteria where id_kriteria='".$id_kriteria."'"));
$nama_kriteria=$r_kriteria['nama_kriteria'];
$r_jenis=mysqli_fetch_array(mysqli_query($con,"select nama_jenis from jenis where id_jenis='".$r_kriteria['id_jenis']."'"));
$nama_jenis=$r_jenis['nama_jenis'];

$list_data='';
$q="select * from subkriteria where id_kriteria=".$id_kriteria." order by id_subkriteria";
$q=mysqli_query($con,$q);
if(mysqli_num_rows($q) > 0){
	while($r=mysqli_fetch_array($q)){
		$id=$r['id_subkriteria'];
		$list_data.='
		<tr>
		<td></td>
		<td>'.$r['nama_subkriteria'].'</td>
		<td>'.$r['nilai'].'</td>
		<td>
		<a href="'.$link_update.'&amp;id='.$id.'&amp;action=edit" class="btn btn-success btn-xs" title="Ubah">Ubah</a> &nbsp;
		<a href="#" data-href="'.$link_update.'&amp;id='.$id.'&amp;action=delete" data-toggle="modal" data-target="#confirm-delete" class="btn btn-danger btn-xs" title="Hapus">Hapus</a></td>
		</tr>';
	}
}
?>
<div class="box box-default">
	<div class="box-header with-border">
		<h3 class="box-title">Data Subkriteria</h3>
	</div>
	<div class="box-body">
		<div class="table-responsive">
			<table class="table" >
				<tr>
					<td width="150">Nama Kriteria</td>
					<td>: <?php echo $nama_kriteria;?></td>
				</tr>
				<tr>
					<td width="150">Jenis </td>
					<td>: <?php echo $nama_jenis;?></td>
				</tr>
				<tr>
					<td></td>
					<td>
						<a href="<?php echo $link_kriteria;?>" class="btn btn-warning">Kembali</a> &nbsp;
						<a href="<?php echo $link_update;?>" class="btn btn-primary">Tambah Subkriteria</a>
					</td>
				</tr>
			</table>
		</div>
		<div class="table-responsive">
			<table class="table table-striped table-bordered" id="dataTables1">
				<thead>
					<tr>
						<th>No</th>
						<th>Nama Subkriteria</th>
						<th>Nilai</th>
						<th width="80">Aksi</th>
					</tr>
				</thead>
				<tbody>
					<?php echo $list_data;?>
				</tbody>
			</table>
		</div>
	</div>
</div>