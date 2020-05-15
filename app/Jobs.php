<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jobs extends Model
{
    public function machine() {
        return $this->belongsTo(Machines::class, 'machine_id');
    }

    public function materialType() {
        return $this->belongsTo(MaterialType::class, 'material_type_id');
    }

}
