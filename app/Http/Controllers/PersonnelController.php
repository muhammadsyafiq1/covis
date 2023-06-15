<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Company;
use App\Models\Department;
use App\Models\JobPosition;
use App\Models\Project;
use App\Models\UserLod;
use App\Models\UserRole;

class PersonnelController extends Controller
{
    public function index()
    {
        $total = User::all()->where('user_role_id', '>', 3)->where('is_active', 1)->count();
        $view = User::all()->where('user_role_id', '>', 3)->where('is_active', 1);
        $select1 = Company::where('is_active', 1)->get();
        $select2 = Department::where('is_active', 1)->get();
        $select3 = JobPosition::where('is_active', 1)->get();
        $select4 = UserRole::where('id', '>', 2)->where('is_active', 1)->get();
        return view('personnel.personnel', compact('total', 'view', 'select1', 'select2', 'select3', 'select4'));
    }

    public function view($id)
    {
        $data = User::findOrFail($id);
        return view('personnel.personnel-view', compact('data'));
    }

    public function view_detail($id)
    {
        $data = User::find($id);
        $companies = Company::all();
        $jobPositions = JobPosition::all();
        $clients = Project::all();
        $lastLod = UserLod::where('user_id', $id)
                    ->orderBy('created_at', 'DESC')
                    ->whereNotNull('end_date')
                    ->whereNotNull('start_date')
                    ->whereNotNull('number')

                    ->limit(1)
                    ->first();
        return view('personnel.personnel-view-detail', compact([
            'data','companies','jobPositions','clients','lastLod'
        ]));
    }


    public function userLodStore(Request $request)
    {
        UserLod::create([
            'user_id' => $request->user_id,
            'start_date' =>$request->start_date,
            'end_date' =>$request->end_date,
            'company_id' =>$request->company_id,
            'job_position_id' => 7,
            'project_id' =>$request->project_id,
            'number' =>$request->number,
            'created_by' => auth()->user()->name,
        ]);
        return redirect()->back()->with(['success' => 'User Lod successfully added!']);
    }
}
