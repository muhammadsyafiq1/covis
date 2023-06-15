<?php

namespace App\Http\Controllers;

use App\Imports\CovisCustomerImport;
use App\Imports\CovisOrderImport;
use Illuminate\Http\Request;
use App\Models\CovisCustomer;
use App\Models\User;
use App\Models\Company;
use App\Models\Branch;
use App\Models\Project;
use App\Models\Region;
use App\Models\CovisType;
use App\Models\CovisClasses;
use App\Models\CovisPriority;
use App\Models\CovisTransaction;
use App\Models\CovisTransactionImage;
use Laravolt\Indonesia\Models\Province;
use Laravolt\Indonesia\Models\City;
use Laravolt\Indonesia\Models\District;
use Carbon\Carbon;
use PhpOffice\PhpSpreadsheet\Worksheet\Row;
use Ramsey\Uuid\Uuid;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Datatables;


class CovisController extends Controller
{
    
    public function order_add_import()
    {
        return view('covis.order-add-import');
    }
    
    
    public function deletecustomer(Request $request)
    {
        // dd($request->all());
        if($request->id == null){
            return redirect()->back()->with(['error' => 'Please Check the Checkbox!']);
        } else {
            $ids = $request->id;
            foreach($ids as $id){
                $row = CovisCustomer::find($id);
                $row->delete();
            }
            return redirect()->back()->with(['success' => 'Customer has been Deleted!']);
        }
    }
    
    public function customer_new_search()
    {
        $customer = CovisCustomer::count();
        return view('covis.customer-new-search', compact('customer'));
    }
    
    public function customer_search (Request $request)
    {
        //1 = realtime 0 = upload
        $surveyor = User::whereIn('user_role_id', [7, 8])->where('is_active', 1)->orderBy('username', 'asc')->get();
        $classification = CovisClasses::pluck('name', 'id');
        $priority = CovisPriority::pluck('name', 'id');
        
        // $keyword = $request->keyword;

        // if($keyword == 'upload'){
        //     $customerdata = CovisCustomer::with('provinceCustomer', 'cityCustomer', 'districtCustomer')->where(function ($query) use($keyword) {
        //         $query->where('mode', 'like', '%' . 0 . '%');
        //     })
        //     ->get();
        //     $customer = $customerdata->count();
        //     return view('covis.customer-search', compact('customer','surveyor','classification','priority','customerdata'));

        // } else if($keyword == 'realtime') {
        //     $customerdata = CovisCustomer::with('provinceCustomer', 'cityCustomer', 'districtCustomer')->where(function ($query) use($keyword) {
        //         $query->where('mode', 'like', '%' . 1 . '%');
        //     })
        //     ->get();
        //     $customer = $customerdata->count();
        //     return view('covis.customer-search', compact('customer','surveyor','classification','priority','customerdata'));

        // } else if($keyword) {
        //     $customerdata = CovisCustomer::with('provinceCustomer', 'cityCustomer', 'districtCustomer')->where(function ($query) use($keyword) {
        //         $query->where('name', 'like', '%' . $keyword . '%')
        //               ->orWhere('address', 'like', '%' . $keyword . '%')
        //               ->orWhere('code', 'like', '%' . $keyword . '%');
        //     })
        //     ->get();
        //     $customer = $customerdata->count();
        //     return view('covis.customer-search', compact('customer','surveyor','classification','priority','customerdata'));

        // } else {
        //     $customerdata = [];
        //     $customer = 0;
        //     return view('covis.customer-search', compact('customer','surveyor','classification','priority','customerdata'));
        // }

        $keyword = $request->keyword;

        $customerdata = CovisCustomer::with('provinceCustomer', 'cityCustomer', 'districtCustomer');

        if ($keyword == 'upload') {
            $customerdata = $customerdata->where('mode', 'like', '%' . 0 . '%');
        } else if ($keyword == 'realtime') {
            $customerdata = $customerdata->where('mode', 'like', '%' . 1 . '%');
        } else if ($keyword) {
            $customerdata = $customerdata->where(function ($query) use ($keyword) {
                $query->where('name', 'like', '%' . $keyword . '%')
                    ->orWhere('address', 'like', '%' . $keyword . '%')
                    ->orWhere('code', 'like', '%' . $keyword . '%');
            });
        } else {
            $customerdata = [];
            $customer = 0;
            return view('covis.customer-search', compact('customer','surveyor','classification','priority','customerdata'));
        }

        $customerdata = $customerdata->get();
        $customer = $customerdata->count();
        return view('covis.customer-search', compact('customer', 'surveyor', 'classification', 'priority', 'customerdata'));

    }
    
    public function customer_index()
    {
        // $view = CovisCustomer::orderBy('created_at', 'DESC')->get();
        $surveyor = User::whereIn('user_role_id', [7, 8])->where('is_active', 1)->orderBy('username', 'asc')->get();
        $customer = CovisCustomer::count();
        $classification = CovisClasses::pluck('name', 'id');
        $priority = CovisPriority::pluck('name', 'id');
        // dd($view);
        return view('covis.customer', compact('surveyor', 'customer', 'classification', 'priority'));
    }
    
    public function customer_list_json()
    {
        $customer = DB::table('covis_customers as a')
        ->leftJoin('companies as b','a.company_id', 'b.id')
        ->leftJoin('projects as c','a.project_id', 'c.id')
        ->leftJoin('branchs as d','a.branch_id', 'd.id')
        ->leftJoin('regions as e','a.region_id', 'e.id')
        ->leftJoin('covis_types as f','a.covis_type_id', 'f.id')
        ->leftJoin('indonesia_cities as g','a.city_code', 'g.code')
        ->leftJoin('indonesia_districts as h','a.district_code', 'h.code')
        ->select('a.code as code','a.name as name','b.name as company_name',
        'c.name as project_name','d.name as branch_name','e.name as region_name',
        'f.name as types_name','g.name as city_name','a.address as address','a.contact_name as contact_name',
        'a.contact_no as contact_no','a.ao_name as ao_name','a.ao_no as ao_no',
        'c.code as project_code','d.name as branch_name','e.name as region_name','g.name as city_name','f.name as type_name','a.id as customer_id',
        'd.id as branch_id', 'h.name as district_name')
        ->orderBy('a.name', 'asc')
        ->get();

        return Datatables::of($customer)->make();
    }

    public function customer_add()
    {
        $code = CovisCustomer::generateUniqueCode();
        $company = Company::pluck('name', 'id');
        $project = Project::pluck('name', 'id');
        $region = Region::pluck('name', 'id');
        $branch = Branch::pluck('name', 'id');
        $type = CovisType::pluck('name', 'id');
        $province = \Indonesia::allProvinces()->whereIn('code', [31, 32, 33, 34, 35, 36])->pluck('name', 'code');
        // dd(auth()->user()->name);
        return view('covis.customer-add', compact('company', 'project', 'branch', 'type', 'province','region', 'code'));
    }
    
    public function postCustomer(Request $request)
    {
        CovisCustomer::create([
            'code' => CovisCustomer::generateUniqueCode(),
            'company_id' => $request->company_id,
            'project_id' => $request->project_id,
            'branch_id' => $request->branch_id,
            'region_id' => $request->region_id,
            'name' => $request->name,
            'covis_type_id' => $request->covis_type_id,
            'address' => $request->address,
            'province_code' => $request->province_code,
            'city_code' => $request->city_code,
            'district_code' => $request->district_code,
            'contact_name' => $request->contact_name,
            'contact_office_no' => MiscellaneousController::formatOfficeNumber($request->contact_office_no),
            'contact_no' => MiscellaneousController::formatPhoneNumber($request->contact_no),
            'contact_no_second' => MiscellaneousController::formatPhoneNumber($request->contact_no_second),
            'ao_name' => $request->ao_name,
            'ao_no' => MiscellaneousController::formatPhoneNumber($request->ao_no),
            // 'termination_date' => Carbon::parse($request->termination_date),
            // 'note' => $request->note,
            'is_active' => 1,
            'created_by' => auth()->user()->name,
        ]);

        return redirect('customer-new-table')->with(['success' => 'Customer has been created']);
    }

    public function importCustomerExcel(Request $request)
    {
        $this->validate($request, [
			'file' => 'required|mimes:csv,xls,xlsx'
		]);

		$file = $request->file('file');

        try {
            $import = Excel::import(new CovisCustomerImport, $file);

            return back()->with(['success' => 'Customer successfully imported']);

        } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
            $failures = $e->errors();
            foreach ($failures as $failure) {

                return back()->with(['error' => $failure[0]]);
            }
        }
    }
    
    public function importOrderExcel(Request $request)
    {
        $this->validate($request, [
			'file' => 'required|mimes:csv,xls,xlsx'
		]);

        $file = $request->file('file');

        try {
            $import = Excel::import(new CovisOrderImport, $file);
            return back()->with(['success' => 'Customer successfully imported']);
        } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
            $failures = $e->errors();
            foreach ($failures as $failure) {

                return back()->with(['error' => $failure[0]]);
            }
        }
    }

    public function customer_add_import()
    {
        return view('covis.customer-add-import');
    }

    public function customer_view($id)
    {
        // dd($id);
        $totalOrder = CovisTransaction::where('covis_customer_id', $id)->count();
        $totalOrderCompleted = CovisTransaction::where('covis_customer_id', $id)->where('status', 5)->count();
        $totalOrderInProgress = CovisTransaction::where('covis_customer_id', $id)->where('status', 3)->count();
        $customer = CovisCustomer::with('provinceCustomer', 'cityCustomer', 'districtCustomer', 'transaction')->findOrFail($id);
        $province = Province::pluck('name', 'code');
        $city = City::where('province_code', $customer->province_code)->pluck('name', 'code');
        $district = District::where('city_code', $customer->city_code)->pluck('name', 'code');
        // transaction per customer detail(
        $transactionCustomer = CovisTransaction::with('transactionImage')->where('covis_customer_id', $id)->where('status', 5)->get();
        // dd($customer->transaction[0]->transactionImage);

        // dd($province);
        return view('covis.customer-view', compact('customer', 'province', 'city', 'district','totalOrder','totalOrderCompleted','totalOrderInProgress', 'transactionCustomer'));
    }

    public function updateCustomer(Request $request, $id)
    {
        $customer = CovisCustomer::findOrFail($id);
        $customer->update([
            'name' => $request->name,
            'contact_name' => $request->contact_name,
            'contact_no' => MiscellaneousController::formatPhoneNumber($request->contact_no),
            'contact_office_no' => MiscellaneousController::formatOfficeNumber($request->contact_office_no),
            'ao_name' => $request->ao_name,
            'ao_no' => MiscellaneousController::formatPhoneNumber($request->ao_no),
            'address' => $request->address,
            'province_code' => $request->province_code,
            'city_code' => $request->city_code,
            'district_code' => $request->district_code,
            'updated_by' => auth()->user()->name
        ]);

        return back()->with(['success' => 'Customer has been updated']);
    }


    public function updateNoteCustomer(Request $request)
    {
        $transaction = CovisTransaction::findOrFail($request->idTransaction);
        $cs = CovisCustomer::findOrFail($transaction->customer->id);
        // dd($cs);
        $transaction->update([
                'admin_note' => $request->note,
                'updated_by' => auth()->user()->name
            ]);
        // $cs->note = $request->note;
        // $cs->created_by = auth()->user()->name;
        // $cs->save();
        return back()->with(['success' => 'Customer note completed updated!']);
    }

    public function storeTransaction(Request $request)
    {
        // dd($request->all());
        $uid = Uuid::uuid4();
        $transaction = CovisTransaction::create([
            'covis_customer_id' => $request->covis_customer_id,
            'branch_id' => $request->covis_customer_branch_id,
            'termination_date' => Carbon::parse($request->termination_date),
            'covis_class_id' => $request->covis_class_id,
            'covis_priority_id' => $request->covis_priority_id,
            'user_id' => $request->user_id,
            'status' => 1,
            'created_by' => auth()->user()->name,
            'uuid' => $uid->toString(),
            'admin_note' => $request->admin_note,
            'visit_status' => 1,
            'backdate' => $request->backdate,
        ]);

        $transaction_image = CovisTransactionImage::create([
            'covis_transaction_id' => $transaction->id,
        ]);
        return redirect(route('transaction-request'))->with(['success' => 'Customer Request successfully added!']);
    }

    public function transaction_request()
    {
        $tobeconfirm = CovisTransaction::where('status', 1)->where('visit_status', 1)->count();
        $tobeapproval = CovisTransaction::where('status', 2)->where('visit_status', 1)->count();
        $inproggress = CovisTransaction::where('status', 3)->where('visit_status', 1)->count();
        $surveyor = User::where('user_role_id', 7)->where('is_active', 1)->orderBy('username', 'asc')->get();
        $classification = CovisClasses::pluck('name', 'id');
        $priority = CovisPriority::pluck('name', 'id');
        $transaction = CovisTransaction::with('customer.cityCustomer')->whereIn('status', [1,2,3])->where('visit_status', 1)->get(); 
        return view('covis.request', compact('transaction','surveyor','classification','priority','tobeconfirm','tobeapproval','inproggress'));
    }
    
    public function list_request_customer()
    {

        $transaction = DB::table('covis_transactions as a')
        ->leftJoin('covis_classes as b','a.covis_class_id', 'b.id')
        ->leftJoin('covis_customers as c','a.covis_customer_id', 'c.id')
        ->leftJoin('branchs as d','c.branch_id', 'd.id')
        ->leftJoin('regions as e','c.region_id', 'e.id')
        ->leftJoin('covis_types as f','c.covis_type_id', 'f.id')
        ->leftJoin('indonesia_districts as g','c.district_code', 'g.code')
        ->leftJoin('indonesia_provinces as h','c.province_code', 'h.code')
        ->leftJoin('users as i','a.user_id', 'i.id')
        ->leftJoin('indonesia_cities as j','c.city_code','j.code')

        ->select('b.id as classes_id','b.code as class_code','c.name as customer_name','d.name as branch_name','e.name as region_name','f.name as covis_type_name','h.name as province_name','g.name as district_name','j.name as city_name','c.contact_name as contact_name','c.contact_no as contact_no','c.ao_no as ao_no','a.termination_date as termination_date','a.status as status_tarnsaction','i.name as surveyor','a.uuid as uuid','a.id as tran_id','i.id as user_id','c.ao_name as ao_name','c.id as customer_id')
        ->where('visit_status', 1)
        ->whereIn('status', [1, 3])
        ->get();

        return Datatables::of($transaction)->make();
        
    }

    public function transaction_request_view($uuid)
    {
        $customerTransaction = CovisTransaction::where('uuid', $uuid)->first(); 
        $customer = CovisCustomer::where('id', $customerTransaction->covis_customer_id)->first(); 
        $province = Province::pluck('name', 'code'); 
        $city = City::where('province_code', $customer->province_code)->pluck('name', 'code');
        $district = District::where('city_code', $customer->city_code)->pluck('name', 'code');
        $totalOrder = CovisTransaction::where('uuid', $uuid)->count(); 
        $totalOrderCompleted = CovisTransaction::where('uuid', $uuid)->where('status', 5)->count(); 
        $totalOrderInProgress = CovisTransaction::where('uuid', $uuid)->where('status', 3)->count(); 
        $transaction = CovisTransaction::where('uuid', $uuid)->first();

        return view('covis.request-view', compact('transaction','totalOrder','totalOrderCompleted','totalOrderInProgress','province','city','district','customerTransaction'));
    }

    public function transaction_confirmation()
    {
        if(\Auth::user()->user_role_id == 8)
        {
            $transaction = CovisTransaction::whereHas('surveyor', function ($query) {
            $query->where('team_id', '=', \Auth::user()->team_id);
            })
            ->where('status', 1)
            ->where('visit_status', 1)
            ->get();
        }else{
            $transaction = CovisTransaction::where('status', 1)->where('visit_status', 1)->get();
        }
        return view('covis.confirmation', compact('transaction'));
    }

    public function transaction_to_be_confirm_to_waiting_approval (Request $request)
    {
        $data = CovisTransaction::where('id', $request->covisTransaction_id)->firstOrFail();
        $data->status = 2;
        $data->save();
        return redirect()->back()->with(['success' => 'Confirm status change to waiting approval successfully!']);
    }

    public function transaction_waiting_approval_to_approval(Request $request)
    {
        $data = CovisTransaction::where('id', $request->covisTransaction_id)->firstOrFail();
        $data->status = 3;
        $data->save();
        return redirect()->back()->with(['success' => 'Waiting approval status change to approval successfully!']);
    }

    public function transaction_confirmation_view($uuid)
    {
        $customerTransaction = CovisTransaction::where('uuid', $uuid)->first(); 
        $customer = CovisCustomer::where('id', $customerTransaction->covis_customer_id)->first(); 
        $province = Province::pluck('name', 'code'); 
        $city = City::where('province_code', $customer->province_code)->pluck('name', 'code');
        $district = District::where('city_code', $customer->city_code)->pluck('name', 'code');
        $totalOrder = CovisTransaction::where('uuid', $uuid)->count(); 
        $totalOrderCompleted = CovisTransaction::where('uuid', $uuid)->where('status', 5)->count(); 
        $totalOrderInProgress = CovisTransaction::where('uuid', $uuid)->where('status', 3)->count(); 
        $transaction = CovisTransaction::where('uuid', $uuid)->first();
        return view('covis.confirmation-view', compact('transaction','totalOrder','totalOrderCompleted','totalOrderInProgress','province','city','district','customerTransaction'));
    }

    public function transaction_approval()
    {
        $transaction = CovisTransaction::where('status', 2)->where('visit_status', 1)->get();
        return view('covis.approval', compact('transaction'));
    }

    public function transaction_approval_view($uuid)
    {
        $customerTransaction = CovisTransaction::where('uuid', $uuid)->first(); 
        $customer = CovisCustomer::where('id', $customerTransaction->covis_customer_id)->first(); 
        $province = Province::pluck('name', 'code'); 
        $city = City::where('province_code', $customer->province_code)->pluck('name', 'code');
        $district = District::where('city_code', $customer->city_code)->pluck('name', 'code');
        $totalOrder = CovisTransaction::where('uuid', $uuid)->count(); 
        $totalOrderCompleted = CovisTransaction::where('uuid', $uuid)->where('status', 5)->count(); 
        $totalOrderInProgress = CovisTransaction::where('uuid', $uuid)->where('status', 3)->count(); 
        $transaction = CovisTransaction::where('uuid', $uuid)->first();
        return view('covis.approval-view', compact('transaction','totalOrder','totalOrderCompleted','totalOrderInProgress','province','city','district','customerTransaction'));
    }

    public function transaction_complete()
    {

        $transactionComplete = CovisTransaction::where('status', 3)
                                                ->where(function($q) {
                                                    $q->orWhere('is_revision', 2);
                                                    $q->orWhereNull('is_revision');
                                                    $q->where('visit_status', 2);
                                                })
                                                 ->whereYear('visited_at', date('Y'))
                                                ->get(); 
        
        return view('covis.complete', compact('transactionComplete'));
    }

    // 
    public function filterTransactionComplete (Request $request)
    {
        $start = $request->startdate;
        $end = $request->enddate;
        $keyword = $request->keyword;
        $result = CovisTransaction::where('status', 3)
                                                ->with('customer')
                                                ->where(function($q) {
                                                    $q->where('visit_status', 2);
                                                })
                                                ->whereBetween(DB::raw('DATE(visited_at)'), array($start, $end))
                                                ->get();

        return view('covis.complete-transaction', compact('result','start','end'));
    }
    // 

    public function transaction_revision()
    {
        $surveyor = User::whereIn('user_role_id', [7, 8])->where('is_active', 1)->orderBy('username', 'asc')->get();
        $transaction = CovisTransaction::where('status', 3)
                                                ->where(function($q) {
                                                    $q->orWhere('is_revision', 2);
                                                    $q->orWhere('is_revision', 1);
                                                    $q->where('visit_status', 2);
                                                })->get();  
        return view('covis.revision', compact('transaction','surveyor'));
    }
    
    public function transaction_complete_json()
    {
        $transactionComplete = CovisTransaction::with('surveyor','class','customer.covisType','customer.branch','customer.region','customer.cityCustomer','customer.districtCustomer', 'customer.provinceCustomer','customer.project')->where('status', 3)
                        ->where(function($q){$q
                        ->orWhere('is_revision', 2);
                            $q->orWhereNull('is_revision'); 
                            $q->where('visit_status', 2);})
                        ->whereYear('visited_at', date('Y'))
                        ->orderBy('visited_at', 'DESC')
                        ->get();

        return Datatables::of($transactionComplete)->make();
    }

    public function transaction_complete_view($uuid)
    {
        $item = CovisTransaction::where('uuid', $uuid)->firstOrFail();
        return view('covis.complete-view', compact('item'));
    }

    public function printTransaction($id)
    {
        $transaction = CovisTransaction::with('transactionImage', 'customer', 'surveyor', 'covisCondition', 'covisUsedFor', 'covisRoadAccess')->find($id); 
        $address = ucwords($transaction->customer->address);
        $admin = User::where('job_position_id', 6)->where('is_active', 1)->first();
        // dd($transaction);
        $pdf = PDF::loadView('pdf.report-pdf', compact('transaction', 'address', 'admin'))->setPaper('a4', 'landscape');
        return $pdf->stream('report.pdf');
        // return view('pdf.report-pdf', compact('transaction', 'address', 'admin'));
    }


    
    public function transaction_revision_json()
    {
        $transactionRevision = CovisTransaction::with('surveyor','class','customer.covisType','customer.branch','customer.region','customer.cityCustomer','customer.districtCustomer','customer.provinceCustomer')
                        ->where('status', 3)
                        ->where(function($q){$q
                        ->orWhere('is_revision', 1);
                            $q->where('visit_status', 2);})
                        ->get();

        return Datatables::of($transactionRevision)->make();
    }

    public function transaction_customer_revision(Request $request)
    {
        // dd($request->all());
        $data = CovisTransaction::findOrFail($request->id);
        $data->is_revision = 1;
        $data->revision_note = $request->revision_note;
        $data->save();

        $transactionImage = CovisTransactionImage::where('covis_transaction_id', $request->id)->first(); 
        // $transactionImage->photo_front2 = null;
        // $transactionImage->photo_front1 = null;
        // $transactionImage->photo_left = null;
        // $transactionImage->photo_right = null;
        // $transactionImage->save();
        $transactionImage->update([
           'photo_front1' => '',
           'photo_front2' => '',
           'photo_left' => '',
           'photo_right' => ''
        ]);

       return redirect()->route('transaction-revision')->with(['success' => 'Transaction Customer Revision!']);
    }

    public function transaction_revision_view($uuid)
    {
        $transaction = CovisTransaction::where('uuid', $uuid)->first(); 
        return view('covis.revision-view', compact('transaction'));
    }




    // FOR AJAX
    public function getBranch($param)
    {
        $branch = Branch::where('region_id', $param)->pluck('name', 'id');
        return response()->json($branch);
    }

    public function getRegion($param)
    {
        $region = Region::where('project_id', $param)->pluck('name', 'id');
        return response()->json($region);
    }

    public function getCities($param)
    {
        $cities = City::where('province_code', $param)->orderBy('name', 'ASC')->pluck('name', 'code');
        return response()->json($cities);
    }

    public function getDistricts($param)
    {
        $districts = District::where('city_code', $param)->orderBy('name')->pluck('code', 'name');
        return response()->json($districts);
    }

    public function confirmAll(Request $request)
    {

        if($request->id == null){
            return redirect()->back()->with(['error' => 'Please Check the Checkbox!']);
        } else {
            $ids = $request->id;
            foreach($ids as $id){
                $row = CovisTransaction::find($id);
                    //   dd($row);
                    $row->status = 3;
                    $row->save();
            }
            return redirect()->back()->with(['success' => 'Transaction has been approved!']);
        }
       
    }

    // public function confirmationAll(Request $request)
    // {
    //     $ids = $request->id;

    //     foreach($ids as $id){
    //         $row = CovisTransaction::find($id);
    //          //   dd($row);
    //          $row->status = 2;
    //          $row->save();
    //     }
    //     return redirect()->back()->with(['success' => 'Transaction has been Confirmation!']);
    // }
    
        public function confirmationAll(Request $request)
    {

        if($request->id == null){
            return redirect()->back()->with(['error' => 'Please Check the Checkbox!']);
        } else {
            $ids = $request->id;
            foreach($ids as $id){
                $row = CovisTransaction::find($id);
                $row->status = 2;
                $row->save();
            }
            return redirect()->back()->with(['success' => 'Transaction has been Confirmation!']);
        }
       
    }
    
    public function transaction_order_cancel (Request $request)
    {
        // dd($request->all());
        $data = CovisTransaction::findOrFail($request->id); 
        $data->cancel_note = $request->cancel_note;
        $data->status = 4;
        $data->save();
        return redirect()->back()->with(['success' => 'Transaction has been canceled!']);
    }

    public function transaction_cancel(Request $request)
    {
        // dd($request->all());
        $data = CovisTransaction::findOrFail($request->id);
        $data->cancel_note = $request->cancel_note;
        $data->status = 4;
        $data->save();
        return redirect()->back()->with(['success' => 'Transaction has been canceled!']);
    }
    
    // public function transaction_auto_complete(Request $request)
    // {
    //     $data = CovisTransaction::findOrFail($request->id);
    //     $data->cancel_note = $request->cancel_note;
    //     $data->visit_status = 2;
    //     $data->save();
    //     return redirect()->back();
    // }
    
    public function transactionBackdate(Request $request)
    {
        $transaction = CovisTransaction::findOrFail($request->transaction_id);
        $transaction->backdate = Carbon::parse($request->reported_at);
        $transaction->save();
        return redirect()->back()->with(['success' => 'Transaction Backdate has been updated!']);
    }
    
    public function customer_delete(Request $request)
    {
        $rowTransaction = CovisTransaction::where('covis_customer_id', $request->covis_customer_id)->first();
        
        if(!$rowTransaction){
            $data = CovisCustomer::findOrFail($request->covis_customer_id);
            $data->delete();
            return redirect()->back()->with(['success' => 'Customer has been deleted!']);
        } else {
            return redirect()->back()->with(['error' => 'Customer cant deleted!']);
        }
    }
    
    public function reAssign(Request $request)
    {
        // dd($request->all());
        $transaction = CovisTransaction::where('id', $request->idtransaction)->first(); 
        $transaction->user_id = $request->user_id;
        $transaction->save();
        return redirect()->back()->with(['success' => 'Re Assign Completed!']);
    }

    public function update_mode_customer (Request $request)
    {
        $data = $request->all(); 
        $data = CovisCustomer::findOrfail($request->covis_customer_id);
        $data->mode  = $request->mode;
        $data->save();
        return redirect()->back();
    }
}
