<?php


namespace App\Model\Scopes;

use Illuminate\Database\Eloquent\Scope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class SubCategoryScope implements Scope {

    public function apply(Builder $builder, Model $model)
    {
        $builder->whereNotNull('parent_id');
    }

}
