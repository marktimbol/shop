<?php

namespace App\Http\Controllers;

use App\Events\UserPlacedAnOrder;
use App\Http\Requests;
use App\Http\Requests\CheckoutRequest;
use App\ShoppingCart\ShoppingCart;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Mail;

class CheckoutController extends Controller
{
    protected $cart;

	public function __construct(ShoppingCart $cart)
	{
		$this->cart = $cart;
	}

    public function index()
    {
    	$cart = $this->cart->all();
        
        if( $cart->count() > 0 ) {
            $subtotal = $this->cart->subtotal();
            
            \JavaScript::put([
                'cart'  => $cart->toArray(),
                'subtotal'  => $this->cart->subtotal(),
                'user'  => auth()->user(),
                'signedIn'  => auth()->check(),
            ]);

    	   return view('pages.checkout.index', compact('cart', 'subtotal')); 
        }

        return redirect()->route('cart.index');
    }

    public function store(CheckoutRequest $request)
    {
        if( auth()->check() ) {
            $user = auth()->user();
        } else {
            $user = User::create($request->all());
        }

        if( $request->payment === 'card' )
        {        
            try {
                $user->charge($this->cart->subtotal(), [
                    'source' => $request->stripeToken
                ]);
            } catch (Exception $e) {
                
            }
        }

    	// Create the order for the customer
    	$order = $user->orders()->create([
    		'date'	=> Carbon::now()->toDateString(),
    		'paid'	=> $request->payment === 'card' ? 1 : 0,
    	]);

        // dd($order);

    	// Store the detailed order on the order details table
        foreach( $this->cart->all() as $item )
        {
        	$order->details()->create([
                'item_id'   => $item->options->item->id,
                'quantity'  => $item->qty,
                'subtotal'  => $item->subtotal,
            ]);
        }
        
        // Delete the items in the cart.
        $this->cart->destroy();

        event( new UserPlacedAnOrder($user, $order) );

        flash()->success('Thank you for purchasing with us. Expect a call from us within 1 working day.');
        
    	// View successful order page
        return redirect()->route('checkout.success');
    }
}
