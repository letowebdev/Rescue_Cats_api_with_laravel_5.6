<?php

namespace App\Repositories\Eloquent;

use App\Exceptions\ModelNotFoundException;
use App\Repositories\Contracts\BaseInterface;
use App\Repositories\Criteria\CriteriaInterface;

abstract class BaseRepository implements BaseInterface, CriteriaInterface {

    protected $model;

    public function __construct()
    {
        $this->model = $this->getModelClass();
    }

    public function all() 
    {
        return $this->model->get();
    }

    public function paginate($perPage = 10)
    {
        return $this->model->paginate($perPage);
    }

    
    public function find($id){
        $result = $this->model->findOrFail($id);

        return $result;
    }

    public function findWhere($column, $value){
        return $this->model->where($column, $value)->get();
    }

    public function findWhereFirst($column, $value){
        return $this->model->where($column, $value)->firstOrFail();
    }

    public function create(array $data){
        return $this->model->create($data);
    }

    public function update($id, array $data){
        $record = $this->find($id);
        return $record->update($data);
    }

    public function delete($id){
        $record = $this->find($id);
        return $record->delete();
    }

    public function withCriteria(...$criteria) {
        $criteria = array_flatten($criteria);

        foreach ($criteria as $criterion) {
            $this->model = $criterion->apply($this->model);
        }

        return $this;
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