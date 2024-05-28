<?php

namespace App\Models;

use Spatie\Activitylog\Models\Activity as SpatieActivity;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Activity extends SpatieActivity
{
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'causer_id');
    }
}
