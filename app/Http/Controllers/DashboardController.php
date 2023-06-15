<?php

namespace App\Http\Controllers;

use App\Models\CovisTransaction;
use App\Models\CovisType;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection as Collect;

class DashboardController extends Controller
{
    public function index()
    {
       
        
        $users = User::where('user_role_id', 7)->where('is_active', 1)->select('id','name')->get();

        foreach($users as $user){
            $count_complete = CovisTransaction::where('user_id',$user->id)->where('status',3)->where('visit_status', 2)->whereBetween('visited_at', [
                Carbon::now()->startOfYear(),
                Carbon::now()->endOfYear(),
            ])->count();  
            $count_revisi = CovisTransaction::where('user_id', $user->id)->where('is_revision', 2)->whereBetween('visited_at', [
                Carbon::now()->startOfYear(),
                Carbon::now()->endOfYear(),
            ])->count();
            
            if($count_complete != 0 || $count_revisi != 0){
                $total = $count_complete / ($count_complete + $count_revisi) * 100;
            } else {
                $total = 0;
            }
            
            $get_complete[] = collect([
                'nama' => $user->name,
                'count_complete' => $count_complete ?? 0,
                'count_revisi' => $count_revisi ?? 0,
                'total' => $total,
            ]);
            
            $count_complete = null;
            $count_revisi = null;
            $total = null;
        }

        $finalTopSurvey  = Collect($get_complete)->sortByDesc('total')->slice(0, -1); 



        // card statistik
        $totalTransaction = CovisTransaction::where('status', 3) ->whereYear('created_at', date('Y'))->count();
        $transactionCompleted = CovisTransaction::where('status', 3)->where('visit_status', 2) ->whereYear('created_at', date('Y'))->count();
        $transactionInProgress = DB::table('covis_transactions')
                    ->where('status', 3)
                    ->whereYear('created_at', date('Y'))
                    ->where('visit_status', 1)
                    ->count();

        // total transaction per month & week
        $totalTransactionCurrentMonth = CovisTransaction::select('*')
            ->whereMonth('created_at', Carbon::now()->month)
            ->where('status', 3)
            ->count();
        $totalTransactionCurrentWeek = CovisTransaction::where('created_at', '>', Carbon::now()->startOfWeek())
            ->where('status',3)
            ->where('created_at', '<', Carbon::now()->endOfWeek())
            ->count();

        // total transaction last month
        $totalTransactionLastMonth = CovisTransaction::whereMonth('created_at', Carbon::now()->subMonth()->month)->where('status', 3)->where('visit_status', 1)->count() == 0 ? 1 : CovisTransaction::whereMonth('created_at', Carbon::now()->subMonth()->month)->where('status', 3)->where('visit_status', 1)->count();
        $upMonthTotalData = $totalTransactionCurrentMonth /  $totalTransactionLastMonth * 100;

        // total transaction completed per month & week
        $totalTransactionCompletedCurrentMonth = CovisTransaction::select('*')
            ->where('status', 3)
            ->where('visit_status', 2)
            ->whereMonth('created_at', Carbon::now()->month)
            ->count();
        $totalTransactionCompletedCurrentWeek = CovisTransaction::where('created_at', '>', Carbon::now()->startOfWeek())
            ->where('status', 3)
            ->where('visit_status', 2)
            ->where('created_at', '<', Carbon::now()->endOfWeek())
            ->count();

        // total transaction completed last month
        $totalTransactionCompleteLastMonth = CovisTransaction::where('status', 5)->where('visit_status', 2)->whereMonth('created_at', Carbon::now()->subMonth()->month)->count() == 0 ? 1 : CovisTransaction::where('status', 5)->where('visit_status', 2)->whereMonth('created_at', Carbon::now()->subMonth()->month)->count();
        $upMonthTotalDataComplete = $totalTransactionCompletedCurrentMonth /  $totalTransactionCompleteLastMonth  * 100;

        // total transaction inproggress per month & week
        $totalTransactionInProgressCurrentMonth = CovisTransaction::select('*')
            ->where('status', 3)
            ->where('visit_status', 1)
            ->whereMonth('created_at', Carbon::now()->month)
            ->count();
        $totalTransactionInProgressCurrentWeek = CovisTransaction::where('created_at', '>', Carbon::now()->startOfWeek())
            ->where('status', 3)
            ->where('visit_status', 1)
            ->where('created_at', '<', Carbon::now()->endOfWeek())
            ->count();
        // total transaction completed last month
        $totalTransactionProgressLastMonth = CovisTransaction::where('status', 3)->where('visit_status', 1)->whereMonth('created_at', Carbon::now()->subMonth()->month)->count() == 0 ? 1 : CovisTransaction::where('status', 3)->where('visit_status', 1)->whereMonth('created_at', Carbon::now()->subMonth()->month)->count();
        $upMonthTotalDataProgress = $totalTransactionInProgressCurrentMonth /  $totalTransactionProgressLastMonth  * 100;



        // class overview
        // regular
        // month ubah ke year
        $transactionRegularCurrentMonth = CovisTransaction::select('*')
            ->where('covis_class_id', 1)
            ->where('status', 3)
            ->whereBetween('created_at', [
                Carbon::now()->startOfYear(),
                Carbon::now()->endOfYear(),
            ])->count(); 
        $transactionRegularCurrentMonthCompleted = CovisTransaction::select('*')
            ->where('covis_class_id', 1)
            ->where('status', 3)
            ->where('visit_status', 2)
            ->whereBetween('created_at', [
                Carbon::now()->startOfYear(),
                Carbon::now()->endOfYear(),
            ])->count();

        // up regular month
        $lastRegularMonth = CovisTransaction::where('covis_class_id', 1)->whereMonth('created_at', Carbon::now()->subMonth()->month)->count() == 0 ? 1 : CovisTransaction::where('covis_class_id', 1)->whereMonth('created_at', Carbon::now()->subMonth()->month)->count();
        $upRegularMonth = $transactionRegularCurrentMonthCompleted /  $lastRegularMonth * 100;

        //week
        $transactionRegularCurrentWeek = CovisTransaction::where('created_at', '>', Carbon::now()->startOfWeek())
            ->where('created_at', '<', Carbon::now()->endOfWeek())
            ->where('covis_class_id', 1)
            ->where('status', 3)
            ->count();
        $transactionRegularCurrentWeekCompleted =  CovisTransaction::where('created_at', '>', Carbon::now()->startOfWeek())
            ->where('created_at', '<', Carbon::now()->endOfWeek())
            ->where('covis_class_id', 1)
            ->where('status', 3)
            ->where('visit_status', 2)
            ->count();





        // class overview
        // LK motor
        // month ubah ke year
        $transactionLKMotorCurrentMonth = CovisTransaction::select('*')
            ->where('covis_class_id', 2)
            ->where('status', 3)
            ->whereBetween('created_at', [
                Carbon::now()->startOfYear(),
                Carbon::now()->endOfYear(),
            ])->count(); 
        $transactionLKMotorCurrentMonthCompleted = CovisTransaction::select('*')
            ->where('covis_class_id', 2)
            ->where('status', 3)
            ->where('visit_status', 2)
            ->whereBetween('created_at', [
                Carbon::now()->startOfYear(),
                Carbon::now()->endOfYear(),
            ])->count();
          // up LKMotor month
          $lastLKmotorMonth = CovisTransaction::where('covis_class_id', 2)->whereMonth('created_at', Carbon::now()->subMonth()->month)->count() == 0 ? 1 : CovisTransaction::where('covis_class_id', 2)->whereMonth('created_at', Carbon::now()->subMonth()->month)->count();
          $upLKMotorMonth = $transactionLKMotorCurrentMonthCompleted /  $lastLKmotorMonth * 100;
        //week
        $transactionLKMotorCurrentWeek = CovisTransaction::where('created_at', '>', Carbon::now()->startOfWeek())
            ->where('status', 3)
            ->where('created_at', '<', Carbon::now()->endOfWeek())
            ->where('covis_class_id', 2)
            ->count();
        $transactionLKMotorCurrentWeekCompleted =  CovisTransaction::where('created_at', '>', Carbon::now()->startOfWeek())
            ->where('created_at', '<', Carbon::now()->endOfWeek())
            ->where('covis_class_id', 2)
            ->where('status', 3)
            ->where('visit_status', 2)
            ->count();


        // class overview
        // LK mobil
        // month
        $transactionLKMobilCurrentMonth = CovisTransaction::select('*')
            ->where('covis_class_id', 3)
            ->where('status', 3)
            ->whereBetween('created_at', [
                Carbon::now()->startOfYear(),
                Carbon::now()->endOfYear(),
            ])->count();
        $transactionLKMobilCurrentMonthCompleted = CovisTransaction::select('*')
            ->where('covis_class_id', 3)
            ->where('status', 3)
            ->where('visit_status', 2)
            ->whereBetween('created_at', [
                Carbon::now()->startOfYear(),
                Carbon::now()->endOfYear(),
            ])->count();
          // up LKMotor month
          $lastLKmobilMonth = CovisTransaction::where('covis_class_id', 3)->whereMonth('created_at', Carbon::now()->subMonth()->month)->count() == 0 ? 1 : CovisTransaction::where('covis_class_id', 3)->whereMonth('created_at', Carbon::now()->subMonth()->month)->count();
          $upLKMobilMonth = $transactionLKMobilCurrentMonthCompleted /  $lastLKmobilMonth * 100;
        //week
        $transactionLKMobilCurrentWeek = CovisTransaction::where('created_at', '>', Carbon::now()->startOfWeek())
            ->where('created_at', '<', Carbon::now()->endOfWeek())
            ->where('covis_class_id', 3)
            ->where('status', 3)
            ->count();
        $transactionLKMobilCurrentWeekCompleted =  CovisTransaction::where('created_at', '>', Carbon::now()->startOfWeek())
            ->where('created_at', '<', Carbon::now()->endOfWeek())
            ->where('covis_class_id', 3)
            ->where('status', 3)
            ->where('visit_status', 2)
            ->count();

        // recent transaction
        $recentTransaction = CovisTransaction::where('status', 3)->where('visit_status', 2)->orderBy('created_at','desc')->limit(5)->get();

        return view('dashboard', compact([
            'totalTransaction','transactionCompleted','transactionInProgress',
            'totalTransactionCurrentMonth','totalTransactionCurrentWeek','finalTopSurvey',
            'totalTransactionCompletedCurrentMonth','totalTransactionCompletedCurrentWeek',
            'totalTransactionInProgressCurrentMonth','totalTransactionInProgressCurrentWeek',
            'transactionRegularCurrentMonth','transactionRegularCurrentMonthCompleted','transactionRegularCurrentWeek',
            'transactionRegularCurrentWeekCompleted','transactionLKMotorCurrentMonth','transactionLKMotorCurrentMonthCompleted',
            'transactionLKMotorCurrentWeek','transactionLKMotorCurrentWeekCompleted','transactionLKMobilCurrentMonth',
            'transactionLKMobilCurrentMonthCompleted','transactionLKMobilCurrentWeek','transactionLKMobilCurrentWeekCompleted',
            'recentTransaction','upMonthTotalData','upMonthTotalDataComplete','upMonthTotalDataProgress','upRegularMonth','upLKMotorMonth','upLKMobilMonth'
        ]));
    }
}
