<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Wallet;
use App\Models\User;

class WalletController extends Controller
{
    // Display the user's wallet
    public function show($userId)
    {
        $wallet = Wallet::where('user_id', $userId)->firstOrFail();
        return view('wallet.show', compact('wallet'));
    }

    // Show the top-up form
    public function topUpForm($userId)
    {
        $wallet = Wallet::where('user_id', $userId)->firstOrFail();
        return view('wallet.topup', compact('wallet'));
    }

    // Handle the top-up process
    public function topUp(Request $request, $userId)
    {
        // Validate the incoming request
        $request->validate([
            'name' => 'required|string',
            'address' => 'required|string',
            'amount' => 'required|numeric|min:1',
        ]);

        // Find the user's wallet
        $wallet = Wallet::where('user_id', $userId)->firstOrFail();

        // Update the wallet balance
        $wallet->balance += $request->amount; // Add to cash balance
        $wallet->save();

        // You can also update points here if needed
        // $wallet->points += $request->points;

        // Redirect back with a success message
        return redirect()->route('wallet.show', $wallet->user_id)->with('success', 'Wallet topped up successfully!');
    }

    // You can add additional functions here to handle points top-up or any other wallet-related logic
}
