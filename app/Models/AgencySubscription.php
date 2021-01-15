<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AgencySubscription extends Model
{
    use HasFactory;
    protected $table = 'agency_subscriptions';
    protected $fillable = [
        'agency_id',
        'subscription_plan_id',
        'subscription_start_date',
        'subscription_end_date',
        'status',
        'created_at',
        'updated_at'
    ];
}
