<?php

namespace Awobaz\Compoships\Tests\Model;

use Awobaz\Compoships\Database\Eloquent\Model;

class Allocation extends Model
{
    public function trackingTasks()
    {
        return $this->hasMany(TrackingTask::class, ['booking_id', 'vehicle_id'], ['booking_id', 'vehicle_id']);
    }

    public function space()
    {
        return $this->hasOne(Space::class, 'booking_id', 'booking_id');
    }
}