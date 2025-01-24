<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Thing extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'wrnt', 'master'];

    public function master()
    {
        return $this->belongsTo(User::class, 'master_id');
    }

    public function uses()
    {
        return $this->hasMany(ThingUsage::class);
    }
}