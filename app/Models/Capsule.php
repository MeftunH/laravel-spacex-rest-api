<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Capsule extends Model
{
    use HasFactory;
    protected $fillable = [
        'id', 'updated_at', 'created_at',
        'capsule_serial',
        'capsule_id',
        'status',
        'original_launch',
        'original_launch_unix',
        'landings',
        'type',
        'details',
        'reuse_count',
    ];

    public function missions()
    {
        return $this->hasMany(Mission::class);
    }

}
