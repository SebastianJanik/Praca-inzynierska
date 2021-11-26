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
        'waiting for acceptation by coach' => 4,
        'accepted by coach' => 5,
        'declined by coach' => 6,
        'waiting for acceptation by admin' => 7,
        'accepted by admin' => 8,
        'declined by admin' => 9,
        'timetable created' => 10,
        "timetable doesn't exist" => 11,
        'assigned to the team' => 12,
        'incoming' => 13,
        'completed' => 14
    );

    public function getStatus($name)
    {
        return $this->status_id[$name];
    }
}
