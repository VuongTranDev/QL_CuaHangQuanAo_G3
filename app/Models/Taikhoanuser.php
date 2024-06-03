<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Taikhoanuser extends Model
{
    use HasFactory;
    protected $primaryKey = 'ID';
    protected $table = 'taikhoanuser';
    protected $fillable = [
        'MAUSER',
        'TENTK',
        'MATKHAU',
        'PHANQUYEN',
    ]; 
}
