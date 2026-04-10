<?php
include __DIR__ . "/../model/Ds_Model.php";

class Cds_Controller {
    private $model;

    public function __construct($conn) {
        $this->model = new Ds_Informasi_1($conn);
    }

    public function index(): mixed {
       return $this->model->getAllInformasi();
    }
}

class Cds_Controller_2 {
    private $model;

    public function __construct($conn) {
        $this->model = new Ds_Informasi_2($conn);
    }

    public function index(): mixed {
       return $this->model->getAllInformasi();
    }
}

class Cds_Controller_3 {
    private $model;

    public function __construct($conn) {
        $this->model = new Ds_Informasi_3($conn);
    }

    public function index(): mixed {
       return $this->model->getAllInformasi();
    }
}

class Cds_Controller_4 {
    private $model;

    public function __construct($conn) {
        $this->model = new Ds_Informasi_4($conn);
    }

    public function index(): mixed {
       return $this->model->getAllInformasi();
    }
}