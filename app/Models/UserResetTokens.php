<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Taikhoanuser ;
class UserResetTokens extends Model
{
    use HasFactory;

    protected $fillable = [
        'EMAIL',
        'TOKEN',
    ];

    public function customer()
    {
        return $this->hasOne(Taikhoanuser::class, 'TENTK', 'EMAIL');
    }
}
