<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Sleep;
use Laravel\Dusk\Browser;
use PhpParser\Node\Expr\FuncCall;
use Tests\DuskTestCase;

class CartTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     */
    public function test_ThanhToanGioHang(): void
    {
        // Đăng nhập
        $this->browse(function (Browser $browser) {
            $browser->visit('/admin_login')
                    ->waitFor('#username', 5)
                    ->type('#username', 'nguyenvana')
                    ->type('#password', 'password123')
                    ->click('#dangnhap');
        });
        
        // Thêm vào giỏ hàng
        $this->browse(function (Browser $browser) {
            $browser
            ->waitFor('#A001', 4) 
            ->assertVisible('#A001')
            ->click('#A001')
            ->waitFor('#XL', 4)
            ->assertVisible('#XL')
            ->click('#XL')
            ->click('#themvaogiohang');
        });
        Sleep::for(5)->seconds();


        // Thanh toán giỏ hàng
        $this->browse(function (Browser $browser) {
            $browser->visit('/cart/index')
            ->waitFor('#thanh-toan-tat-ca', 10) 
            ->assertVisible('#thanh-toan-tat-ca')
            ->click('#thanh-toan-tat-ca')
            ->radio('dia-chi-user-click', 'Bình Dương')
            ->assertVisible('#btn-hoan-tat')
            ->click('#btn-hoan-tat');
        });
       
        Sleep::for(10)->seconds();
    }
    public function test_ThemVaoGioHang_KhongChonSize(): void{
        $this->browse(function (Browser $browser) {
            $browser->visit('/admin_login')
                    ->waitFor('#username', 5)
                    ->type('#username', 'nguyenvana')
                    ->type('#password', 'password123')
                    ->click('#dangnhap');
        });
        
        $this->browse(function (Browser $browser) {
            $browser
            ->waitFor('#A001', 4) 
            ->assertVisible('#A001')
            ->click('#A001')
            ->click('#themvaogiohang');
        });
        Sleep::for(5)->seconds();
    }
    public function test_MuaNgay_KhongChonSize() : void{
        $this->browse(function (Browser $browser) {
            $browser->visit('/admin_login')
                    ->waitFor('#username', 5)
                    ->type('#username', 'nguyenvana')
                    ->type('#password', 'password123')
                    ->click('#dangnhap');
        });
        
        $this->browse(function (Browser $browser) {
            $browser
            ->waitFor('#A001', 4) 
            ->assertVisible('#A001')
            ->click('#A001')
            ->click('#muangay');
        });
        Sleep::for(5)->seconds();
    }
    
}
