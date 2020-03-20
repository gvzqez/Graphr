<?php

namespace App\Http\Controllers;

use App\Model\Font;
use App\Model\ParentCategory;

class DashboardController extends Controller
{

    /**
     * Create a new controller instance.
     * @return void
     */
    public function __construct() {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index() {
        $categories = ParentCategory::all();
        $fonts = Font::with('images', 'files', 'category')->take(15)->get();
        return view('dashboard', ['categories' => $categories, 'fonts' => $fonts]);
    }
}
