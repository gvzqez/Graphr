<?php

namespace App\Model;

use App\Model\Scopes\SubCategoryScope;

class SubCategory extends Category {

    protected static function boot() {
        parent::boot();
        static::addGlobalScope(new SubCategoryScope());
    }

    public function fonts() {
        return $this->hasMany(Font::class, 'category_id')->with('images', 'files');
    }

}
