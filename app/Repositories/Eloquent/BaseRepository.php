<?php

namespace App\Repositories\Eloquent;

use App\Exceptions\ModelNotFoundException;
use App\Repositories\Contracts\BaseInterface;
use Exception;

abstract class BaseRepository implements BaseInterface {

    protected $model;

    public function __construct()
    {
        $this->model = $this->getModelClass();
    }

    public function all() 
    {
        return $this->model->all();
    }

    public function paginate($value)
    {
        return $this->model->paginate($value);
    }

    protected function getModelClass()
    {
        if(! method_exists($this, 'model'))
        {
            throw new ModelNotFoundException();
        }

        return app()->make($this->model());
    }


}