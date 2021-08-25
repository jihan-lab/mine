<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TransactionDetail;
use Illuminate\Support\Facades\Auth;

class DashboardTransactionController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $sellTransactions = TransactionDetail::with(['transactions.users', 'products.galleries'])
            ->whereHas('products', function ($products) {
                $products->where('users_id', Auth::user()->id);
            })->get();

        $buyTransactions = TransactionDetail::with(['transactions.users', 'products.galleries'])
            ->whereHas('transactions', function ($transactions) {
                $transactions->where('users_id', Auth::user()->id);
            })->get();


        return view('pages.dashboard-transactions', [
            'sellTransactions' => $sellTransactions,
            'buyTransactions' => $buyTransactions
        ]);
    }

    public function detail(Request $request, $id)
    {
        $transactions = TransactionDetail::with(['transactions.users', 'products.galleries'])
            ->findOrFail($id);

        return view('pages.dashboard-transactions-details', [
            'transactions' => $transactions
        ]);
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();

        $item = TransactionDetail::findOrFail($id);

        $item->update($data);

        return redirect()->route('dashboard-transactions-details', $id);
    }
}
