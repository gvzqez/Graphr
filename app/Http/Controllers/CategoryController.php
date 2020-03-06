<?php

namespace App\Http\Controllers;

use App\Model\Font;
use App\Model\ParentCategory;
use App\Model\SubCategory;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller {

    public function get($slug) {
        $category = ParentCategory::where('slug', $slug)->first();
        if (is_null($category)) {
            $category = SubCategory::where('slug', $slug)->first();
            $fonts = Font::with('images', 'files')->where('category_id', $category->id)->get();
        } else {
            $subCategories = implode(",", SubCategory::where('parent_id', $category->id)->get()->pluck('id')->toArray());
            $fonts = Font::with('images', 'files', 'category')->whereRaw("category_id IN ({$subCategories})")->get();
        }

        return view('category', ['category' => $category, 'fonts' => $fonts]);
    }



}
