<?php
$link_data='?page=selisih';
$link_update='?page=update_selisih';

$list_data='';
$q="select * from selisih order by id_selisih";
$q=mysqli_query($con,$q);
if(mysqli_num_rows($q) > 0){
	while($r=mysqli_fetch_array($q)){
		$id=$r['id_selisih'];
		$list_data.='
		<tr>
		<td></td>
		<td>'.$r['nilai_selisih'].'</td>
		<td>'.floatval($r['bobot']).'</td>
		<td>'.$r['keterangan'].'</td>
		<td>
		<a href="'.$link_update.'&amp;id='.$id.'&amp;action=edit" class="btn btn-success btn-xs" title="Ubah">Ubah</a> &nbsp;
		<a href="#" data-href="'.$link_update.'&amp;id='.$id.'&amp;action=delete" data-toggle="modal" data-target="#confirm-delete" class="btn btn-danger btn-xs" title="Hapus">Hapus</a></td>
		</tr>';
	}
}
?>
<div class="box box-default">
	<div class="box-header with-border">
		<h3 class="box-title">Data Selisih</h3>
		<div class="button-right">
			<a href="<?php echo $link_update;?>" class="btn btn-primary">Tambah Selisih</a>
		</div>
	</div>
	<div class="box-body">
		<div class="table-responsive">
			<table class="table table-striped table-bordered" id="dataTables1">
				<thead>
					<tr>
						<th>No</th>
						<th>Nilai Selisih</th>
						<th>Bobot</th>
						<th>Keterangan</th>
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