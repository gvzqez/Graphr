<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Font extends Model {

    protected $table = 'fonts';

    public function author() {
        return $this->belongsTo(Author::class, 'author_id');
    }

    public function category() {
        return $this->belongsTo(SubCategory::class, 'category_id');
    }

    public function images() {
        return $this->hasMany(FontImage::class);
    }

    public function files() {
        return $this->hasMany(FontFile::class);
    }

    public function downloads() {
        return $this->hasMany(FontDownload::class);
    }

}
