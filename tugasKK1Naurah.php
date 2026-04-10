<?php
include "koneksi.php";
include "TugasKK1/Naurah/model/tugasmodel.php";

$model = new Informasi1($conn);
$View1 = $model->getAllInformasi();

$model = new Informasi2($conn);
$View2 = $model->getAllInformasi();

$model = new Informasi3($conn);
$View3 = $model->getAllInformasi();

$model = new Informasi4($conn);
$View4 = $model->getAllInformasi();


include "TugasKK1/Naurah/view/tugasview1.php";
include "TugasKK1/Naurah/view/tugasview2.php";
include "TugasKK1/Naurah/view/tugasview3.php";
include "TugasKK1/Naurah/view/tugasview4.php"
?>
