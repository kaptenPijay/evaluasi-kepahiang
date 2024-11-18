<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RealisasiSubKegiatan extends Model
{
    use HasFactory, HasUuids;
    protected $guarded = ['id'];
    public function indikator()
    {
        return $this->belongsTo(IndikatorSubKegiatan::class, 'indikator_id');
    }
    public function subKegiatan()
    {
        return $this->belongsTo(SubKegiatan::class, 'sub_kegiatan_id');
    }
    public function satuan()
    {
        return $this->belongsTo(Satuan::class, 'satuan_id');
    }
}
