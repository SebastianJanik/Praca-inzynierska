<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Statuses extends Model
{
    use HasFactory;

    private $status_id = array(
        'active' => 1,
        'inactive' => 2,
        'blocked' => 3,
        'suspended' => 4,
        'waiting for acceptation by coach' => 5,
        'accepted by coach' => 6,
        'declined by coach' => 7,
        'waiting for acceptation by admin' => 8,
        'accepted by admin' => 9,
        'declined by admin' => 10,
        'timetable created' => 11,
        "timetable doesn't exist" => 12,
        'assigned to the team' => 13,
        'apply to be referee' => 14,
        'incoming' => 15,
        'completed' => 16
    );

    public function getStatus($name)
    {
        return $this->status_id[$name];
    }
}
