<?php

namespace App\Model;

use App\Model\Scopes\SubCategoryScope;

class SubCategory extends Category {

    protected static function boot() {
        parent::boot();
        static::addGlobalScope(new SubCategoryScope());
    }

    public function parent() {
        return $this->belongsTo(ParentCategory::class, 'parent_id');
    }

}
