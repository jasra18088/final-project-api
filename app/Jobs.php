<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jobs extends Model
{
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'machine_id', 'material_type_id'
    ];

    public function machine() {
        return $this->belongsTo(Machines::class, 'machine_id');
    }

    public function materialType() {
        return $this->belongsTo(MaterialType::class, 'material_type_id');
    }

    public function downtime() {
        return $this->hasMany(Downtime::class);
    }

}
