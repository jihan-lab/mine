<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\TransactionDetail;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $transactions = TransactionDetail::with(['transactions.users', 'products.galleries'])
            ->whereHas('products', function ($products) {
                $products->where('users_id', Auth::user()->id); //Ini untuk mengambil transaction detail ini produknya kepemilikan spa, coba fahami lgi logikanya.
            }); // jadi intinya ada berapa transaksi yg dimiliki si pemilik

        $revenue = $transactions->get()->reduce(function ($carry, $item) {
            return $carry + $item->price; //reduce ini sama seperti menghitung total price si pemilik dengan menggunakan foreach
        }); //Intinya untuk mengetahui total price / kekayaan dari si pemilik.

        $customer = User::count();

        return view('pages.dashboard', [
            'transaction_count' => $transactions->count(),
            'transaction_data' => $transactions->get(),
            'revenue' => $revenue,
            'customer' => $customer
        ]);
    }
}
