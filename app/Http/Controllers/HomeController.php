<?php

namespace App\Http\Controllers;


use App\Models\Invoice;
use App\Models\Purchase;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }
    public function report($type)
    {
        if($type == 'invoice'){
            $reports = Invoice::all();
        }else{
            $reports = Purchase::all();
        }

        $page_title = "Reports";
        return view('report.index',compact('reports','page_title','type'));
    }
}
