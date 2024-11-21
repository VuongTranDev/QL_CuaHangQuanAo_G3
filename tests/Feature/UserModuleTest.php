<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\ForgotPassword;
use App\Models\User;
use Illuminate\Support\Facades\Notification;
use Tests\TestCase;

class UserModuleTest extends TestCase
{

     public function test_login()
     {
            $response = $this->post('/admin_TK', [
                 'username' => 'hoankien2k3@gmail.com',
                 'password' => '123',
             ]);
             $response->assertStatus(302);
             $this->assertDatabaseHas('taikhoanuser', [
                 'TENTK' => 'hoankien2k3@gmail.com',
             ]);
     
             echo "Test login thành công.\n";
         
     }

     public function test_login_unsuccessful()
     {
             $response = $this->post('/admin_TK', [
                 'username' => 'vohoankien',
                 'password' => '1',
             ]);
             $response->assertStatus(302);
             echo "Test login thất bại.\n";
        
    }
    public function test_register()
    {
        $response = $this->post('/DangKiTK', [
            'TenTK' => '123',
            'MatKhau' => '123',
        ]) ;
        $response->assertStatus(302);
        $response->assertRedirect(route('admin_login'));
        $this->assertDatabaseHas('taikhoanuser', [
            'TENTK' => '123',
        ]);
        echo "Test register thành công.\n";
    }
    public function test_register_unsuccessful()
    {
        $response = $this->post('/DangKiTK', [
            'TenTK' => '',
            'MatKhau' => '123',
        ]) ;
        $response->assertStatus(302);
        $response->assertRedirect(route('admin_login'));
        $this->assertDatabaseHas('taikhoanuser', [
            'TENTK' => '123',
        ]);
        echo "Test register thất bại.\n";
    }

    
    
}
//php artisan test --filter test_forgot_password php artisan test --filter test_forgot_password 