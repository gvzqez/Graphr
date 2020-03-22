<?php

namespace App\Http\Controllers;

use App\Model\Font;
use App\Model\ParentCategory;

class DashboardController extends Controller {

    /**
     * Show the application dashboard.
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index() {
        return view('dashboard');
    }
}
