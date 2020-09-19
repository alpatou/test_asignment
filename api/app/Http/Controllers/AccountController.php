<?php

namespace App\Http\Controllers;

use App\Account;
use Illuminate\Http\Request;

class AccountController extends Controller
{

    // generally speaking, it is not a good practice to expose the db id's in an api
    //  it is recomender, to use UUID
    // but, i do not know if i will find the time to do it, so i refer it just to know
    // that i am aware of this security issue
    // lol
    public function getAccount($id) {
        // i have two concerns here
        // first of all, it is better to use repository pattern
        // but the most serious security issue is sql injection
        // so, repository comes second, the main thing here
        // is to use the eloquent secure code.
        // also i do not understand why the original code returns collection of accounts
        // id is unique!!!
        $account = Account::findOrFail($id);
        // i think it should be in json format,
        // but i have not checked the front end
        // if it encodes it there
        return $account;
        // too much comments for such a simple function
        //  but the things i said, i mean them for every other function
    }

}
