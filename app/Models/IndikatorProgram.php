<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IndikatorProgram extends Model
{
    use HasFactory, HasUuids;
    protected $guarded = ['id'];

    public function program()
    {
        return $this->belongsTo(Program::class, 'program_id');
    }
    public function realisasi()
    {
        return $this->hasOne(Realisasi::class, 'indikator_id');
    }
    public function satuan()
    {
        return $this->belongsTo(Satuan::class, 'satuan_id');
    }
}
