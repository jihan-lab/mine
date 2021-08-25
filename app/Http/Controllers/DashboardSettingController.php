<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardSettingController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function store()
    {
        $users = Auth::user();
        $categories = Category::all();

        return view('pages.dashboard-settings', [
            'users' => $users,
            'categories' => $categories
        ]);
    }

    public function account()
    {
        $users = Auth::user();

        return view('pages.dashboard-account', [
            'users' => $users
        ]);
    }

    public function update(Request $request, $redirect)
    {
        $data = $request->all();

        $item = Auth::user();

        $item->update($data);

        return redirect()->route($redirect);
    }
}
