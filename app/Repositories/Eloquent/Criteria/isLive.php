<?php

namespace App\Repositories\Eloquent\Criteria;

use App\Repositories\Criteria\CriterionInterface;

class isLive implements CriterionInterface {

    public function apply($model)
    {
        return $model->where('is_live', true);
    }









}