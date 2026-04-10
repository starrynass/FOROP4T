<?php
include __DIR__ . "/../model/tugasmodel.php";

class DataController1 {
    private $model;

    public function __construct($conn) {
        $this->model = new Informasi1($conn);
    }

    public function index(): mixed {
       return $this->model->getAllInformasi();
    }
}

class DataController2 {
    private $model;

    public function __construct($conn) {
        $this->model = new Informasi2($conn);
    }

    public function index(): mixed {
       return $this->model->getAllInformasi();
    }
}

class DataController3 {
    private $model;

    public function __construct($conn) {
        $this->model = new Informasi3($conn);
    }

    public function index(): mixed {
       return $this->model->getAllInformasi();
    }
}

class DataController4 {
    private $model;

    public function __construct($conn) {
        $this->model = new Informasi4($conn);
    }

    public function index(): mixed {
       return $this->model->getAllInformasi();
    }
}

?>