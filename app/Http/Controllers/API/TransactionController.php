<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\ResponseFormatter;
use App\Http\Controllers\CovisController;
use App\Models\CovisTransaction;
use App\Models\CovisTransactionImage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Laravolt\Indonesia\Models\Province;
use Laravolt\Indonesia\Models\City;
use Laravolt\Indonesia\Models\District;
use Carbon\Carbon;
use Image;

class TransactionController extends Controller
{
    public function unscheduled_task()
    {
        // $transaction = CovisTransaction::with([
        //     'class','customer','covisPriority'
        // ])
        //     ->where('status', 3)
        //     ->where('scheduled_date', null)
        //     ->where('user_id', Auth::user()->id)
        //     ->get();

        $transaction = DB::table('covis_transactions as a')
                        ->leftJoin('covis_customers as b', 'a.covis_customer_id', 'b.id')
                        ->leftJoin('covis_classes as c', 'a.covis_class_id', 'c.id')
                        ->leftJoin('covis_priorities as d', 'a.covis_priority_id', 'd.id')
                        ->leftJoin('branchs as e', 'b.branch_id', 'e.id')
                        ->leftJoin('regions as f', 'b.region_id', 'f.id')
                        ->leftJoin('covis_types as g', 'b.covis_type_id', 'g.id')
                        ->leftJoin('indonesia_provinces as h', 'b.province_code', 'h.code')
                        ->leftJoin('indonesia_cities as i', 'b.city_code', 'i.code')
                        ->leftJoin('indonesia_districts as j', 'b.district_code', 'j.code')
                        ->select(
                            'a.id', 'a.termination_date', 'a.uuid', 'a.scheduled_date',  'c.code as class_code', 'c.name as class_name',
                            'd.code as priority_code', 'd.name as priority_name', 'b.code as customer_code',
                            'b.name as customer_name', 'b.address as customer_address', 'b.contact_name as customer_contact_name',
                            'b.contact_no as customer_contact_no', 'b.ao_name as customer_ao_name', 'b.ao_no as customer_ao_no',
                            'e.name as customer_branch', 'f.name as customer_region', 'g.name as customer_covis_type',
                            'h.name as customer_province', 'i.name as customer_city', 'j.name as customer_district','a.admin_note as admin_note'
                        )->whereIn('status', [1,3])->where('visit_status', 1)->where('user_id', Auth::user()->id)->get();

        return ResponseFormatter::success($transaction, 'Unscheduled task successfully generated');
    }

    public function detailUnscheduledTask(Request $request)
    {
        // $transaction = CovisTransaction::with([
        //     'class','customer','covisPriority'
        // ])->findOrFail($request->id);

        $transaction = DB::table('covis_transactions as a')
                        ->leftJoin('covis_customers as b', 'a.covis_customer_id', 'b.id')
                        ->leftJoin('covis_classes as c', 'a.covis_class_id', 'c.id')
                        ->leftJoin('covis_priorities as d', 'a.covis_priority_id', 'd.id')
                        ->leftJoin('branchs as e', 'b.branch_id', 'e.id')
                        ->leftJoin('regions as f', 'b.region_id', 'f.id')
                        ->leftJoin('covis_types as g', 'b.covis_type_id', 'g.id')
                        ->leftJoin('indonesia_provinces as h', 'b.province_code', 'h.code')
                        ->leftJoin('indonesia_cities as i', 'b.city_code', 'i.code')
                        ->leftJoin('indonesia_districts as j', 'b.district_code', 'j.code')
                        ->select(
                            'a.id', 'a.termination_date', 'a.uuid', 'c.code as class_code', 'c.name as class_name',
                            'd.code as priority_code', 'd.name as priority_name', 'b.code as customer_code',
                            'b.name as customer_name', 'b.address as customer_address', 'b.contact_name as customer_contact_name',
                            'b.contact_no as customer_contact_no', 'b.ao_name as customer_ao_name', 'b.ao_no as customer_ao_no',
                            'e.name as customer_branch', 'f.name as customer_region', 'g.name as customer_covis_type',
                            'h.name as customer_province', 'i.name as customer_city', 'j.name as customer_district'
                        )->where('a.id', $request->id)
                        ->first();

        return ResponseFormatter::success($transaction, 'Unscheduled tas successfully generated');
    }

    public function scheduled_task()
    {
        // $transaction = CovisTransaction::with([
        //     'class','customer','covisPriority'
        // ])
        //     ->where('status', 3)
        //     ->where('scheduled_date', '!=', null)
        //     ->where('user_id', Auth::user()->id)
        //     ->get();

        $transaction = DB::table('covis_transactions as a')
                        ->leftJoin('covis_customers as b', 'a.covis_customer_id', 'b.id')
                        ->leftJoin('covis_classes as c', 'a.covis_class_id', 'c.id')
                        ->leftJoin('covis_priorities as d', 'a.covis_priority_id', 'd.id')
                        ->leftJoin('branchs as e', 'b.branch_id', 'e.id')
                        ->leftJoin('regions as f', 'b.region_id', 'f.id')
                        ->leftJoin('covis_types as g', 'b.covis_type_id', 'g.id')
                        ->leftJoin('indonesia_provinces as h', 'b.province_code', 'h.code')
                        ->leftJoin('indonesia_cities as i', 'b.city_code', 'i.code')
                        ->leftJoin('indonesia_districts as j', 'b.district_code', 'j.code')
                        ->select(
                            'a.id', 'a.termination_date', 'a.scheduled_date',  'a.uuid', 'c.code as class_code', 'c.name as class_name',
                            'd.code as priority_code', 'd.name as priority_name', 'b.code as customer_code',
                            'b.name as customer_name', 'b.address as customer_address', 'b.contact_name as customer_contact_name',
                            'b.contact_no as customer_contact_no', 'b.ao_name as customer_ao_name', 'b.ao_no as customer_ao_no',
                            'e.name as customer_branch', 'f.name as customer_region', 'g.name as customer_covis_type',
                            'h.name as customer_province', 'i.name as customer_city', 'j.name as customer_district','a.admin_note as admin_note'
                        )->where('status', 3)->whereRaw('scheduled_date IS NOT NULL')->where('a.user_id', Auth::user()->id)
                        ->get();

        return ResponseFormatter::success($transaction, 'scheduled task generated');
    }
    
    public function checkPhoto($id)
    {
        $transaction = CovisTransactionImage::where('covis_transaction_id', $id)->first();
        if ($transaction->photo_front1 || $transaction->photo_front2 || $transaction->photo_left || $transaction->photo_right) {
            $response = false;
        } else {
            $response = true;
        }
        
        return ResponseFormatter::success($response, 'Success');
    }

    public function detailScheduledTask($id)
    {
        $transaction = DB::table('covis_transactions as a')
                        ->leftJoin('covis_customers as b', 'a.covis_customer_id', 'b.id')
                        ->leftJoin('covis_classes as c', 'a.covis_class_id', 'c.id')
                        ->leftJoin('covis_priorities as d', 'a.covis_priority_id', 'd.id')
                        ->leftJoin('branchs as e', 'b.branch_id', 'e.id')
                        ->leftJoin('regions as f', 'b.region_id', 'f.id')
                        ->leftJoin('covis_types as g', 'b.covis_type_id', 'g.id')
                        ->leftJoin('indonesia_provinces as h', 'b.province_code', 'h.code')
                        ->leftJoin('indonesia_cities as i', 'b.city_code', 'i.code')
                        ->leftJoin('indonesia_districts as j', 'b.district_code', 'j.code')
                        ->select(
                            'a.id', 'a.termination_date', 'a.scheduled_date',  'a.uuid', 'c.code as class_code', 'c.name as class_name',
                            'd.code as priority_code', 'd.name as priority_name', 'b.code as customer_code',
                            'b.name as customer_name', 'b.address as customer_address', 'b.contact_name as customer_contact_name',
                            'b.contact_no as customer_contact_no', 'b.ao_name as customer_ao_name', 'b.ao_no as customer_ao_no',
                            'e.name as customer_branch', 'f.name as customer_region', 'g.name as customer_covis_type',
                            'h.name as customer_province', 'i.name as customer_city', 'j.name as customer_district','a.admin_note as admin_note','a.revision_note as revision_note'
                        )->where('a.id', $id)
                        ->first();

        return ResponseFormatter::success($transaction, 'scheduled task generated');
    }

    public function statistik()
    {
        $totalDataSurvey = CovisTransaction::where('user_id', Auth::user()->id)->where('status', 3)->count(); 
        $totalPending = CovisTransaction::where('user_id', Auth::user()->id)->where('status', 3)->count();
        $totalDataDone = CovisTransaction::where('user_id', Auth::user()->id)->where('status', 5)->count();
        if ($totalDataSurvey == 0) {
            $totalUnsheduled = 0;
        } else {
            $totalUnsheduled = CovisTransaction::where('user_id', Auth::user()->id)->where('scheduled_date', null)->count();
        }

        // rat
        $count_complete = CovisTransaction::where('user_id', Auth::user()->id)->where('status', 5)->count();
        $count_revisi = CovisTransaction::where('user_id', Auth::user()->id)->where('is_revision', 2)->count();
        
        if ($count_complete == 0) {
            $total = 0;
        } else {
            $total = $count_complete / ($count_complete + $count_revisi) * 100;
        }
        // dd($totalUnsheduled);
        
        $arr = [
            'total_data_survey' => $totalDataSurvey,
            'request_pending' => $totalPending,
            'request_done' => $totalDataDone,
            'request_unschedule' => $totalUnsheduled,
            'revisi' => $count_revisi,
            'rating' => round($total)
        ];

        return ResponseFormatter::success($arr, 'Statistic successfully generated');

        // return response()
        //     ->json([
        //         'total_data_survey' => $totalDataSurvey,
        //         'request_pending' => $totalPending,
        //         'request_done' => $totalDataDone,
        //         'request_unschedule' => $totalUnsheduled,
        //         'rating' => $total
        //     ]);

    }

    public function lastVisit()
    {
        $response = DB::table('covis_transactions as a')
                    ->leftJoin('covis_transaction_images as b', 'b.id' , 'a.id')
                    ->leftJoin('covis_customers as c', 'a.covis_customer_id', 'c.id')
                    ->leftJoin('branchs as d', 'c.branch_id', 'd.id')
                    ->leftJoin('projects as e', 'c.project_id', 'e.id')
                    ->leftJoin('covis_types as f', 'c.covis_type_id', 'f.id')
                    ->orderBy('visited_at', 'desc')
                    ->limit('5')
                    ->select('a.uuid', 'c.name', 'b.photo_front1', 'f.name as covis_type_name' , 'd.name as branch_name', 'e.code as code_project', 'd.code as code_branch')
                    ->where('a.user_id', Auth::user()->id)
                    ->where('status', 5)
                    ->get();

        return ResponseFormatter::success($response, 'last visits generated');
    }

    public function updateSchedule(Request $request)
    {
        $id = $request->id;
        $date = $request->date;

        $transaction = CovisTransaction::findOrFail($id);
        $transaction->update([
            'scheduled_date' => Carbon::parse($date)
        ]);

        $response = DB::table('covis_transactions as a')
                        ->leftJoin('covis_customers as b', 'a.covis_customer_id', 'b.id')
                        ->leftJoin('covis_classes as c', 'a.covis_class_id', 'c.id')
                        ->leftJoin('covis_priorities as d', 'a.covis_priority_id', 'd.id')
                        ->leftJoin('branchs as e', 'b.branch_id', 'e.id')
                        ->leftJoin('regions as f', 'b.region_id', 'f.id')
                        ->leftJoin('covis_types as g', 'b.covis_type_id', 'g.id')
                        ->leftJoin('indonesia_provinces as h', 'b.province_code', 'h.code')
                        ->leftJoin('indonesia_cities as i', 'b.city_code', 'i.code')
                        ->leftJoin('indonesia_districts as j', 'b.district_code', 'j.code')
                        ->select(
                            'a.id', 'a.termination_date', 'a.scheduled_date', 'a.uuid', 'c.code as class_code', 'c.name as class_name',
                            'd.code as priority_code', 'd.name as priority_name', 'b.code as customer_code',
                            'b.name as customer_name', 'b.address as customer_address', 'b.contact_name as customer_contact_name',
                            'b.contact_no as customer_contact_no', 'b.ao_name as customer_ao_name', 'b.ao_no as customer_ao_no',
                            'e.name as customer_branch', 'f.name as customer_region', 'g.name as customer_covis_type',
                            'h.name as customer_province', 'i.name as customer_city', 'j.name as customer_district'
                        )->where('status', 3)->whereRaw('scheduled_date IS NOT NULL')->where('a.user_id', Auth::user()->id)
                        ->get();

        return ResponseFormatter::success($response, 'Transaction successfully scheduled');
    }

    // public function postImage(Request $request)
    // {
    //     $type = $request->type;
    //     $id_transaction = $request->id_transaction;
    //     $file = $request->file('file');
    //     $transaction = CovisTransaction::with('customer')->find($id_transaction);
    //     $now = Carbon::now();
    //     $transaction_image = CovisTransactionImage::where('covis_transaction_id', $id_transaction)->first();
    //     // dd($transaction_image);
    //     // dd($type);

    //     switch ($type) {
    //         case 'DEPAN1':
    //             if (!is_dir(public_path('images/collateral/' . $transaction->customer->project->code . '/' . $transaction->customer->branch->code . '/' . $transaction->uuid . '/'))) {
    //                 mkdir(public_path('images/collateral/' . $transaction->customer->project->code . '/' . $transaction->customer->branch->code . '/' . $transaction->uuid . '/'));
    //             }
    //             // $name = $now->format('ymd') . '_' . $transaction->customer->code . '_' . $transaction->customer->covisType->code . '_' . 'F1' . '_' . time() . '.' . $file->getClientOriginalExtension();
    //             $name = $now->format('ymd') . '_' . $transaction->customer->code . '_' . $transaction->customer->covisType->code . '_' . 'F1' . '_' . time() . '.' . 'webp';
    //             // dd($name);
    //             if ($transaction_image->photo_front1) {
    //                 $path = public_path('images/collateral/' . $transaction->customer->project->code . '/' . $transaction->customer->branch->code . '/' . $transaction->uuid . '/');
    //                 $file_old = $path . $transaction_image->photo_front1;
    //                 unlink($file_old);
    //             }
    //             $transaction_image->update([
    //                 'photo_front1' => $name,
    //                 'created_by' => auth()->user()->name
    //             ]);
    //             $front1 = Image::make($file)->encode('webp', 70);
    //             $front1->save('images/collateral/' . $transaction->customer->project->code . '/' . $transaction->customer->branch->code . '/' . $transaction->uuid . '/' . $name);
    //             // $file->move(public_path('images/collateral/' . $transaction->customer->project->code . '/' . $transaction->customer->branch->code . '/' . $transaction->uuid . '/'), $name);
    //         break;
    //         case 'DEPAN2':
    //             if (!is_dir(public_path('images/collateral/' . $transaction->customer->project->code . '/' . $transaction->customer->branch->code . '/' . $transaction->uuid . '/'))) {
    //                 mkdir(public_path('images/collateral/' . $transaction->customer->project->code . '/' . $transaction->customer->branch->code . '/' . $transaction->uuid . '/'));
    //             }
    //             // $name = $now->format('ymd') . '_' . $transaction->customer->code . '_' . $transaction->customer->covisType->code . '_' . 'F2' . '_' . time() . '.' . $file->getClientOriginalExtension();
    //             $name = $now->format('ymd') . '_' . $transaction->customer->code . '_' . $transaction->customer->covisType->code . '_' . 'F2' . '_' . time() . '.' . 'webp';
    //             // dd($name);
    //             if ($transaction_image->photo_front2) {
    //                 $path = public_path('images/collateral/' . $transaction->customer->project->code . '/' . $transaction->customer->branch->code . '/' . $transaction->uuid . '/');
    //                 $file_old = $path . $transaction_image->photo_front2;
    //                 unlink($file_old);
    //             }
    //             $transaction_image->update([
    //                 'photo_front2' => $name,
    //                 'created_by' => auth()->user()->name
    //             ]);
    //             $front1 = Image::make($file)->encode('webp', 70);
    //             $front1->save('images/collateral/' . $transaction->customer->project->code . '/' . $transaction->customer->branch->code . '/' . $transaction->uuid . '/' . $name);
    //             // $file->move(public_path('images/collateral/' . $transaction->customer->project->code . '/' . $transaction->customer->branch->code . '/' . $transaction->uuid . '/'), $name);


    //             // $name = $now->format('ymd') . '_' . $transaction->customer->code . '_' . $transaction->customer->covisType->code . '_' . 'F2' . '_' . time() . '.' . $file->getClientOriginalExtension();
    //             // if ($transaction_image->photo_front2) {
    //             //     $path = public_path('images/collateral/' . $transaction->customer->project->code . '/' . $transaction->customer->branch->code . '/' . $transaction->uuid . '/');
    //             //     $file_old = $path . $transaction_image->photo_front2;
    //             //     unlink($file_old);
    //             // }
    //             // $transaction_image->update([
    //             //     'photo_front2' => $name,
    //             //     'created_by' => auth()->user()->name
    //             // ]);
    //             // $file->move(public_path('images/collateral/' . $transaction->customer->project->code . '/' . $transaction->customer->branch->code . '/' . $transaction->uuid . '/'), $name);
    //         break;

    //         case 'PHOTOLEFT':
    //             if (!is_dir(public_path('images/collateral/' . $transaction->customer->project->code . '/' . $transaction->customer->branch->code . '/' . $transaction->uuid . '/'))) {
    //                 mkdir(public_path('images/collateral/' . $transaction->customer->project->code . '/' . $transaction->customer->branch->code . '/' . $transaction->uuid . '/'));
    //             }
    //             // $name = $now->format('ymd') . '_' . $transaction->customer->code . '_' . $transaction->customer->covisType->code . '_' . 'PL' . '_' . time() . '.' . $file->getClientOriginalExtension();
    //             $name = $now->format('ymd') . '_' . $transaction->customer->code . '_' . $transaction->customer->covisType->code . '_' . 'PL' . '_' . time() . '.' . 'webp';
    //             // dd($name);
    //             if ($transaction_image->photo_left) {
    //                 $path = public_path('images/collateral/' . $transaction->customer->project->code . '/' . $transaction->customer->branch->code . '/' . $transaction->uuid . '/');
    //                 $file_old = $path . $transaction_image->photo_left;
    //                 unlink($file_old);
    //             }
    //             $transaction_image->update([
    //                 'photo_left' => $name,
    //                 'created_by' => auth()->user()->name
    //             ]);
    //             $front1 = Image::make($file)->encode('webp', 70);
    //             $front1->save('images/collateral/' . $transaction->customer->project->code . '/' . $transaction->customer->branch->code . '/' . $transaction->uuid . '/' . $name);
    //             // $file->move(public_path('images/collateral/' . $transaction->customer->project->code . '/' . $transaction->customer->branch->code . '/' . $transaction->uuid . '/'), $name);

    //             // $name = $now->format('ymd') . '_' . $transaction->customer->code . '_' . $transaction->customer->covisType->code . '_' . 'PL' . '_' . time() . '.' . $file->getClientOriginalExtension();
    //             // if ($transaction_image->photo_left) {
    //             //     $path = public_path('images/collateral/' . $transaction->customer->project->code . '/' . $transaction->customer->branch->code . '/' . $transaction->uuid . '/');
    //             //     $file_old = $path . $transaction_image->photo_left;
    //             //     unlink($file_old);
    //             // }
    //             // $transaction_image->update([
    //             //     'photo_left' => $name,
    //             //     'created_by' => auth()->user()->name
    //             // ]);
    //             // $file->move(public_path('images/collateral/' . $transaction->customer->project->code . '/' . $transaction->customer->branch->code . '/' . $transaction->uuid . '/'), $name);
    //         break;

    //         case 'PHOTORIGHT':
    //             if (!is_dir(public_path('images/collateral/' . $transaction->customer->project->code . '/' . $transaction->customer->branch->code . '/' . $transaction->uuid . '/'))) {
    //                 mkdir(public_path('images/collateral/' . $transaction->customer->project->code . '/' . $transaction->customer->branch->code . '/' . $transaction->uuid . '/'));
    //             }
    //             // $name = $now->format('ymd') . '_' . $transaction->customer->code . '_' . $transaction->customer->covisType->code . '_' . 'PR' . '_' . time() . '.' . $file->getClientOriginalExtension();
    //             $name = $now->format('ymd') . '_' . $transaction->customer->code . '_' . $transaction->customer->covisType->code . '_' . 'PR' . '_' . time() . '.' . 'webp';
    //             // dd($name);
    //             if ($transaction_image->photo_right) {
    //                 $path = public_path('images/collateral/' . $transaction->customer->project->code . '/' . $transaction->customer->branch->code . '/' . $transaction->uuid . '/');
    //                 $file_old = $path . $transaction_image->photo_right;
    //                 unlink($file_old);
    //             }
    //             $transaction_image->update([
    //                 'photo_right' => $name,
    //                 'created_by' => auth()->user()->name
    //             ]);
    //             $front1 = Image::make($file)->encode('webp', 70);
    //             $front1->save('images/collateral/' . $transaction->customer->project->code . '/' . $transaction->customer->branch->code . '/' . $transaction->uuid . '/' . $name);
    //             // $file->move(public_path('images/collateral/' . $transaction->customer->project->code . '/' . $transaction->customer->branch->code . '/' . $transaction->uuid . '/'), $name);


    //             // $name = $now->format('ymd') . '_' . $transaction->customer->code . '_' . $transaction->customer->covisType->code . '_' . 'PR' . '_' . time() . '.' . $file->getClientOriginalExtension();
    //             // if ($transaction_image->photo_right) {
    //             //     $path = public_path('images/collateral/' . $transaction->customer->project->code . '/' . $transaction->customer->branch->code . '/' . $transaction->uuid . '/');
    //             //     $file_old = $path . $transaction_image->photo_right;
    //             //     unlink($file_old);
    //             // }
    //             // $transaction_image->update([
    //             //     'photo_right' => $name,
    //             //     'created_by' => auth()->user()->name
    //             // ]);
    //             // $file->move(public_path('images/collateral/' . $transaction->customer->project->code . '/' . $transaction->customer->branch->code . '/' . $transaction->uuid . '/'), $name);

    //         break;
    //     }

    //     return ResponseFormatter::success(null, 'Images has been created');
    // }
    
    
    // dari demo covis
    public function postImage(Request $request)
    {
        $type = $request->type;
        $id_transaction = $request->id_transaction;
        $file = $request->file('file');
        $transaction = CovisTransaction::with('customer')->find($id_transaction);
        $now = Carbon::now();
        $transaction_image = CovisTransactionImage::where('covis_transaction_id', $id_transaction)->first();
        // dd($type);
        
        if ($request->hasFile('file')) {

            switch ($type) {
                case 'DEPAN1':
                    // dd(!is_dir(public_path('images/collateral/' . $transaction->customer->project->code . '/' . $transaction->customer->branch->code . '/' . $transaction->uuid . '/')));
                    // if (!is_dir(public_path('images/collateral/' . $transaction->customer->project->code . '/' . $transaction->customer->branch->code . '/' . $transaction->uuid . '/'))) {
                    //     mkdir(public_path('images/collateral/' . $transaction->customer->project->code . '/' . $transaction->customer->branch->code . '/' . $transaction->uuid . '/'));
                    // }
                    $name = $now->format('ymd') . '_' . $transaction->customer->code . '_' . $transaction->customer->covisType->code . '_' . 'F1' . '_' . time() . '.' . $file->getClientOriginalExtension();
                    // $name = $now->format('ymd') . '_' . $transaction->customer->code . '_' . $transaction->customer->covisType->code . '_' . 'F1' . '_' . time() . '.' . 'webp';
                    // dd($name);
                    if ($transaction_image->photo_front1) {
                        $path = public_path('images/collateral/' . $transaction->customer->project->code . '/' . $transaction->customer->branch->code . '/' . $transaction->uuid . '/');
                        $file_old = $path . $transaction_image->photo_front1;
                        // unlink($file_old);
                    }
                    $transaction_image->update([
                        'photo_front1' => $name,
                        'created_by' => auth()->user()->name
                    ]);
                    // $front1 = Image::make($file)->encode('webp', 40);
                    // $front1->save('images/collateral/' . $transaction->customer->project->code . '/' . $transaction->customer->branch->code . '/' . $transaction->uuid . '/' . $name);
                    $file->move(public_path('images/collateral/' . $transaction->customer->project->code . '/' . $transaction->customer->branch->code . '/' . $transaction->uuid . '/'), $name);
                break;
                case 'DEPAN2':
                    // if (!is_dir(public_path('images/collateral/' . $transaction->customer->project->code . '/' . $transaction->customer->branch->code . '/' . $transaction->uuid . '/'))) {
                    //     mkdir(public_path('images/collateral/' . $transaction->customer->project->code . '/' . $transaction->customer->branch->code . '/' . $transaction->uuid . '/'));
                    // }
                    $name = $now->format('ymd') . '_' . $transaction->customer->code . '_' . $transaction->customer->covisType->code . '_' . 'F2' . '_' . time() . '.' . $file->getClientOriginalExtension();
                    // $name = $now->format('ymd') . '_' . $transaction->customer->code . '_' . $transaction->customer->covisType->code . '_' . 'F2' . '_' . time() . '.' . 'webp';
                    // dd($name);
                    if ($transaction_image->photo_front2) {
                        $path = public_path('images/collateral/' . $transaction->customer->project->code . '/' . $transaction->customer->branch->code . '/' . $transaction->uuid . '/');
                        $file_old = $path . $transaction_image->photo_front2;
                        // unlink($file_old);
                    }
                    $transaction_image->update([
                        'photo_front2' => $name,
                        'created_by' => auth()->user()->name
                    ]);
                    // $front1 = Image::make($file)->encode('webp', 40);
                    // $front1->save('images/collateral/' . $transaction->customer->project->code . '/' . $transaction->customer->branch->code . '/' . $transaction->uuid . '/' . $name);
                    $file->move(public_path('images/collateral/' . $transaction->customer->project->code . '/' . $transaction->customer->branch->code . '/' . $transaction->uuid . '/'), $name);
    
    
                    // $name = $now->format('ymd') . '_' . $transaction->customer->code . '_' . $transaction->customer->covisType->code . '_' . 'F2' . '_' . time() . '.' . $file->getClientOriginalExtension();
                    // if ($transaction_image->photo_front2) {
                    //     $path = public_path('images/collateral/' . $transaction->customer->project->code . '/' . $transaction->customer->branch->code . '/' . $transaction->uuid . '/');
                    //     $file_old = $path . $transaction_image->photo_front2;
                    //     unlink($file_old);
                    // }
                    // $transaction_image->update([
                    //     'photo_front2' => $name,
                    //     'created_by' => auth()->user()->name
                    // ]);
                    // $file->move(public_path('images/collateral/' . $transaction->customer->project->code . '/' . $transaction->customer->branch->code . '/' . $transaction->uuid . '/'), $name);
                break;
    
                case 'PHOTOLEFT':
                    // if (!is_dir(public_path('images/collateral/' . $transaction->customer->project->code . '/' . $transaction->customer->branch->code . '/' . $transaction->uuid . '/'))) {
                    //     mkdir(public_path('images/collateral/' . $transaction->customer->project->code . '/' . $transaction->customer->branch->code . '/' . $transaction->uuid . '/'));
                    // }
                    $name = $now->format('ymd') . '_' . $transaction->customer->code . '_' . $transaction->customer->covisType->code . '_' . 'PL' . '_' . time() . '.' . $file->getClientOriginalExtension();
                    // $name = $now->format('ymd') . '_' . $transaction->customer->code . '_' . $transaction->customer->covisType->code . '_' . 'PL' . '_' . time() . '.' . 'webp';
                    // dd($name);
                    if ($transaction_image->photo_left) {
                        $path = public_path('images/collateral/' . $transaction->customer->project->code . '/' . $transaction->customer->branch->code . '/' . $transaction->uuid . '/');
                        $file_old = $path . $transaction_image->photo_left;
                        // unlink($file_old);
                    }
                    $transaction_image->update([
                        'photo_left' => $name,
                        'created_by' => auth()->user()->name
                    ]);
                    // $front1 = Image::make($file)->encode('webp', 40);
                    // $front1->save('images/collateral/' . $transaction->customer->project->code . '/' . $transaction->customer->branch->code . '/' . $transaction->uuid . '/' . $name);
                    $file->move(public_path('images/collateral/' . $transaction->customer->project->code . '/' . $transaction->customer->branch->code . '/' . $transaction->uuid . '/'), $name);
    
                    // $name = $now->format('ymd') . '_' . $transaction->customer->code . '_' . $transaction->customer->covisType->code . '_' . 'PL' . '_' . time() . '.' . $file->getClientOriginalExtension();
                    // if ($transaction_image->photo_left) {
                    //     $path = public_path('images/collateral/' . $transaction->customer->project->code . '/' . $transaction->customer->branch->code . '/' . $transaction->uuid . '/');
                    //     $file_old = $path . $transaction_image->photo_left;
                    //     unlink($file_old);
                    // }
                    // $transaction_image->update([
                    //     'photo_left' => $name,
                    //     'created_by' => auth()->user()->name
                    // ]);
                    // $file->move(public_path('images/collateral/' . $transaction->customer->project->code . '/' . $transaction->customer->branch->code . '/' . $transaction->uuid . '/'), $name);
                break;
    
                case 'PHOTORIGHT':
                    // if (!is_dir(public_path('images/collateral/' . $transaction->customer->project->code . '/' . $transaction->customer->branch->code . '/' . $transaction->uuid . '/'))) {
                    //     mkdir(public_path('images/collateral/' . $transaction->customer->project->code . '/' . $transaction->customer->branch->code . '/' . $transaction->uuid . '/'));
                    // }
                    $name = $now->format('ymd') . '_' . $transaction->customer->code . '_' . $transaction->customer->covisType->code . '_' . 'PR' . '_' . time() . '.' . $file->getClientOriginalExtension();
                    // $name = $now->format('ymd') . '_' . $transaction->customer->code . '_' . $transaction->customer->covisType->code . '_' . 'PR' . '_' . time() . '.' . 'webp';
                    // dd($name);
                    if ($transaction_image->photo_right) {
                        $path = public_path('images/collateral/' . $transaction->customer->project->code . '/' . $transaction->customer->branch->code . '/' . $transaction->uuid . '/');
                        $file_old = $path . $transaction_image->photo_right;
                        // unlink($file_old);
                    }
                    $transaction_image->update([
                        'photo_right' => $name,
                        'created_by' => auth()->user()->name
                    ]);
                    // $front1 = Image::make($file)->encode('webp', 40);
                    // $front1->save('images/collateral/' . $transaction->customer->project->code . '/' . $transaction->customer->branch->code . '/' . $transaction->uuid . '/' . $name);
                    $file->move(public_path('images/collateral/' . $transaction->customer->project->code . '/' . $transaction->customer->branch->code . '/' . $transaction->uuid . '/'), $name);
    
    
                    // $name = $now->format('ymd') . '_' . $transaction->customer->code . '_' . $transaction->customer->covisType->code . '_' . 'PR' . '_' . time() . '.' . $file->getClientOriginalExtension();
                    // if ($transaction_image->photo_right) {
                    //     $path = public_path('images/collateral/' . $transaction->customer->project->code . '/' . $transaction->customer->branch->code . '/' . $transaction->uuid . '/');
                    //     $file_old = $path . $transaction_image->photo_right;
                    //     unlink($file_old);
                    // }
                    // $transaction_image->update([
                    //     'photo_right' => $name,
                    //     'created_by' => auth()->user()->name
                    // ]);
                    // $file->move(public_path('images/collateral/' . $transaction->customer->project->code . '/' . $transaction->customer->branch->code . '/' . $transaction->uuid . '/'), $name);
    
                break;
            }
        } else {
            return ResponseFormatter::error(null, 'Upload failed', 404);
        }

        return ResponseFormatter::success(null, 'Images has been created');
    }
    


    public function completedTask()
    {
        $response = DB::table('covis_transactions as a')
                    ->leftJoin('covis_transaction_images as b', 'b.id' , 'a.id')
                    ->leftJoin('covis_customers as c', 'a.covis_customer_id', 'c.id')
                    ->leftJoin('branchs as d', 'c.branch_id', 'd.id')
                    ->leftJoin('projects as e', 'c.project_id', 'e.id')
                    ->leftJoin('covis_types as f', 'c.covis_type_id', 'f.id')
                    ->leftJoin('covis_classes as g', 'a.covis_class_id', 'g.id')
                    ->leftJoin('covis_priorities as h', 'a.covis_priority_id', 'h.id')
                    ->leftJoin('regions as i', 'c.region_id', 'i.id')
                    ->leftJoin('indonesia_provinces as j', 'c.province_code', 'j.code')
                    ->leftJoin('indonesia_cities as k', 'c.city_code', 'k.code')
                    ->leftJoin('indonesia_districts as l', 'c.district_code', 'l.code')
                    ->orderBy('visited_at', 'desc')
                    ->limit('5')
                    ->select('a.id', 'a.termination_date', 'a.scheduled_date', 'a.uuid', 'g.code as class_code', 'g.name as class_name', 'h.code as priority_code', 'h.name as priority_name', 'c.code as customer_name', 'c.name as customer_name', 'c.address as customer_address', 'c.contact_name as customer_contact_name', 'c.contact_no as customer_contact_no', 'c.ao_name as customer_ao_name', 'c.ao_no as customer_ao_no', 'd.name as customer_branch', 'i.name as customer_region', 'f.name as customer_covis_type', 'j.name as customer_province', 'k.name as customer_city', 'l.name as customer_district')
                    ->where('a.user_id', Auth::user()->id)
                    ->where('status', 5)
                    ->get();

        return ResponseFormatter::success($response, 'Completed task generated');
    }

    public function getImages($id)
    {
        $response = DB::table('covis_transaction_images as a')
                    ->leftJoin('covis_transactions as b', 'b.id', 'a.covis_transaction_id')
                    ->leftJoin('covis_customers as c', 'b.covis_customer_id', 'c.id')
                    ->leftJoin('projects as d', 'c.project_id', 'd.id')
                    ->leftJoin('branchs as e', 'c.branch_id', 'e.id')
                    ->select('a.id', 'a.covis_transaction_id', 'a.photo_front1', 'a.photo_front2', 'a.photo_left', 'a.photo_right', 'e.code as branch_code', 'd.code as project_code', 'b.uuid')
                    ->where('a.covis_transaction_id', $id)->first();
        // $transactionImages = CovisTransactionImage::with('transaction')->where('covis_transaction_id', $id)->first();
        return ResponseFormatter::success($response, 'Images success generated');
    }

    public function readyToVisit(Request $request)
    {
        $transaction = CovisTransaction::where('id', $request->id_transaction)->first();
        $transaction->update([
            'visited_at' => Carbon::now(),
            'covis_condition_id' => $request->covis_condition_id,
            'covis_used_for_id' => $request->covis_used_for_id,
            'covis_access_type_id' => $request->covis_access_type_id,
            'status' => 5,
            'distance' => $request->distance,
            'note' => $request->note
        ]);
        return ResponseFormatter::success($transaction, 'Transaction has been updated! cuyyyyyyyyyyy');
    }

    public function revisionVisit(Request $request)
    {
        $transaction = CovisTransaction::where('id', $request->id_transaction)->first();
        $transaction->update([
            'covis_condition_id' => $request->covis_condition_id,
            'covis_used_for_id' => $request->covis_used_for_id,
            'covis_access_type_id' => $request->covis_access_type_id,
            'is_revision' => 2,
            'distance' => $request->distance
        ]);
        return ResponseFormatter::success($transaction, 'Transaction revision visit has been updated!');
    }

    public function getTransactionCompleted()
    {
        $response = DB::table('covis_transactions as a')
                        ->leftJoin('covis_customers as b', 'a.covis_customer_id', 'b.id')
                        ->leftJoin('covis_classes as c', 'a.covis_class_id', 'c.id')
                        ->leftJoin('covis_priorities as d', 'a.covis_priority_id', 'd.id')
                        ->leftJoin('branchs as e', 'b.branch_id', 'e.id')
                        ->leftJoin('regions as f', 'b.region_id', 'f.id')
                        ->leftJoin('covis_types as g', 'b.covis_type_id', 'g.id')
                        ->select(
                            'a.id', 'a.termination_date', 'a.scheduled_date', 'a.uuid', 'c.code as class_code', 'c.name as class_name',
                            'd.code as priority_code', 'd.name as priority_name', 'b.code as customer_code',
                            'b.name as customer_name', 'b.address as customer_address', 'b.contact_name as customer_contact_name',
                            'b.contact_no as customer_contact_no', 'b.ao_name as customer_ao_name', 'b.ao_no as customer_ao_no',
                            'e.name as customer_branch', 'f.name as customer_region', 'g.name as customer_covis_type')->where('status', 5)
                        ->where('is_revision', 2)
                        ->where('a.user_id', Auth::user()->id)
                        ->get();

        return ResponseFormatter::success($response, 'Transaction completed success generated');
    }

    public function getTransactionRevision()
    {
        $transactionRevision = DB::table('covis_transactions as a')
        ->leftJoin('covis_customers as b', 'a.covis_customer_id', 'b.id')
        ->leftJoin('covis_classes as c', 'a.covis_class_id', 'c.id')
        ->leftJoin('covis_priorities as d', 'a.covis_priority_id', 'd.id')
        ->leftJoin('branchs as e', 'b.branch_id', 'e.id')
        ->leftJoin('regions as f', 'b.region_id', 'f.id')
        ->leftJoin('covis_types as g', 'b.covis_type_id', 'g.id')
        ->select(
            'a.id', 'a.termination_date', 'a.scheduled_date',  'a.uuid', 'c.code as class_code', 'c.name as class_name',
            'd.code as priority_code', 'd.name as priority_name', 'b.code as customer_code',
            'b.name as customer_name', 'b.address as customer_address', 'b.contact_name as customer_contact_name',
            'b.contact_no as customer_contact_no', 'b.ao_name as customer_ao_name', 'b.ao_no as customer_ao_no',
            'e.name as customer_branch', 'f.name as customer_region', 'g.name as customer_covis_type','a.revision_note as revision_note'
        )->where('status', 5)
        ->where('is_revision', 1)
        ->where('a.user_id', Auth::user()->id)
        ->get();

        // $transaction = CovisTransaction::where('status', 5)->where('is_revision', 1)->get();

        return ResponseFormatter::success($transactionRevision, 'Transaction Revision generated');
    }

    public function ratingSurveyor()
    {
        $count_complete= CovisTransaction::where('user_id', Auth::user()->id)->where('status', 5)->count();
        $count_revisi = CovisTransaction::where('user_id', Auth::user()->id)->where('is_revision', 2)->count();
        // $total = $count_complete / ($count_complete + $count_revisi) * 100;
        if($count_complete != 0 || $count_revisi != 0){
            $total = $count_complete / ($count_complete + $count_revisi) * 100;
        } else {
            $total = 0;
        }

        return ResponseFormatter::success((int) round($total), 'Success Generated Rating');

    }
    
    
    public function depan1(Request $request)
    {
        $type = $request->type;
        $id_transaction = $request->id_transaction;
        $file = $request->file('file');
        $transaction = CovisTransaction::with('customer')->find($id_transaction);
        $now = Carbon::now();
        $transaction_image = CovisTransactionImage::where('covis_transaction_id', $id_transaction)->first();


        try {
            if($type = 'DEPAN1'){
                $name = $now->format('ymd') . '_' . $transaction->customer->code . '_' . $transaction->customer->covisType->code . '_' . 'D1' . '_' . time() . '.' . $file->getClientOriginalExtension();
                if ($transaction_image->photo_front1) {
                    $path = public_path('images/collateral/' . $transaction->customer->project->code . '/' . $transaction->customer->branch->code . '/' . $transaction->uuid . '/');
                    $file_old = $path . $transaction_image->photo_front1;
                }
                $transaction_image->update([
                    'photo_front1' => $name,
                    'created_by' => auth()->user()->name
                ]);
                $file->move(public_path('images/collateral/' . $transaction->customer->project->code . '/' . $transaction->customer->branch->code . '/' . $transaction->uuid . '/'), $name);
            } 
                
                return ResponseFormatter::success(null, 'Images has been created');
            } catch (\Throwable $th) {
                return ResponseFormatter::success([
                    'error' => $th
                ], 'Failed' );
            }

    }

    public function depan2(Request $request)
    {
        $type = $request->type;
        $id_transaction = $request->id_transaction;
        $file = $request->file('file');
        $transaction = CovisTransaction::with('customer')->find($id_transaction);
        $now = Carbon::now();
        $transaction_image = CovisTransactionImage::where('covis_transaction_id', $id_transaction)->first();
        try {
                if($type = 'DEPAN2'){
                    $name = $now->format('ymd') . '_' . $transaction->customer->code . '_' . $transaction->customer->covisType->code . '_' . 'D2' . '_' . time() . '.' . $file->getClientOriginalExtension();
                    if ($transaction_image->photo_front2) {
                        $path = public_path('images/collateral/' . $transaction->customer->project->code . '/' . $transaction->customer->branch->code . '/' . $transaction->uuid . '/');
                        $file_old = $path . $transaction_image->photo_front2;
                    }
                    $transaction_image->update([
                        'photo_front2' => $name,
                        'created_by' => auth()->user()->name
                    ]);
                    $file->move(public_path('images/collateral/' . $transaction->customer->project->code . '/' . $transaction->customer->branch->code . '/' . $transaction->uuid . '/'), $name);
                } 
                
                return ResponseFormatter::success(null, 'Images has been created');
            } catch (\Throwable $th) {
                return ResponseFormatter::success([
                    'error' => $th
                ], 'Failed' );
            }
    }

    public function right(Request $request)
    {
        $type = $request->type;
        $id_transaction = $request->id_transaction;
        $file = $request->file('file');
        $transaction = CovisTransaction::with('customer')->find($id_transaction);
        $now = Carbon::now();
        $transaction_image = CovisTransactionImage::where('covis_transaction_id', $id_transaction)->first();
        try {
                if($type = 'PHOTORIGHT'){
                    $name = $now->format('ymd') . '_' . $transaction->customer->code . '_' . $transaction->customer->covisType->code . '_' . 'PR' . '_' . time() . '.' . $file->getClientOriginalExtension();
                    if ($transaction_image->photo_right) {
                        $path = public_path('images/collateral/' . $transaction->customer->project->code . '/' . $transaction->customer->branch->code . '/' . $transaction->uuid . '/');
                        $file_old = $path . $transaction_image->photo_right;
                    }
                    $transaction_image->update([
                        'photo_right' => $name,
                        'created_by' => auth()->user()->name
                    ]);
                    $file->move(public_path('images/collateral/' . $transaction->customer->project->code . '/' . $transaction->customer->branch->code . '/' . $transaction->uuid . '/'), $name);
                } 
                
                return ResponseFormatter::success(null, 'Images has been created');
            } catch (\Throwable $th) {
                return ResponseFormatter::success([
                    'error' => $th
                ], 'Failed' );
            }
    }

    public function left(Request $request)
    {
        $type = $request->type;
        $id_transaction = $request->id_transaction;
        $file = $request->file('file');
        $transaction = CovisTransaction::with('customer')->find($id_transaction);
        $now = Carbon::now();
        $transaction_image = CovisTransactionImage::where('covis_transaction_id', $id_transaction)->first();
        try {
                if($type = 'PHOTOLEFT'){
                    $name = $now->format('ymd') . '_' . $transaction->customer->code . '_' . $transaction->customer->covisType->code . '_' . 'PL' . '_' . time() . '.' . $file->getClientOriginalExtension();
                    if ($transaction_image->photo_left) {
                        $path = public_path('images/collateral/' . $transaction->customer->project->code . '/' . $transaction->customer->branch->code . '/' . $transaction->uuid . '/');
                        $file_old = $path . $transaction_image->photo_left;
                    }
                    $transaction_image->update([
                        'photo_left' => $name,
                        'created_by' => auth()->user()->name
                    ]);
                    $file->move(public_path('images/collateral/' . $transaction->customer->project->code . '/' . $transaction->customer->branch->code . '/' . $transaction->uuid . '/'), $name);
                } 
                
                return ResponseFormatter::success(null, 'Images has been created');
            } catch (\Throwable $th) {
                return ResponseFormatter::success([
                    'error' => $th
                ], 'Failed' );
            }
    }
    
    
}
