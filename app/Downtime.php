<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Downtime extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'job_id', 'user_id', 'description', 'amount'
    ];

    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function job() {
        return $this->belongsTo(Jobs::class, 'job_id');
    }
}
