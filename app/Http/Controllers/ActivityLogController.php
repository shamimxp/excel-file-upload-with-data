<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Spatie\Activitylog\Models\Activity;

class ActivityLogController extends Controller
{
    public function getLoginActivity()
    {
        $login_activity = Activity::inLog('buyer_login', 'buyer_logout')->latest()->get();
//        return $login_activity;
        return view('activity_log.login_activity',compact('login_activity'));
    }

    public function cleanLoginActivity()
    {
        //return 'hello';
        Artisan::call('activitylog:clean');
        //return $login_activity;
        return back();
    }

    public function getAdminActivity()
    {
        $admin_activity = Activity::inLog('default','employee')->latest()->get();
        //return $login_activity;
        return view('activity_log.admin_activity',compact('admin_activity'));
    }

    public function viewAdminActivity($id)
    {
        //dd(Activity::find($id)->changes);
        $activity_log = Activity::find($id);
        return view('activity_log.view_admin_activity',compact('activity_log'));
    }

    public function revertAllAdminActivity($id){
        //return $id;
        $log = Activity::find($id);
        //dd($log->changes['old']);
        $log->subject->update($log->changes['old']);

//        Toastr::success('Log Reverted successfully.');
        return back();
    }

    public function revertAdminActivity(Request $request, $id){
        //dd($request->old_value);
        $log = Activity::find($id);
        $field_name = $request->field_name;
        $old_value = $request->old_value;
        //dd($log->changes['old']);
        $log->subject->update([
            $field_name => $old_value,
        ]);

//        Toastr::success('Log Reverted successfully.');
        return back();
    }


}
