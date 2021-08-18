<?php

namespace App\Http\Controllers\MPS;

use App\Http\Controllers\Controller;

class HomeController extends Controller
{
	public function index()
	{
		return view('index::mps.index' );
	}
}
