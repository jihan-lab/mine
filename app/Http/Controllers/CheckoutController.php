<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Transaction;
use App\Cart;
use App\TransactionDetail;

use Exception;

use Midtrans\Snap;
use Midtrans\Config;

class CheckoutController extends Controller
{
    public function proccess(Request $request)
    {
        //save user data, hanya total price nya saja
        $user = Auth::user();
        $user->update($request->except('total_price'));

        //proccess checkoutnya
        $code = 'STORE-' . mt_rand(00000, 99999);
        $carts = Cart::with(['products', 'users'])->where('users_id', Auth::user()->id)->get();

        //Transaction Create, masukkan datanya ke database Transaction
        $transaction = Transaction::create([
            'users_id' => Auth::user()->id,
            'insurance_price' => 0,
            'shipping_price' => 0,
            'total_price' => $request->total_price,
            'transaction_status' => 'PENDING',
            'code' => $code
        ]);

        foreach ($carts as $cart) {
            $trx = 'TRX-' . mt_rand(00000, 99999);

            //Transaction Create, masukkan datanya ke database Transaction
            TransactionDetail::create([
                'transactions_id' => $transaction->id,
                'products_id' => $cart->products->id,
                'price' => $cart->products->price,
                'shipping_status' => 'PENDING',
                'resi' => '',
                'code' => $trx
            ]);
        }

        //hapus data cart nya
        Cart::where('users_id', Auth::user()->id)->delete();

        // Konfigurasi midtrans
        Config::$serverKey = config('services.midtrans.serverKey');
        Config::$isProduction = config('services.midtrans.isProduction');
        Config::$isSanitized = config('services.midtrans.isSanitized');
        Config::$is3ds = config('services.midtrans.is3ds');

        //Buat array untuk dikirm ke midtrans
        $midtrans = [
            'transaction_details' => [
                'order_id' => $code,
                'gross_amount' => (int) $request->total_price
            ],
            'customer_details' => [
                'first_name' => Auth::user()->name,
                'email' => Auth::user()->email
            ],
            'enabled_payments' => [
                'gopay', 'permata_va', 'bank_transfer'
            ],
            'vtweb' => []
        ];

        try {
            // Get Snap Payment Page URL
            $paymentUrl = Snap::createTransaction($midtrans)->redirect_url;

            // Redirect to Snap Payment Page
            return redirect($paymentUrl);
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function callback()
    {
    }
}
