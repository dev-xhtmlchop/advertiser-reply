<?php

namespace App\Http\Controllers\NoPage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class NoPageController extends Controller
{
    public function index(){
        return view('pages.nopage.index' );
    }
}
