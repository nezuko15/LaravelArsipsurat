<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Kategori extends Model
{
    use HasFactory;

    protected $table = 'kategori';

    protected $fillable = ['nama_kategori', 'keterangan'];

    public static function getNextId()
    {
        $lastRecord = DB::table('kategori')->select('id')->orderBy('id', 'desc')->first();

        if ($lastRecord) {
            return $lastRecord->id + 1;
        } else {
            // Jika tidak ada record sebelumnya, atur ID awal
            return DB::table('kategori')->max('id') + 1;
        }
    }
}
