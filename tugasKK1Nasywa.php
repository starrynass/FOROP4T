<?php
include "koneksi.php";
include "TugasKK1/Nasywa/model/data.php";

$model = new Informasi1_Join($conn);
$Informasi_data = $model->getAllInformasi();

$model = new Informasi1_Bertingkat($conn);
$Informasi1_data2 = $model->getAllInformasi();

$model = new Informasi2_Join($conn);
$Informasi2_data1 = $model->getAllInformasi();

$model = new Informasi2_Bertingkat($conn);
$Informasi2_data2 = $model->getAllInformasi();

include "TugasKK1/Nasywa/view/view.php";
include "TugasKK1/Nasywa/view/view1.php";
include "TugasKK1/Nasywa/view/view2.php";
include "TugasKK1/Nasywa/view/view3.php"
?>
