<?php
namespace App\Http\Controllers;

use App\Models\Video;

class HomeController extends Controller {

    public function home() {
        return view('home', [
            'videos' => Video::query()->latest()->get()
        ]);
    }
}
