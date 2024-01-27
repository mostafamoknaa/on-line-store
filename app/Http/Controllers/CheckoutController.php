<?php

namespace App\Http\Controllers;

use App\Models\orders;
use App\Models\carts;
use App\Models\User;
use App\Notifications\PayVisaNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;


class CheckoutController extends Controller
{
    public function checkout()
    {   
        // Enter Your Stripe Secret
        \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

        $total=CheckoutController::payment();	
		$amount = $total;
        $amount = (int) $amount;
        
        $payment_intent = \Stripe\PaymentIntent::create([
			'description' => 'Stripe Test Payment',
			'amount' => $amount,
			'currency' => 'EUR',
			'description' => 'Payment From All products',
			'payment_method_types' => ['card'],
		]);
		
        $intent = $payment_intent->client_secret;
		return view('payment.pay',compact('intent'));


    }

    public function afterPayment()
    {
        $total=CheckoutController::payment();	
		$amount = $total;
        orders::create([
            'total'=>$total,
            'Address'=>"alex"
        ]);
        $us=Auth::id();
        Notification::send(Auth::user(),new PayVisaNotification());
        carts::where('user_id',$us)->delete();
        return redirect()->route('sections.index');
    }
    public function payment(){
        $us=Auth::id();
        $carts=carts::get()->where('user_id',$us);
        $total=
        carts::join('products','carts.product_id','=','products.id')
        ->where('carts.user_id',$us)
        ->sum('products.price');
        
        return $total;
    }

}