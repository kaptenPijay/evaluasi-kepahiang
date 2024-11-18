<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    use HasFactory, HasUuids;
    protected $guarded = ['id'];

    public function bidang()
    {
        return $this->belongsTo(Bidang::class, 'bidang_id');
    }
    public function indikatorProgram()
    {
        return $this->hasMany(IndikatorProgram::class, 'program_id');
    }
    public function realisasi()
    {
        return $this->hasMany(Realisasi::class, 'program_id');
    }
    public function kegiatan()
    {
        return $this->hasMany(Kegiatan::class, 'program_id');
    }
}
