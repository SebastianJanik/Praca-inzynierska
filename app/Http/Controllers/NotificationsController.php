<?php

namespace App\Http\Controllers;

use App\Models\Notifications;
use App\Models\Statuses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationsController extends Controller
{
    private $modelStatuses;

    public function __construct()
    {
        $this->modelStatuses = new Statuses();
    }

    public function index()
    {
        $user = Auth::user();
        $notifications = Notifications::where('user_id', $user->id)->get();
        foreach ($notifications as $notification){
            $notification->status = 'inactive';
            if($notification->status_id == $this->modelStatuses->getStatus('active'))
                $notification->status = 'active';
        }
        return view('notifications.index', compact('notifications'));
    }

    public function show($id)
    {
        $notification = Notifications::find($id);
        if($notification->status_id == $this->modelStatuses->getStatus('active')){
            $notification->status_id = $this->modelStatuses->getStatus('inactive');
            $notification->save();
        }
        return view('notifications.show', compact('notification'));
    }
}
