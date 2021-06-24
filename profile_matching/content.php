<?php
switch($page){
	case 'jenis':
		include "jenis.php";
		break;
	case 'update_jenis':
		include "jenis_update.php";
		break;
	case 'selisih':
		include "selisih.php";
		break;
	case 'update_selisih':
		include "selisih_update.php";
		break;
	case 'kriteria':
		include "kriteria.php";
		break;
	case 'update_kriteria':
		include "kriteria_update.php";
		break;
	case 'subkriteria':
		include "subkriteria.php";
		break;
	case 'update_subkriteria':
		include "subkriteria_update.php";
		break;
	case 'alternatif':
		include "alternatif.php";
		break;
	case 'update_alternatif':
		include "alternatif_update.php";
		break;
	case 'lihat_alternatif':
		include "alternatif_lihat.php";
		break;
	case 'admin':
		include "admin.php";
		break;
	case 'update_admin':
		include "admin_update.php";
		break;
	case 'penilaian':
		include "penilaian.php";
		break;

	default:
		include "beranda.php";
		break;
}
?>