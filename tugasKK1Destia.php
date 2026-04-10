<?php
include "koneksi.php";
include "TugasKK1/Destia/model/Ds_Model.php";

$model = new Ds_Informasi_1($conn);
$View_Informasi = $model->getAllInformasi();

$model = new Ds_Informasi_2($conn);
$View_Informasi_2 = $model->getAllInformasi();

$model = new Ds_Informasi_3($conn);
$View_Informasi_3 = $model->getAllInformasi();

$model = new Ds_Informasi_4($conn);
$View_Informasi_4 = $model->getAllInformasi();

include "TugasKK1/Destia/view/Ds_View.php";

include "TugasKK1/Destia/view/Ds_View_2.php";

include "TugasKK1/Destia/view/Ds_View_3.php";

include "TugasKK1/Destia/view/Ds_View_4.php";

?>
