<?php
include "profile_matching.php";

// untuk menampilkan rumus perhitungan
$temp_nama_kriteria='';
$temp_profil_standar='';
$temp_profil_alternatif='';
$temp_gap='';
$temp_nilai_gap='';

// --- untuk mengambil hasil pilihan target profil yang dicari
$q_var="select id_kriteria,nama_kriteria from kriteria order by id_kriteria";
$q_var=mysqli_query($con,$q_var);
while($r_var=mysqli_fetch_array($q_var)){
	$id_k=$r_var['id_kriteria'];
	$nama_k=$r_var['nama_kriteria'];
	$kriteria[$id_k]=isset($_POST['kriteria'.$id_k]) ? $_POST['kriteria'.$id_k] : '';
	$temp_nama_kriteria.='<th>'.$nama_k.'</th>';
	$temp_profil_standar.='<td>'.nilai_profil_standar($kriteria[$id_k]).'</td>';
}
// ---

if(isset($_POST['proses'])){

	// --- memulai perhitungan metode profile matching
	$hasil=array();
	$i=0;
	$q_alt=mysqli_query($con,"select * from alternatif order by id_alternatif");
	while($r_alt=mysqli_fetch_array($q_alt)){
		$id_alternatif=$r_alt['id_alternatif'];
		$nama_alternatif=$r_alt['nama_alternatif'];
		$temp_profil_alternatif.='<tr><td>'.$nama_alternatif.'</td>';
		$temp_gap.='<tr><td>'.$nama_alternatif.'</td>';
		$temp_nilai_gap.='<tr><td>'.$nama_alternatif.'</td>';
		$temp_cf_sf='';
		$temp_nilai='';
		$jml_cf=0;
		$jml_sf=0;
		$total_cf=0;
		$total_sf=0;
		$q_krt=mysqli_query($con,"select id_kriteria,nama_jenis from kriteria LEFT JOIN jenis ON jenis.id_jenis=kriteria.id_jenis order by id_kriteria");
		while($r_krt=mysqli_fetch_array($q_krt)){
			$id_kriteria=$r_krt['id_kriteria'];
			$nama_jenis=$r_krt['nama_jenis'];
			$profil_alt=nilai_profil_alternatif($id_kriteria,$id_alternatif);
			$profil_std=nilai_profil_standar($kriteria[$id_kriteria]);
			$gap=$profil_alt-$profil_std;
			$nilai_gap=nilai_gap($gap);
			if($nama_jenis=='Core Factor (CF)'){
				$jml_cf++;
				$total_cf+=$nilai_gap;
				$temp_cf_sf.='<td>Core Factor (CF)</td>';
			}
			if($nama_jenis=='Secondary Factor (SF)'){
				$jml_sf++;
				$total_sf+=$nilai_gap;
				$temp_cf_sf.='<td>Secondary Factor (SF)</td>';
			}
			$temp_profil_alternatif.='<td>'.$profil_alt.'</td>';
			$temp_gap.='<td>'.$gap.'</td>';
			$temp_nilai_gap.='<td>'.floatval($nilai_gap).'</td>';
		}
		$rata_cf=$total_cf/$jml_cf;
		$rata_sf=$total_sf/$jml_sf;
		$nilai_pm=nilai_profile_matching($rata_cf,$rata_sf);
		$hasil[$i]["id_alternatif"] = $id_alternatif;
		$hasil[$i]["nilai"] = $nilai_pm;
		$i++;
		$temp_nilai.='<td>'.floatval($rata_cf).'</td>';
		$temp_nilai.='<td>'.floatval($rata_sf).'</td>';
		$temp_nilai.='<td>'.floatval($nilai_pm).'</td>';
		$temp_profil_alternatif.='</tr>';
		$temp_gap.='</tr>';
		$temp_nilai_gap.=$temp_nilai.'</tr>';
	}

	// fungsi untuk mengurutkan nilai berdasarkan nilai terbesar
	function array_sort_by_column(&$arr, $col, $dir = SORT_DESC) {
		$sort_col = array();
		foreach ($arr as $key=> $row) {
			$sort_col[$key] = $row[$col];
		}
		array_multisort($sort_col, $dir, $arr);
	}
	array_sort_by_column($hasil, 'nilai');

	//tampilkan hasil penilaian kedalam tabel
	$no=0;
	$list_rekomendasi='';
	foreach($hasil as $arr){
		$id_alternatif=$arr['id_alternatif'];
		$ralternatif=mysqli_fetch_array(mysqli_query($con,"select nama_alternatif from alternatif where id_alternatif='$id_alternatif'"));
		$nilai=round($arr['nilai'], 2);
		// fungsi round untuk membulatkan 2 angka di belakang koma, jika tidak ingin ada pembulatan bisa dihapus dan diganti seperti dibawah ini
		// $nilai=$arr['nilai'];
		$list_rekomendasi.='
		<tr>
			<td>'.++$no.'</td>
			<td>'.$ralternatif['nama_alternatif'].'</td>
			<td>'.$nilai.'</td>
		</tr>
		';
	}
	// ---

	// untuk menampilkan hasil perhitungan
	$tampil_hasil='';
	$tampil_hasil.='<h4>Nilai Profil Standar</h4>';
	$tampil_hasil.='<div class="table-responsive"><table class="table table-bordered"><tbody>';
	$tampil_hasil.='<th></th>'.$temp_nama_kriteria;
	$tampil_hasil.='<tr><td><b>Nilai Profil Standar</b></td>'.$temp_profil_standar.'</tr>';
	$tampil_hasil.='</tbody></table></div>';

	$tampil_hasil.='<h4>Nilai Profil Alternatif</h4>';
	$tampil_hasil.='<div class="table-responsive"><table class="table table-bordered"><tbody>';
	$tampil_hasil.='<th>Nama Alternatif</th>'.$temp_nama_kriteria;
	$tampil_hasil.=$temp_profil_alternatif;
	$tampil_hasil.='</tbody></table></div>';

	$tampil_hasil.='<h4>Gap</h4>';
	$tampil_hasil.='<div class="table-responsive"><table class="table table-bordered"><tbody>';
	$tampil_hasil.='<th>Nama Alternatif</th>'.$temp_nama_kriteria;
	$tampil_hasil.=$temp_gap;
	$tampil_hasil.='</tbody></table></div>';

	$tampil_hasil.='<h4>Nilai Gap</h4>';
	$tampil_hasil.='<div class="table-responsive"><table class="table table-bordered"><tbody>';
	$tampil_hasil.='<th>Nama Alternatif</th>'.$temp_nama_kriteria.'<th>NCF</th><th>NSF</th><th>Nilai</th>';
	$tampil_hasil.=$temp_nilai_gap;
	$tampil_hasil.='<tr><td></td>'.$temp_cf_sf.'</tr>';
	$tampil_hasil.='</tbody></table></div>';
}

// --- untuk menampilkan combobox pilihan target profil yang dicari
$combo_kriteria='';
$q_kriteria="select * from kriteria order by id_kriteria";
$q_kriteria=mysqli_query($con,$q_kriteria);
while($r=mysqli_fetch_array($q_kriteria)){
	$id_kriteria=$r['id_kriteria'];
	$nama_kriteria=$r['nama_kriteria'];
	$combo_name="kriteria".$id_kriteria;
	$combo_subkriteria='';
	$combo_subkriteria.='<select class="form-control" name='.$combo_name.' id='.$combo_name.' required><option value="">Pilih...</option>';
	$q2="select * from subkriteria where id_kriteria=".$id_kriteria." order by id_subkriteria";
	$q2=mysqli_query($con,$q2);
	while($r2=mysqli_fetch_array($q2)){
		$selected = ($r2['id_subkriteria']==$kriteria[$id_kriteria]) ? "selected" : "";
		$combo_subkriteria.='<option value="'.$r2['id_subkriteria'].'" '.$selected.'>'.$r2['nama_subkriteria'].'</option>';
	}
	$combo_subkriteria.='</select>';
	$combo_kriteria.='
	<div class="form-group">
		<label for="'.$combo_name.'" class="col-sm-2 control-label">'.$nama_kriteria.'</label>
		<div class="col-sm-4">'.$combo_subkriteria.'</div>
	</div>';
}
// ---
?>
<div class="box box-default">
	<div class="box-header with-border">
		<h3 class="box-title">Penilaian</h3>
	</div>
	<form class="form-horizontal" action="" method="post" >
		<div class="box-body">
			<p>Target profil yang dicari:</p>
			<?php echo $combo_kriteria; ?>
		</div>
		<div class="box-footer">
			<div class="text-center col-sm-6">
				<button type="submit" name="proses" class="btn btn-success">Proses</button>
			</div>
		</div>
	</form>
</div>
<?php if(isset($_POST['proses'])){ ?>
<div class="box box-default">
	<div class="box-header with-border">
		<h3 class="box-title">Hasil Penilaian</h3>
	</div>
	<div class="box-body">

		<?php echo $tampil_hasil;?>

		<div class='table-responsive'>
			<h4>Rekomendasi</h4>
			<table class='table table-bordered table-striped' >
				<thead>
					<tr>
						<th>No</th>
						<th>Nama Alternatif</th>
						<th>Nilai</th>
					</tr>
				</thead>
				<tbody>
					<?php echo $list_rekomendasi;?>
				</tbody>
			</table>
		</div>
	</div>
</div>
<?php } ?>