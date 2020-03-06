<?php


namespace App\Model\Scopes;

use Illuminate\Database\Eloquent\Scope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class ParentCategoryScope implements Scope {

    public function apply(Builder $builder, Model $model)
    {
        $builder->whereNull('parent_id');
    }

}
