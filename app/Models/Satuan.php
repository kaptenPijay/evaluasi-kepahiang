<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Satuan extends Model
{
    use HasFactory, HasUuids;
    protected $guarded = ['id'];
    public function indikatorProgram()
    {
        return $this->hasMany(IndikatorProgram::class, 'satuan_id');
    }
    public function indikatorKegiatan()
    {
        return $this->hasMany(IndikatorKegiatan::class, 'satuan_id');
    }
    public function indikatorSubKegiatan()
    {
        return $this->hasMany(IndikatorSubKegiatan::class, 'satuan_id');
    }
    public function realisasiProgram()
    {
        return $this->hasMany(Realisasi::class, 'satuan_id');
    }
    public function realisasiKegiatan()
    {
        return $this->hasMany(RealisasiKegiatan::class, 'satuan_id');
    }
    public function realisasiSubKegiatan()
    {
        return $this->hasMany(RealisasiSubKegiatan::class, 'satuan_id');
    }
}
