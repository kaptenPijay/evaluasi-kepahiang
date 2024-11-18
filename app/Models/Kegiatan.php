<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Kegiatan extends Model
{
    use HasFactory, HasUuids;
    protected $guarded = ['id'];

    public function program()
    {
        return $this->belongsTo(Program::class, 'program_id');
    }
    public function bidang()
    {
        return $this->belongsTo(Bidang::class, 'bidang_id');
    }
    public function indikatorKegiatan()
    {
        return $this->hasMany(IndikatorKegiatan::class, 'kegiatan_id');
    }
    public function realisasiKegiatan()
    {
        return $this->hasMany(RealisasiKegiatan::class, 'kegiatan_id');
    }
    public function subKegiatan()
    {
        return $this->hasMany(SubKegiatan::class, 'kegiatan_id');
    }
}
