<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class SanPham extends Model
{
    use HasFactory;
    protected $table = 'sanpham';

    protected $primaryKey = 'ID';

    public $incrementing = true;

    protected $keyType = 'int';

    public $timestamps = false;

    protected $fillable = [
        'MASANPHAM',
        'MALOAI',
        'TENSANPHAM',
        'GIA',
        'CHATLIEU',
        'MANH',
        'HINHANH',
    ];

    // Quan hệ với bảng LOAISANPHAM
    public function loaiSanPham()
    {
        return $this->belongsTo(LoaiSanPham::class, 'MALOAI', 'MALOAI');
    }

    // Quan hệ với bảng NHANHIEU
    public function nhanHieu()
    {
        return $this->belongsTo(NhanHieu::class, 'MANH', 'MANH');
    }


}
