<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UserPaymentMethod;
use Illuminate\Support\Facades\Crypt;


class UserPaymentMethodController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return UserPaymentMethod::all()->map(function ($item) {
            $item->card_number = '**** **** **** ' . substr(Crypt::decrypt($item->card_number_encrypted), -4);
            return $item;
        });
    }

    public function store(Request $request)
    {
        $encrypted = Crypt::encrypt($request->card_number);

        return UserPaymentMethod::create([
            'user_id' => $request->user_id,
            'cardholder_name' => $request->cardholder_name,
            'card_number_encrypted' => $encrypted,
            'expiration_month' => $request->expiration_month,
            'expiration_year' => $request->expiration_year,
            'card_type' => $request->card_type,
            'is_default' => $request->is_default ?? false
        ]);
    }

    public function show($id)
    {
        $method = UserPaymentMethod::findOrFail($id);
        $method->card_number = '**** **** **** ' . substr(Crypt::decrypt($method->card_number_encrypted), -4);
        return $method;
    }

    public function update(Request $request, $id)
    {
        $method = UserPaymentMethod::findOrFail($id);

        $method->update([
            'cardholder_name' => $request->cardholder_name,
            'card_number_encrypted' => Crypt::encrypt($request->card_number),
            'expiration_month' => $request->expiration_month,
            'expiration_year' => $request->expiration_year,
            'card_type' => $request->card_type,
            'is_default' => $request->is_default ?? false
        ]);

        return $method;
    }

    public function destroy($id)
    {
        return UserPaymentMethod::destroy($id);
    }
}