<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Vote extends Model
{
    use HasFactory,SoftDeletes;

    protected $guarded = [];

    public function option()
    {
        return $this->belongsTo(PollOption::class);
    }


}
