<?php
// fungsi untuk mengambil nilai profil alternatif
function nilai_profil_alternatif($id_kriteria,$id_alternatif){
    global $con;
    $q=mysqli_query($con,"SELECT nilai FROM opt_alternatif LEFT JOIN kriteria ON opt_alternatif.id_kriteria=kriteria.id_kriteria LEFT JOIN subkriteria ON subkriteria.id_subkriteria=opt_alternatif.id_subkriteria WHERE opt_alternatif.id_kriteria='$id_kriteria' AND id_alternatif='$id_alternatif'");
    $r=mysqli_fetch_array($q);
    return $r['nilai'];
}
// fungsi untuk mengambil nilai profil standar yang dicari
function nilai_profil_standar($id_subkriteria){
    global $con;
    $q=mysqli_query($con,"SELECT nilai FROM subkriteria WHERE id_subkriteria='$id_subkriteria'");
    $r=mysqli_fetch_array($q);
    return $r['nilai'];
}
// fungsi untuk mengambil nilai bobot dari tabel selisih/gap
function nilai_gap($gap){
    global $con;
    $q=mysqli_query($con,"SELECT bobot FROM selisih WHERE nilai_selisih='$gap'");
    $r=mysqli_fetch_array($q);
    return $r['bobot'];
}
// fungsi untuk menghitung rumus perhitungan akhir metode profile matching
function nilai_profile_matching($nilai_cf,$nilai_sf){
    global $con;
    $r1=mysqli_fetch_array(mysqli_query($con,"SELECT nilai FROM jenis WHERE nama_jenis='Core Factor (CF)'"));
    $cf=$r1['nilai'];
    $r2=mysqli_fetch_array(mysqli_query($con,"SELECT nilai FROM jenis WHERE nama_jenis='Secondary Factor (SF)'"));
    $sf=$r2['nilai'];
    return ($nilai_cf * $cf) + ($nilai_sf * $sf);
}
?>