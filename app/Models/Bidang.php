<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bidang extends Model
{
    use HasFactory, HasUuids;
    protected $guarded = ['id'];

    public function program()
    {
        return $this->hasMany(Program::class, 'bidang_id');
    }
    public function kegiatan()
    {
        return $this->hasMany(Kegiatan::class, 'bidang_id');
    }
    public function user()
    {
        return $this->hasMany(User::class, 'bidang_id');
    }
}
