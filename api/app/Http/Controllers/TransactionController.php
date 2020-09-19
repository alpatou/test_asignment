<?php

namespace App\Http\Controllers;

use App\Account;
use App\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{

    public function store(Request $request, $id) {

        // for reasons of maintance, the validation logic could go in a FormRequest file, but for the purpose of the excersice i think its ok to stay here
        $rules=array(
            'amount' => 'required|number|min:1',
        );

        $messages=array(
                'amount.required' => 'amount should be a positive number.',
            );

        $validator=Validator::make($request->all(),$rules,$messages);

        if($validator->fails())
        {
            $messages=$validator->messages();
            $errors=$messages->all();
            return $this->respondWithError($errors,500);
        }


        $to = $request->input('to');
        $amount = $request->input('amount');
        $details = $request->input('details');

        // we have to check the amount is no more than balance
        // a middleware would be a more elegant solution
        // but its ok to leave it here to get the whole image more easily
        // i do not like the idea to make a custom validation rule and doing so much stuff
        // like hitting the db


        $senderAccount = Account::findOrFail($id);

        if ($amount > $senderAccount->balance)
            return $this->respondWithError([' you dont have so much money :P'],400);

        $receiverAccount = Account::findOrFail($to);
        $senderAccount->update(['balance' => DB::raw('balance-' . $amount)]);
        $receiverAccount->update(['balance' => DB::raw('balance+' . $amount)]);
        Transaction::create([
            'from' => $id,
            'to' => $to,
            'amount' => $amount,
            'details' => $details
        ]);

    }

}
