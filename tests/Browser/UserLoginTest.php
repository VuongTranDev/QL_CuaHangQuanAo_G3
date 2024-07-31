<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Sleep;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class UserLoginTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     */
    public function testUserCanLoginWithValidCredentials()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/admin_login')
                    ->waitFor('#username')
                    ->type('#login_tenTK', 'hoankien2k3@gmail.com')
                    ->waitFor('#login_mk')
                    ->type('#password', '123')
                    ->click('#dangnhap');
                    
        });
        Sleep::for(5)->seconds();
    }
}
