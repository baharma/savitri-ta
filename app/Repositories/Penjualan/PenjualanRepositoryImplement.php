<?php

namespace App\Repositories\Penjualan;

use LaravelEasyRepository\Implementations\Eloquent;
use App\Models\Penjualan;

class PenjualanRepositoryImplement extends Eloquent implements PenjualanRepository{

    /**
    * Model class to be used in this repository for the common methods inside Eloquent
    * Don't remove or change $this->model variable name
    * @property Model|mixed $model;
    */
    protected $model;

    public function __construct(Penjualan $model)
    {
        $this->model = $model;
    }

    // Write something awesome :)
}
