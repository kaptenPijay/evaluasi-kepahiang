<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SubKegiatan extends Model
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
    public function kegiatan()
    {
        return $this->belongsTo(Kegiatan::class, 'kegiatan_id');
    }
    public function indikatorSubKegiatan()
    {
        return $this->hasMany(IndikatorSubKegiatan::class, 'sub_kegiatan_id');
    }
    public function realisasiSubKegiatan()
    {
        return $this->hasMany(RealisasiSubKegiatan::class, 'sub_kegiatan_id');
    }
}
