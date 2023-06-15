<?php

namespace App\Http\Controllers;

use App\Http\Requests\AccessTypeRequest;
use Illuminate\Http\Request;
use App\Models\Company;
use App\Models\Department;
use App\Models\JobPosition;
use App\Models\Project;
use App\Models\Branch;
use App\Models\Region;
use App\Models\CovisClasses;
use App\Models\CovisType;
use App\Models\CovisPriority;
use App\Models\CovisCondition;
use App\Models\CovisUsedFor;
use App\Models\CovisAccessType;
use App\Models\User;
use App\Models\UserDetail;
use App\Models\UserImage;
use App\Models\UserRole;
use App\Http\Requests\JobPositionRequest;
use App\Http\Requests\DepartmentRequest;
use App\Http\Requests\CompanyRequest;
use App\Http\Requests\ClientRequest;
use App\Http\Requests\BranchRequest;
use App\Http\Requests\ClassesRequest;
use App\Http\Requests\ConditionRequest;
use App\Http\Requests\RegionRequest;
use App\Http\Requests\CovisTypeRequest;
use App\Http\Requests\PriorityRequest;
use App\Http\Requests\RoleRequest;
use App\Http\Requests\UsedForRequest;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class SettingController extends Controller
{
    // company setting
    public function company_index()
    {
        $total = Company::all()->where('is_active', 1)->count();
        $view = Company::all();
        return view('settings.organization.set-company', compact('total', 'view'));
    }

    public function company_edit($id)
    {
        $data = Company::findOrFail(decrypt($id));
        return view('settings.organization.set-company-edit', compact('data'));
    }

    public function company_store(CompanyRequest $request)
    {

        $data = $request->all();
        $data['created_by'] = auth()->user()->name;
        Company::create($data);
        $data['code'] = \Str::upper($request->code);
        return redirect()->back()->with('success', 'Company has been Created!');
    }

    public function company_update(Request $request, $id)
    {
        $data = $request->all();
        $data['updated_by'] = Auth::user()->name;
        $item = Company::findOrFail(decrypt($id));
        $item->update($data);
        return redirect(route('setting-company'))->with('success', 'Company has been Updated!');
    }

    public function company_delete($id)
    {
        $data = Company::findOrFail($id);
         $data->is_active = 0;
        $data->save();
        return redirect()->back()->with('success', 'Company has been Delete!');
    }


    public function company_inactive ($id)
    {
        $data = Company::findOrfail($id);
        $data->is_active = 0;
        $data->save();
        return redirect()->back()->with('success', 'Company has been Inactive!');
    }


    public function company_active ($id)
    {
        $data = Company::findOrfail($id);
        $data->is_active = 1;
        $data->save();
        return redirect()->back()->with('success', 'Company has been Acitived!');
    }

    // department setting
    public function department_index()
    {
        $total = Department::all()->where('is_active', 1)->count();
        $view = Department::with('user')->get();
        $select = Company::where('is_active', 1)->pluck('name', 'id');
        return view('settings.organization.set-department', compact('total', 'view', 'select'));
    }

    public function department_show()
    {
        return view('settings.organization.set-department-show');
    }

    public function department_store(DepartmentRequest $request)
    {
        // dd($request->all()); die;
        Department::create([
            'code' => $request->code,
            'company_id' => $request->company_id,
            'name' => $request->name,
            'note' => $request->note,
            'created_by' => auth()->user()->name,
        ]);

        return redirect()->back()->with('success', 'New Department Created Successfully!');
    }

    public function department_edit ($id)
    {
        $data = Department::findOrFail(decrypt($id));
        $select = Company::where('is_active', 1)->get();
        return view('settings.organization.set-department-edit', compact('data','select'));
    }

    public function department_update(Request $request, $id)
    {
        $data = $request->all();
        $data['updated_by'] = Auth::user()->name;
        $item = Department::findOrFail(decrypt($id));
        $item->update($data);
        return redirect('setting-department')->with('success', 'Department Updated Successfully!');
    }

    public function department_delete ($id)
    {
        $data = Department::findOrFail($id);
         $data->is_active = 0;
        $data->save();
        return redirect()->back()->with('success', 'Department has been Delete!');
    }


    public function department_inactive ($id)
    {
        $data = Department::findOrfail(decrypt($id));
        $data->is_active = 0;
        $data->save();
        return redirect(route('setting-department'))->with('success', 'Department Deactivated!');
    }


    public function department_active ($id)
    {
        $data = Department::findOrfail(decrypt($id));
        $data->is_active = 1;
        $data->save();
        return redirect(route('setting-department'))->with('success', 'Department Activated!');
    }

    // job_position setting
    public function job_position_index()
    {
        $total = JobPosition::all()->where('is_active', 1)->count();
        $view = JobPosition::with('userJobPosition')->get();
        $select1 = Company::all()->where('is_active', 1);
        $select2 = Department::all()->where('is_active', 1);
        return view('settings.organization.set-job_position', compact('total', 'view', 'select1', 'select2'));
    }

    public function job_position_edit($id)
    {
        $data = JobPosition::find(decrypt($id));
        return view('settings.organization.set-job_position-edit', compact('data'));
    }


    public function job_position_store(JobPositionRequest $request)
    {
        $data = $request->all();
        $data['created_by'] = auth()->user()->name;

        $data['code'] = strtoupper($request->code);
        JobPosition::create($data);
        return redirect()->back()->with('success', 'New Job Position Created Successfully!');
    }

    public function job_position_update(Request $request, $id)
    {
        $newJb = JobPosition::find(decrypt($id));
        $newJb->note = $request->note;
        $newJb->save();
        return redirect('setting-job-position')->with('success', 'Job Position Updated Successfully!');
    }

    public function job_position_inactive ($id)
    {
        $data = JobPosition::findOrfail(decrypt($id));
        $data->is_active = 0;
        $data->save();
        return redirect(route('setting-job-position'))->with('success', 'Job Position Deactivated!');
    }


    public function job_position_active($id)
    {
        $data = JobPosition::findOrfail(decrypt($id));
        $data->is_active = 1;
        $data->save();
        return redirect(route('setting-job-position'))->with('success', 'Job Position Activated!');
    }

    // project setting
    public function project_index()
    {
        $total = Project::all()->where('is_active', 1)->count();
        $view = Project::all();
        $select = Company::all()->where('is_active', 1);
        return view('settings.project.set-project', compact('total', 'view', 'select'));
    }

    public function project_edit($id)
    {
        $data = Project::with('company')->findOrFail(decrypt($id));
        $select = Company::all()->where('is_active', 1);
        return view('settings.project.set-project-edit', compact('data','select'));
    }

    public function project_store(ClientRequest $request)
    {
        $data = $request->all();
        $data['created_by'] = auth()->user()->name;
        $data['code'] = strtoupper($request->code);
        Project::create($data);
        return redirect()->back()->with('success', 'New Client Created Successfully!');;
    }

    public function project_update(Request $request, $id)
    {
        $data  = Project::findOrFail(decrypt($id));
        $data->company_id = $request->company_id;
        $data->name = $request->name;
        $data->alias = $request->alias;
        $data->address = $request->address;
        $data->phone = $request->phone;
        $data->email = $request->email;
        $data->website = $request->website;
        $data->note = $request->note;
        $data->updated_by = Auth::user()->name;
        $data->save();
        return redirect('setting-project-client')->with('success', 'Client Updated Successfully!');
    }


    public function project_delete($id)
    {
        $data = Project::findOrFail($id);
        $data->is_active = 0;
        $data->save();
        return redirect()->back()->with('success', 'Project Client has been Delete!');
    }

    public function client_inactive ($id)
    {
        $data = Project::findOrfail(decrypt($id));
        $data->is_active = 0;
        $data->save();
        return redirect(route('setting-project-client'))->with('success', 'Client Deactivated!');
    }


    public function client_active ($id)
    {
        $data = Project::findOrfail(decrypt($id));
        $data->is_active = 1;
        $data->save();
        return redirect(route('setting-project-client'))->with('success', 'Client Activated!');
    }

    // branch setting
    public function branch_index()
    {
        $total = Branch::all()->where('is_active', 1)->count();
        $view = Branch::all();
        $company = Company::all()->where('is_active', 1);
        $project = Project::all()->where('is_active', 1);
        $region = Region::all()->where('is_active', 1);
        return view('settings.project.set-branch', compact('total', 'view', 'company', 'project', 'region'));
    }

    public function branch_show()
    {
        return view('settings.project.set-branch-show');
    }

    public function branch_store(BranchRequest $request)
    {
        $data = $request->all();
        $data['created_by'] = auth()->user()->name;
        $data['code'] = strtoupper($request->code);

        $data['is_active'] = 1;
        Branch::create($data);
        return redirect()->back()->with('success', 'New Branch Created Successfully!');;
    }


    public function branch_edit ($id)
    {
        $data = Branch::findOrFail(decrypt($id));
        $company = Company::all()->where('is_active', 1);
        $project = Project::all()->where('is_active', 1);
        $region = Region::all()->where('is_active', 1);
        return view('settings.project.set-branch-edit', compact('company','project','data','region'));
    }

    public function branch_update(Request $request, $id)
    {
        $data = $request->all();
        $data['updated_by'] = Auth::user()->name;
        $item = Branch::findOrFail(decrypt($id));
        $item->update($data);
        return redirect(route('setting-branch'))->with('success', 'Branch Updated Successfully!');
    }

    public function branch_delete ($id)
    {
        $data = Branch::findOrFail($id);
         $data->is_active = 0;
        $data->save();
        return redirect()->back()->with('success', 'Branch  has been Delete!');
    }

    public function branch_inactive ($id)
    {
        $data = Branch::findOrfail(decrypt($id));
        $data->is_active = 0;
        $data->save();
        return redirect(route('setting-branch'))->with('success', 'Branch Deactivated!');
    }


    public function branch_active ($id)
    {
        $data = Branch::findOrfail(decrypt($id));
        $data->is_active = 1;
        $data->save();
        return redirect(route('setting-branch'))->with('success', 'Branch Activated!');
    }

    // region setting
    public function region_index()
    {
        $projects = Project::all();
        $total = Region::all()->where('is_active', 1)->count();
        $view = Region::with('region')->get();
        return view('settings.project.set-region', compact('total', 'view','projects'));
    }

    public function region_edit($id)
    {
        $company = Company::all()->where('is_active', 1);
        $project = Company::all()->where('is_active', 1);
        $data = Region::findOrFail(decrypt($id));
        return view('settings.project.set-region-edit', compact('data','company','project'));
    }

    public function region_store(RegionRequest $request)
    {
        // dd($request->all());
        $validate = $request->validate([
            'code' => 'unique:regions,code'
        ]);



        $data = $request->all();
        $data['is_active'] = 1;
        $data['code'] = strtoupper($request->code);

        $data['created_by'] = auth()->user()->name;
        Region::create($data);
        return redirect()->back()->with('success', 'New Region Created Successfully!');
    }

    public function region_update(Request $request, $id)
    {
        $data = $request->all();
        $data['updated_by'] = Auth::user()->name;
        $item = Region::findOrFail(decrypt($id));
        $item->update($data);
        return redirect(route('setting-region'))->with('success', 'Region Updated Successfully!');
    }

    public function region_delete ($id)
    {
        $data = Region::findOrFail($id);
         $data->is_active = 0;
        $data->save();
        return redirect()->back()->with('success', 'Region has been Delete!');
    }


    public function region_inactive ($id)
    {
        $data = Region::findOrfail(decrypt($id));
        $data->is_active = 0;
        $data->save();
        return redirect(route('setting-region'))->with('success', 'Region Deactivated!');
    }


    public function region_active ($id)
    {
        $data = Region::findOrfail(decrypt($id));
        $data->is_active = 1;
        $data->save();
        return redirect(route('setting-region'))->with('success', 'Region Activated!');
    }

    // collateral classes setting
    public function collateral_classes_index()
    {
        $view = CovisClasses::get();
        return view('settings.collateral.set-classes', compact('view'));
    }

    public function collateral_classes_edit($id)
    {
        $data = CovisClasses::findOrFail(decrypt($id));
        return view('settings.collateral.set-classes-edit', compact('data'));
    }

    public function collateral_classes_store(ClassesRequest $request)
    {

        CovisClasses::create([
            'code' => strtoupper($request->code),
            'name' => $request->name,
            'note' => $request->note,
            'is_active' => 1,
            'created_by' => auth()->user()->name
        ]);
        return redirect()->route('setting-covis-class')->with('success', 'New Collateral Classes Created Successfully!');
    }

    public function collateral_classes_update(Request $request, $id)
    {
        $data = $request->all();
        $data['updated_by'] = Auth::user()->name;
        $item = CovisClasses::findOrFail(decrypt($id));
        $item->update($data);
        return redirect(route('setting-covis-class'))->with('success', 'Collateral Classes Updated Successfully!');
    }


    public function collateral_classes_delete($id)
    {
        $data = CovisClasses::findOrFail(decrypt($id));
         $data->is_active = 0;
        $data->save();
        return redirect()->back()->with('success', 'Collateral classes has been deleted!');
    }

    public function classes_inactive ($id)
    {
        $data = CovisClasses::findOrfail(decrypt($id));
        $data->is_active = 0;
        $data->save();
        return redirect(route('setting-covis-class'))->with('success', 'Collateral Classes Deactivated!');
    }


    public function classes_active ($id)
    {
        $data = CovisClasses::findOrfail(decrypt($id));
        $data->is_active = 1;
        $data->save();
        return redirect(route('setting-covis-class'))->with('success', 'Collateral Classes Activated!');
    }

    // collateral type setting
    public function collateral_type_index()
    {
        $total = CovisType::all()->where('is_active', 1)->count();
        $view = CovisType::all();
        return view('settings.collateral.set-type', compact('total', 'view'));
    }

    public function collateral_type_edit($id)
    {
        $data = CovisType::findOrFail(decrypt($id));
        return view('settings.collateral.set-type-edit', compact('data'));
    }

    public function collateral_type_store(CovisTypeRequest $request)
    {
        $data = $request->all();
        $data['created_by'] = auth()->user()->name;
        $data['is_active'] = 1;
        $data['code'] = strtoupper($request->code);
        CovisType::create($data);
        return redirect()->back()->with('success', 'New Collateral Type Created Successfully!');
    }

    public function collateral_type_update(Request $request, $id)
    {
        $data = $request->all();
        $data['updated_by'] = Auth::user()->name;
        $item = CovisType::findOrFail(decrypt($id));
        $item->update($data);
        return redirect(route('setting-covis-type'))->with('success', 'Collateral Type Updated Successfully!');
    }

    public function type_inactive ($id)
    {
        $data = CovisType::findOrfail(decrypt($id));
        $data->is_active = 0;
        $data->save();
        return redirect(route('setting-covis-type'))->with('success', ' Collateral Type Deactivated!');
    }


    public function type_active ($id)
    {
        $data = CovisType::findOrfail(decrypt($id));
        $data->is_active = 1;
        $data->save();
        return redirect(route('setting-covis-type'))->with('success', ' Collateral Type Activated!');
    }

    public function collateral_type_delete($id)
    {
        $data = CovisType::findOrFail($id);
         $data->is_active = 0;
        $data->save();
        return redirect()->back()->with('success', 'Collateral type has been deleted!');
    }

    // collateral priority setting
    public function collateral_priority_index()
    {
        $total = CovisPriority::all()->where('is_active', 1)->count();
        $view = CovisPriority::all();
        return view('settings.collateral.set-priority', compact('total', 'view'));
    }

    public function collateral_priority_edit($id)
    {
        $data = CovisPriority::findOrFail(decrypt($id));
        return view('settings.collateral.set-priority-edit', compact('data'));
    }

    public function collateral_priority_store(PriorityRequest $request)
    {


        $data = $request->all();
        $data['is_active'] = 1;
        $data['code'] = strtoupper($request->code);
        $data['created_by'] = auth()->user()->name;
        CovisPriority::create($data);
        return redirect()->back()->with('success', 'New Collateral Priority Created Successfully!');
    }

    public function collateral_priority_update(Request $request, $id)
    {
        $data = $request->all();
        $data['updated_by'] = Auth::user()->name;
        $item = CovisPriority::findOrFail(decrypt($id));
        $item->update($data);
        return redirect(route('setting-covis-priority'))->with('success', 'Collateral Priority Updated Successfullt!');
    }

    public function priority_inactive ($id)
    {
        $data = CovisPriority::findOrfail(decrypt($id));
        $data->is_active = 0;
        $data->save();
        return redirect(route('setting-covis-priority'))->with('success', ' Collateral Priority Deactivated!');
    }


    public function priority_active ($id)
    {
        $data = CovisPriority::findOrfail(decrypt($id));
        $data->is_active = 1;
        $data->save();
        return redirect(route('setting-covis-priority'))->with('success', ' Collateral Priority Activated!');
    }

    public function collateral_priority_delete($id)
    {
        $data = CovisPriority::findOrFail($id);
         $data->is_active = 0;
        $data->save();
        return redirect()->back()->with('success', 'Collateral priority has been delete!');
    }

    // collateral condition setting
    public function collateral_condition_index()
    {
        $total = CovisCondition::all()->where('is_active', 1)->count();
        $view = CovisCondition::all();
        return view('settings.collateral.set-condition', compact('total', 'view'));
    }

    public function collateral_condition_edit($id)
    {
        $data = CovisCondition::find(decrypt($id));
        return view('settings.collateral.set-condition-edit', compact('data'));
    }

    public function collateral_condition_store(ConditionRequest $request)
    {

        $data = $request->all();
        $data['created_by'] = auth()->user()->name;
        $data['is_active'] = 1;
        $data['code'] = strtoupper($request->code);
        CovisCondition::create($data);
        return redirect()->back()->with('success', 'New Collateral Condition Created Successfully!');
    }


    public function collateral_condition_update(Request $request,  $id)
    {
        $data = $request->all();
        $data['updated_by'] = Auth::user()->name;
        $item = CovisCondition::findOrFail(decrypt($id));
        $item->update($data);
        return redirect('setting-covis-condition')->with('success', 'Collateral Condition Updated Successfully!');
    }

    public function condition_inactive ($id)
    {
        $data = Coviscondition::findOrfail(decrypt($id));
        $data->is_active = 0;
        $data->save();
        return redirect(route('setting-covis-condition'))->with('success', ' Collateral Condition Deactivated!');
    }


    public function condition_active ($id)
    {
        $data = CovisCondition::findOrfail(decrypt($id));
        $data->is_active = 1;
        $data->save();
        return redirect(route('setting-covis-condition'))->with('success', ' Collateral Condition Activated!');
    }

    public function collateral_condition_delete($id)
    {
        $data = CovisCondition::findOrFail($id);
         $data->is_active = 0;
        $data->save();
        return redirect()->back()->with('success', 'Collateral condition has been delete!');
    }

    // collateral used for setting
    public function collateral_used_for_index()
    {
        $total = CovisUsedFor::all()->where('is_active', 1)->count();
        $view = CovisUsedFor::all();
        return view('settings.collateral.set-used_for', compact('total', 'view'));
    }

    public function collateral_used_for_edit($id)
    {
        $data = CovisUsedFor::findOrFail(decrypt($id));
        return view('settings.collateral.set-used_for-edit', compact('data'));
    }

    public function collateral_used_for_store(UsedForRequest $request)
    {
        $data = $request->all();
        $data['code'] = strtoupper($request->code);
        $data['is_active'] = 1;
        $data['created_by'] = auth()->user()->name;
        CovisUsedFor::create($data);
        return redirect()->back()->with('success', 'New Collateral Used For Created Successfully!');
    }

    public function collateral_used_for_delete($id)
    {
        $data = CovisUsedFor::findOrFail(decrypt($id));
        $data->is_active = 0;
        $data->save();
        return redirect()->back()->with('success', 'Collateral Used For has been deleted!');
    }

    public function collateral_used_for_update(Request $request, $id)
    {
        $data = $request->all();
        $data['updated_by'] = auth()->user()->name;
        $data['code'] = strtoupper($request->code);
                $item = CovisUsedFor::findOrFail(decrypt($id));
        $item->update($data);
        return redirect('setting-covis-used-for')->with('success', 'Collateral Used For Updated Successfully!');
    }

    public function set_used_inactive($id)
    {
        $data = CovisUsedFor::findOrFail(decrypt($id));
        $data->is_active = 0;
        $data->save();
         return redirect('setting-covis-used-for')->with('success', 'Collateral Used For Deactivated!');
    }

    public function set_used_active($id)
    {
        $data = CovisUsedFor::findOrFail(decrypt($id));
        $data->is_active = 1;
        $data->save();
         return redirect('setting-covis-used-for')->with('success', 'Collateral Used For Activated!');
    }

    // collateral road access setting
    public function collateral_road_access_index()
    {
        $total = CovisAccessType::all()->where('is_active', 1)->count();
        $view = CovisAccessType::all();
        return view('settings.collateral.set-road_access', compact('total', 'view'));
    }

    public function collateral_road_access_edit($id)
    {
        $data = CovisAccessType::findOrFail(decrypt($id));
        return view('settings.collateral.set-road_access-edit', compact('data'));
    }

    public function collateral_road_access_store(AccessTypeRequest $request)
    {

        $data = $request->all();
        $data['is_active'] = 1;
        $data['code'] = strtoupper($request->code);
        $data['created_by'] = auth()->user()->name;
        CovisAccessType::create($data);
        return redirect()->back()->with('success', 'New Collateral Road Access Created Successfully!');
    }

    public function collateral_road_access_delete($id)
    {
        $data = CovisAccessType::findOrfail($id);
         $data->is_active = 0;
        $data->save();
        return redirect()->back()->with('success', 'Collateral road access setting has been deleted!');
    }

    public function collateral_road_access_update(Request $request, $id)
    {
        $data = $request->all();
        $data['updated_by'] = auth()->user()->name;
        $item = CovisAccessType::findOrFail(decrypt($id));
        $item->update($data);
        return redirect()->route('setting-road-access')->with('success', 'Collateral Road Access Updated Successfully!');
    }

    public function road_access_inactive($id)
    {
        $data = CovisAccessType::findOrFail(decrypt($id));
        $data->is_active = 0;
        $data->save();
         return redirect()->route('setting-road-access')->with('success', 'Collateral Road Access Deactivated!');
    }

    public function road_access_active($id)
    {
        $data = CovisAccessType::findOrFail(decrypt($id));
        $data->is_active = 1;
        $data->save();
         return redirect()->route('setting-road-access')->with('success', 'Collateral Road Access Activated!');
    }

    // user list setting
    public function user_index(Request $request)
    {
        $total = User::all()->where('is_active', 1)->count();
        $view = User::all();
        $view_adm = User::where('user_role_id', 7)->get();
        $view_spv = User::where('user_role_id', '>=', 4)->get();
        $view_head = User::where('user_role_id', '>=', 3)->get();
        $select1 = Company::where('is_active', 1)->get();
        $select2 = Department::where('is_active', 1)->get();
        $select3 = JobPosition::where('id', '>=', 3)->where('is_active', 1)->get();
        $select3_adm = JobPosition::where('id', 7)->where('is_active', 1)->get();
        $select3_spv = JobPosition::whereIn('id', [5, 6, 7])->where('is_active', 1)->get();
        $select4 = UserRole::where('id', '>=', 3)->where('is_active', 1)->get();
        $select4_adm = UserRole::where('id', 7)->where('is_active', 1)->get();
        $select4_spv = UserRole::whereIn('id', [5, 6, 7])->where('is_active', 1)->get();
        return view('settings.users.set-user', compact('total', 'view', 'view_adm', 'view_spv', 'view_head', 'select1', 'select2', 'select3', 'select3_adm', 'select3_spv', 'select4', 'select4_adm', 'select4_spv'));
    }

    public function user_show()
    {
        return view('settings.users.set-user-show');
    }

    public function user_store(UserRequest $request)
    {
        $file = $request->file('ttd_users');
        // dd($file);
        $name = $request->input('name') . '.' . $file->getClientOriginalExtension();
        $user = User::create([
            'nip' => $request->input('nip'),
            'name' => $request->input('name'),
            'company_id' => $request->input('company_id'),
            'department_id' => $request->input('department_id'),
            'job_position_id' => $request->input('job_position_id'),
            'username' => $request->input('username'),
            'email' => $request->input('email'),
            'ttd_users' => $name,
            'mobile_no' => $request->input('mobile_no'),
            'password' => Hash::make($request->input('password')),
            'user_role_id' => $request->input('user_role_id'),
            'is_active' => 1,
            'created_by' => Auth::user()->name,
        ]);
        $file->move(public_path('images/tanda_tangan/'), $name);

        $user_image = UserImage::create([
            'user_id' => $user->id,
            'name' => 'unknown.png',
            'created_by' => Auth::user()->name
        ]);

        $user_detail = UserDetail::create([
            'user_id' => $user->id,
            'created_by' => Auth::user()->name
        ]);
        
        $role = Role::find($request->input('user_role_id'));
        $user->assignrole($role->name);

        return redirect()->back()->with('success', 'New User Created Successfully!');
    }

    public function set_user_edit ($id)
    {
        $data = User::with(['user_image','user_role','jobPosition'])->where('id', $id)->firstOrFail();
        return view('settings.users.set-user-edit', compact('data'));
    }

    public function user_update()
    {
        //

    }

    public function user_inactive($id)
    {
        $data = User::findOrFail(decrypt($id));
        $data->is_active = 0;
        $data->save();
        return redirect()->back();
    }

    public function user_active($id)
    {
        $data = User::findOrFail(decrypt($id));
        $data->is_active = 1;
        $data->save();
        return redirect()->back();
    }

    // user role setting
    public function user_role_index()
    {
        $total = UserRole::all()->where('is_active', 1)->count();
        $view = UserRole::all();
        return view('settings.users.set-user_role', compact('total', 'view'));
    }

    public function user_role_store(RoleRequest $request)
    {
        // dd($request->all());



        $data = $request->all();
        $data['created_by'] = auth()->user()->name;
        $data['is_active'] = 1;
        $data['code'] = strtoupper($request->code);
        UserRole::create($data);
        return redirect()->back()->with('success', 'user role has been created!');
    }

    public function collateral_user_role_delete($id)
    {
        $data  = UserRole::findOrFail($id);
         $data->is_active = 0;
        $data->save();
        return redirect()->back()->with('success', 'user role has been deleted!');
    }

    public function role_edit ($id)
    {
        $data = UserRole::findOrFail($id);
        return view('settings.users.set-user_role-edit', compact('data'));
    }

    public function role_update(Request $request, $id)
    {
        $data = $request->all();
        $data['updated_by'] = auth()->user()->name;
        $item = UserRole::findOrFail($id);
        $item->update($data);
        return redirect()->back()->with('success', 'User Role has been Updated!');
    }


    public function changePasswordListUser($id)
    {
        $data = User::find(decrypt($id));
        return view('settings.users.list-user-edit', compact('data'));
    }

    public function postChangeListUserPassword(Request $request, $id)
    {
        $validate = $request->validate([
            'password' => [
                'required',
                'string',
                'regex:/[0-9]/'
            ]
        ]);
        // dd($request->all());
        $user = User::findOrFail(decrypt($id));
        $user->update([
            'password' => Hash::make($request->password)
        ]);

        return redirect(route('setting-user'))->with(['success' => 'Password Changed Successfully!']);
    }
}
