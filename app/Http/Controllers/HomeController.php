<?php


namespace App\Http\Controllers;


class HomeController extends Controller
{
    public function watches()
    {
        return view('product.watch');
    }
}
