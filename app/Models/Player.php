<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Player extends Model
{
    use HasFactory,SoftDeletes;

    protected $guarded = [];

    protected $appends = ['full_name','age_parse'];
    public function team()
    {
        return $this->belongsTo(Team::class);
    }

    public function votes()
    {
        return $this->morphMany(Vote::class, 'voteable');
    }

    public function getFullNameAttribute()
    {
        return $this->first_name . ' '.$this->middle_name.' ' . $this->last_name;
    }

    public function getAgeParseAttribute()
    {
        return \Carbon\Carbon::parse($this->attributes['age'])->age;
    }

}
