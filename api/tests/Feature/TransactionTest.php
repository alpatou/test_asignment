<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TransactionTest extends TestCase
{

    use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testThatChecksTheBalance()
    {
        // what needs testing? Well, Everything
        // my mistake is that i did not started with tests
        // so as i am now already late, i will test the most basic flaw, the balance and amount danges
        // also, this app should check about currencies, but this is a whole new feature
        // because you cannot add apples with oranges.. or eur to usd without converting....
        // i will play fast by following the seeders and not mocking or factories
        // and testing through the balance of account seeder
        // not perfect i know, but this is the best for nowb

        $this->seed();

        $response = $this->post('api/accounts/1/transactions', [
            'to' => 2,
            'amount'  => 16000,
            'details' => 'just take my money, although you have way more than me'
        ]);
        $response->assertStatus(422)
        ->assertJson([
            'message' => 'you dont have so much money :P'
            ]);
    }
}
