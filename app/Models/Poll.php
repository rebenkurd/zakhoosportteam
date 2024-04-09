<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Poll extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    protected $casts = [
        'start_at' => 'datetime',
        'end_at' => 'datetime',
    ];

    protected $appends = ['start_date', 'start_time', 'end_date', 'end_time', 'end_date_format', 'started_time'];

    public function user()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function options()
    {
        return $this->hasMany(PollOption::class);
    }

    public function getStartDateAttribute()
    {
        return $this->start_at->format('Y-m-d');
    }

    public function getStartTimeAttribute()
    {
        return $this->start_at->format('H:i');
    }

    public function getEndDateAttribute()
    {
        return $this->end_at->format('Y-m-d');
    }

    public function getEndTimeAttribute()
    {
        return $this->end_at->format('H:i');
    }

    public function getEndDateFormatAttribute()
    {
        return $this->end_at->diffForHumans();
    }

    public function votes()
    {
        return $this->hasMany(Vote::class);
    }

    public function getStartedTimeAttribute()
    {
        return $this->start_at->diffForHumans();
    }

    public function category()
    {
        return $this->belongsTo(PollCategory::class,'category_id');
    }
}
