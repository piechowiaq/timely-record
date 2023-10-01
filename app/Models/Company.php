<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Database\Eloquent\SoftDeletes;

class Company extends Model
{
    use HasFactory;
    use SoftDeletes;
    use ResolveRouteBinding;

    public function registries(): Relation
    {
        return $this->belongsToMany(Registry::class)->withPivot('assigned');
    }
    public function users(): Relation
    {
        return $this->belongsToMany(User::class);
    }


}
