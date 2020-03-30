<?php

namespace App\Http\Controllers;

use App\Model\Font;
use App\Model\ParentCategory;
use App\Model\SubCategory;

class CategoryController extends Controller {

    public function get($slug) {
        $category = ParentCategory::where('slug', $slug)->first();
        if (is_null($category)) {
            $category = SubCategory::where('slug', $slug)->first();
            $fonts = Font::with('images', 'files', 'category', 'author')
                ->whereHas('images')
                ->whereHas('files')
                ->where('category_id', $category->id)
                ->paginate(20);
        } else {
            $subCategories = implode(",", SubCategory::where('parent_id', $category->id)->get()->pluck('id')->toArray());
            if (empty($subCategories)) {
                $fonts = Font::with('images', 'files', 'category', 'author')
                    ->whereHas('images')
                    ->whereHas('files')
                    ->where('category_id', $category->id)
                    ->paginate(20);
            } else {
                $fonts = Font::with('images', 'files', 'category', 'author')
                    ->whereHas('images')
                    ->whereHas('files')
                    ->whereRaw("category_id IN ({$subCategories})")
                    ->paginate(20);
            }
        }

        return view('category', ['category' => $category, 'fonts' => $fonts]);
    }

}
