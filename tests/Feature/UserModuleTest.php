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

    public function test_forgot_password()  
    {

        Mail::fake();
        $response = $this->post('/forgotPassword', [
            'username' => 'hoankien2k3@gmail.com', // Đảm bảo rằng email này tồn tại trong cơ sở dữ liệu test
        ]);
        $response->assertStatus(200);
         // Kiểm tra rằng email ForgotPassword đã được gửi đến người dùng
         Mail::assertSent(ForgotPassword::class, function ($mail) {
            return $mail->hasTo('hoankien2k3@gmail.com');
        });
        echo "Test request password reset link thành công.\n";
    }
    
}
//php artisan test --filter test_forgot_password php artisan test --filter test_forgot_password 