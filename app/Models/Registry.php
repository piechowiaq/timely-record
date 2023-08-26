<?php

namespace App\Models;

use App\Models\Company;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Database\Eloquent\SoftDeletes;

class Registry extends Model
{
    use HasFactory;
    use SoftDeletes;
    use ResolveRouteBinding;

    public function companies(): Relation
    {
        return $this->belongsToMany(Company::class);
    }
}
