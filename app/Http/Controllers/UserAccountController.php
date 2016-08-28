<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Requests\UpdateUserAccountRequest;
use Illuminate\Http\Request;

class UserAccountController extends Controller
{
    public function edit()
    {
    	return view('dashboard.accounts.edit');
    }

    public function update(UpdateUserAccountRequest $request)
    {
    	auth()->user()->update($request->all());

    	// Flash message 
    	
    	return redirect()->back();
    }
}
