<?php

namespace App\Model;

use App\Model\Scopes\ParentCategoryScope;

class ParentCategory extends Category {

    protected $appends = ['sub_categories'];

    protected static function boot() {
        parent::boot();
        static::addGlobalScope(new ParentCategoryScope());
    }

    public function getSubCategoriesAttribute() {
        return SubCategory::where('parent_id', $this->id)->get();
    }

}
