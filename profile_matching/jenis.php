<?php
$link_data='?page=jenis';
$link_update='?page=update_jenis';

$no=0;
$list_data='';
$q="select * from jenis order by id_jenis";
$q=mysqli_query($con,$q);
if(mysqli_num_rows($q) > 0){
	while($r=mysqli_fetch_array($q)){
		$id=$r['id_jenis'];
		$list_data.='
		<tr>
		<td>'.++$no.'</td>
		<td>'.$r['nama_jenis'].'</td>
		<td>'.$r['nilai'].'</td>
		<td>
		<a href="'.$link_update.'&amp;id='.$id.'&amp;action=edit" class="btn btn-success btn-xs" title="Ubah">Ubah</a>
		</td>
		</tr>';
	}
}
?>
<div class="box box-default">
	<div class="box-header with-border">
		<h3 class="box-title">Data Jenis Kriteria</h3>
	</div>
	<div class="box-body">
		<div class="table-responsive">
			<table class="table table-striped table-bordered">
				<thead>
					<tr>
						<th>No</th>
						<th>Nama Jenis Kriteria</th>
						<th>Nilai</th>
						<th width="80">Ubah</th>
					</tr>
				</thead>
				<tbody>
					<?php echo $list_data;?>
				</tbody>
			</table>
		</div>
	</div>
</div>