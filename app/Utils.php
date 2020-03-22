<?php


namespace App;


use App\Model\ParentCategory;

class Utils {

    public static function getCategoryList() {
        return ParentCategory::all();
    }

}