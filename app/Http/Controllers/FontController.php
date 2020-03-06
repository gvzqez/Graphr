<?php

namespace App\Http\Controllers;

use App\Model\Category;
use App\Model\Font;
use App\Model\ParentCategory;
use App\Model\SubCategory;

class FontController extends Controller {

    public function get($slug) {
        $font = Font::with('images', 'files', 'category')->where('slug', $slug)->first();
        return $font->toJson();
    }
}
