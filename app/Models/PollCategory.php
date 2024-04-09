<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PollCategory extends Model
{
    use HasFactory,SoftDeletes;
    protected $guarded = [];

    public function polls()
    {
        return $this->hasMany(Poll::class);
    }
}
