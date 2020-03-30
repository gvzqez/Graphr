<?php

namespace App\Http\Controllers;

use App\Model\Author;
use App\Model\Font;

class AuthorController extends Controller {

    public function get($slug) {
        $author = Author::where('slug', $slug)->first();
        $fonts = Font::with('images', 'files', 'category', 'author')
            ->whereHas('images')
            ->whereHas('files')
            ->where('author_id', $author->id)
            ->paginate(20);
        return view('author', ['author' => $author, 'fonts' => $fonts]);
    }

}
