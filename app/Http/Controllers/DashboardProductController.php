<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardProductController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('pages.dashboard-products');
    }

    public function create()
    {
        return view('pages.dashboard-products-create');
    }

    public function detail(Request $request, $id)
    {
        return view('pages.dashboard-products-detail');
    }
}
