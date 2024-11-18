<?php

namespace App\Models;

use App\Models\SubKegiatan;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class IndikatorSubKegiatan extends Model
{
    use HasFactory, HasUuids;
    protected $guarded = ['id'];
    public function subKegiatan()
    {
        return $this->belongsTo(SubKegiatan::class, 'sub_kegiatan_id');
    }
    public function realisasiSubKegiatan()
    {
        return $this->hasOne(RealisasiSubKegiatan::class, 'indikator_id');
    }
    public function satuan()
    {
        return $this->belongsTo(Satuan::class, 'satuan_id');
    }
}
