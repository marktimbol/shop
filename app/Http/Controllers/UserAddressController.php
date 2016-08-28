<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Requests\UpdateAddressRequest;
use Illuminate\Http\Request;

class UserAddressController extends Controller
{
    public function edit()
    {
    	$user = auth()->user();
    	return view('dashboard.address.edit', compact('user'));
    }

    public function update(UpdateAddressRequest $request)
    {
    	auth()->user()->update($request->all());

    	// Flash message

    	return redirect()->back();
    }
}
