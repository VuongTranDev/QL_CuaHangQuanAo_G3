<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Sleep;
use Tests\TestCase;

class CartTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $response = $this->get('/cart/index');
        
        
        $response->assertStatus(200);
    }
    public function testCartFunctionality()
    {
        $response = $this->get('/cart');
        $response->assertStatus(200);
        $response->assertSee('Giỏ hàng');

        Sleep::for(50)->seconds();

    }

}
