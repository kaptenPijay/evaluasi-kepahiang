<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RealisasiKegiatan extends Model
{
    use HasFactory, HasUuids;
    protected $guarded = ['id'];

    public function indikator()
    {
        return $this->belongsTo(IndikatorKegiatan::class, 'indikator_id');
    }
    public function kegiatan()
    {
        return $this->belongsTo(Kegiatan::class, 'kegiatan_id');
    }
    public function satuan()
    {
        return $this->belongsTo(Satuan::class, 'satuan_id');
    }
}
