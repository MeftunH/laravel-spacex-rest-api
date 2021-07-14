<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mission extends Model
{
    use HasFactory;
    protected $fillable=[
        'id',
        'name',
        'flight',
        'parent_capsule_serial',
    ];

    public function capsule()
    {
        return $this->belongsTo(Capsule::class);
    }
}
