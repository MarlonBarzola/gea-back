<?php

namespace App\Models;

use App\Traits\ApiTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    use HasFactory, ApiTrait;

    protected $guarded = ['id', 'created_at', 'updated_at'];

    protected $allowIncluded = ['patient'];

    public function patient() {
        return $this->belongsTo(Patient::class);
    }

}
