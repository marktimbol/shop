<?php

namespace App\Http\Controllers;

use App\Events\UserPlacedAnOrder;
use App\Http\Requests;
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
    	return view('checkout.index', compact('cart'));
    }

    public function store(Request $request)
    {                
    	// Register the user
    	$user = User::create($request->all());

    	// Create the order for the customer
    	$order = $user->orders()->create([
    		'date'	=> Carbon::now(),
    		'paid'	=> false
    	]);

    	// Store the detailed order on the order details table
        foreach( $this->cart->all() as $item )
        {
        	$order->details()->create([
                'item_id'   => $item->options->item->id,
                'quantity'  => $item->qty,
                'subtotal'  => $item->subtotal,
            ]);
        }

        $user->charge($this->cart->subtotal(), [
            'source'    => $request->stripeToken
        ]);

        // Delete the items in the cart.
        $this->cart->destroy();
        
        event( new UserPlacedAnOrder($user, $order) );
        
    	// View successful order page
        return redirect()->route('checkout.success');
    }
}
