<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class FontDownload extends Model {

    protected $table = 'font_downloads';

    public $timestamps = false;

    public function font() {
        return $this->belongsTo(Font::class, 'font_id');
    }

    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }

}
