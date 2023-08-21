<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;

class Company extends Model
{
    use HasFactory;

    public function registries(): Relation
    {
        return $this->belongsToMany(Registry::class)->withPivot('assigned');;
    }


}
