<?php
include __DIR__ . "/../model/data.php";

class DataController {
    private $model;

    public function __construct($conn) {
        $this->model = new Informasi1_Join($conn);
    }

    public function index(): mixed {
       return $this->model->getAllInformasi();
    }
}

class DataController2 {
    private $model;

    public function __construct($conn) {
        $this->model = new Informasi1_Bertingkat($conn);
    }

    public function index(): mixed {
       return $this->model->getAllInformasi();
    }
}

class DataController3 {
    private $model;

    public function __construct($conn) {
        $this->model = new Informasi2_Join($conn);
    }

    public function index(): mixed {
       return $this->model->getAllInformasi();
    }
}

class DataController4 {
    private $model;

    public function __construct($conn) {
        $this->model = new Informasi2_Bertingkat($conn);
    }

    public function index(): mixed {
       return $this->model->getAllInformasi();
    }
}
?>

