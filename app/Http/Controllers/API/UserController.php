<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Controllers\MiscellaneousController;
use App\Helpers\ResponseFormatter;
use App\Models\CovisTransaction;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function updatePhone(Request $request)
    {
        $mobile_no = $request->mobile_no;

        $user = User::findOrFail(auth()->user()->id);
        $user->update([
            'mobile_no' => MiscellaneousController::formatPhoneNumber($mobile_no),
            'updated_by' => auth()->user()->name
        ]);
        $res = User::with('jobPosition', 'userImage')->findOrFail(auth()->user()->id);

        return ResponseFormatter::success($res, 'Phone number succesfully updated');
    }

    public function updatePassword(Request $request)
    {
        $password = $request->password;

        $user = User::findOrFail(auth()->user()->id);
        $user->update([
            'password' => bcrypt($password),
            'updated_by' => auth()->user()->name,
            'password_updated_at' => Carbon::now()
        ]);

        $res = User::with('jobPosition', 'userImage')->findOrFail(auth()->user()->id);

        return ResponseFormatter::success($res, 'Password succesfully updated');
    }

    public function getLOD()
    {
        $user = User::findOrFail(Auth::user()->id);
        $userLOD = DB::table('user_lods as a')
                        ->leftJoin('companies as b', 'a.company_id', 'b.id')
                        ->leftJoin('job_positions as c', 'a.job_position_id', 'c.id')
                        ->leftJoin('projects as d', 'a.project_id', 'd.id')
                        ->leftJoin('users as e', 'a.user_id', 'e.id')
                        ->leftJoin('user_details as f','e.id', 'f.user_id')
                        // 
                        ->select('a.id', 'b.name as company_name', 'd.name as project_name','e.name as user_name','e.nip', 'c.name as job_position_name','a.start_date','a.end_date','f.ektp_no','a.number as lod_number','a.created_at')
                        ->where('a.user_id', $user->id)
                        ->orderBy('a.created_at', 'DESC')
                        ->limit(1)
                        ->first();

        if ($userLOD) {
            $response = [
                'id' => $userLOD->id,
                'company_name' => $userLOD->company_name,
                'project_name' => $userLOD->project_name,
                'user_name' => $userLOD->user_name,
                'job_position_name' => $userLOD->job_position_name,
                'start_date' => Carbon::parse($userLOD->start_date)->isoFormat('D MMM YYYY'),
                'end_date' => Carbon::parse($userLOD->end_date)->isoFormat('D MMM YYYY'),
                'ektp_no' => $userLOD->ektp_no,
                'lod_number' => $userLOD->lod_number,
                'created_at' => Carbon::parse($userLOD->created_at)->isoFormat('D MMM YYYY'),
            ];
        } else {
            $response = [
                'id' => 0,
                'company_name' => '',
                'project_name' => '',
                'user_name' => '',
                'job_position_name' => '',
                'start_date' => Carbon::now()->isoFormat('D MMM YYYY'),
                'end_date' => Carbon::now()->isoFormat('D MMM YYYY'),
                'ektp_no' => '',
                'lod_number' => '',
                'created_at' => Carbon::now()->isoFormat('D MMM YYYY'),
            ];
        }

        return ResponseFormatter::success($response, 'Password succesfully updated');
    }
}
