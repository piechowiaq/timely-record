<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

trait ResolveRouteBinding
{
    public function resolveRouteBinding($value, $field = null): ?Model
    {
        return $this->where($field ?? 'id', $value)->withTrashed()->firstOrFail();
    }
}
