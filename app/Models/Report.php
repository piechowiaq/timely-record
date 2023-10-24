<?php

namespace App\Models;

use Carbon\Traits\Date;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;

/**
 *
 * @property integer $id
 * @property string $notes
 * @property date $report_date
 * @property date $expiry_date
 * @property integer $registry_id
 * @property integer $company_id
 * @property integer $created_by_user_id
 * @property integer $updated_by_user_id
 *
 */

class Report extends Model
{
    use HasFactory;

    public function company(): Relation
    {
        return $this->belongsTo(Company::class);
    }

    public function registry(): Relation
    {
        return $this->belongsTo(Registry::class);
    }

    public function updatedByUser(): Relation
    {
        return $this->belongsTo(User::class, 'updated_by_user_id');
    }

    public function createdByUser(): Relation
    {
        return $this->belongsTo(User::class, 'created_by_user_id');
    }
}
