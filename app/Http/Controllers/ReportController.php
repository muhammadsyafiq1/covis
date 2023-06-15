<?php

namespace App\Http\Controllers;

use App\Exports\DataCustomerExport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\User;
use App\Models\Branch;
use App\Models\CovisCustomer;
use App\Models\CovisTransaction;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\DataFixExport;

class ReportController extends Controller
{
    public function visit_report_index()
    {
        
        return view('report.visit');
    }

    public function visit_report_result(Request $request)
    {
        $start = $request->input('startdate');
        $end = $request->input('enddate');
        // dd($start);

        if ($start AND $end)
        {
            $report = CovisTransaction::whereBetween(DB::raw('DATE(visited_at)'), array($start, $end))->where('visit_status', 2)->get();
            return view('report.visit-result', compact('report'));
        }

        else
        {
            return redirect('visit-report');
        }
    }

    //
    public function achievement_report_index()
    {
        return view('report.achievement');
    }

    public function achievement_report_result(Request $request)
    {
        $start = $request->input('startdate');
        $end = $request->input('enddate');
        if ($start AND $end)
        {
            $report = CovisTransaction::whereBetween(DB::raw('DATE(visited_at)'), array($start, $end))->get();
            return view('report.visit-result', compact('report'));
        }

        else
        {
            return view('report.achievement');
        }
    }

    //
    public function outstanding_report_index()
    {
        return view('report.outstanding');
    }

    public function outstanding_report_result(Request $request)
    {
        $start = $request->input('startdate');
        $end = $request->input('enddate');

        $report = DB::table('users as surveyor')
                ->leftJoin('covis_transactions as transaction', 'surveyor.id', 'transaction.user_id')
                ->leftJoin('covis_customers as b', 'transaction.covis_customer_id','b.id')
                ->leftJoin('companies as c', 'b.company_id', 'c.id')
                ->leftJoin('projects as d', 'b.project_id', 'd.id')
                ->leftJoin('departments as e', 'surveyor.department_id', 'e.id')
                ->leftJoin('user_images as f', 'f.user_id', 'surveyor.id')
                ->select(DB::raw('surveyor.id as id,
                                surveyor.name as surveyor_name,
                                f.name as user_image,
                                e.name as department_name,
                                surveyor.email as surveyor_email,
                                c.name as company_name,
                                transaction.covis_class_id as class,
                                transaction.user_id as user,
                                transaction.visited_at as visit,
                                transaction.status as status,
                                transaction.is_revision as rev,
                                SUM(CASE WHEN transaction.status = 3 THEN 1 ELSE 0 END) as total_data,
                                SUM(CASE WHEN transaction.covis_class_id = 1 AND transaction.status = 3 THEN 1 ELSE 0 END) as total_regular,
                                SUM(CASE WHEN transaction.covis_class_id = 2 AND transaction.status = 3 THEN 1 ELSE 0 END) as total_lk_motor,
                                SUM(CASE WHEN transaction.covis_class_id = 5 AND transaction.status = 3 THEN 1 ELSE 0 END) as total_lk_mobil,
                                SUM(CASE WHEN transaction.is_revision = 1 AND transaction.status = 3 THEN 1 ELSE 0 END) as total_revision'))
                ->where('surveyor.user_role_id', 7)
                // ->where('transaction.status', 3)
                ->whereBetween('transaction.visited_at', [$start, $end])
                ->groupBy('surveyor.id')
                ->get();

        return view('report.outstanding-result', compact('report','start','end'));
    }

    public function transaction_report_index()
    {
        $transactions = CovisTransaction::all();
        return view('report.order' ,compact('transactions'));
    }

    public function transaction_report_result(Request $request)
    {
        // $status = $request->status;
        $from = date($request->startdate);
        $to = date($request->enddate);

        $report = DB::table('branchs as b')
                    ->leftJoin('companies as c','b.company_id','c.id')
                    ->leftJoin('projects as p','b.project_id','p.id')
                    ->leftJoin('regions as r','b.region_id','r.id')
                    ->leftJoin('covis_customers as v','b.id','v.branch_id')
                    ->leftJoin('covis_transactions as t','v.id','t.covis_customer_id')
                    ->select(DB::raw('b.id as id, b.code as code, b.name as name, p.name as project, c.name as company, r.name as region,
                                SUM(CASE WHEN t.status >= 1 THEN 1 ELSE 0 END) as total_data,
                                SUM(CASE WHEN t.visit_status = 2 THEN 1 ELSE 0 END) as total_complete,
                                SUM(CASE WHEN t.status = 3 THEN 1 ELSE 0 END) as total_proggres,
                                SUM(CASE WHEN t.status = 4 THEN 1 ELSE 0 END) as total_cancel'))
                                ->where('b.is_active', 1)
                                // ->whereBetween('t.updated_at', [$from, $to])
                                ->whereBetween(DB::raw('DATE(t.updated_at)'), array($from, $to))
                                ->groupBy('b.id')
                                ->get();
                return view('report.order-result', compact('report','from','to'));
    }

    public function achievement_report_resultx(Request $request)
    {
        // $status = $request->status;
        $from = date($request->startdate);
        $to = date($request->enddate);

        $report = DB::table('users as surveyor')
                ->leftJoin('covis_transactions as transaction', 'surveyor.id', 'transaction.user_id')
                ->leftJoin('covis_customers as b', 'transaction.covis_customer_id','b.id')
                ->leftJoin('companies as c', 'b.company_id', 'c.id')
                ->leftJoin('projects as d', 'b.project_id', 'd.id')
                ->leftJoin('departments as e', 'surveyor.department_id', 'e.id')
                ->leftJoin('user_images as f', 'f.user_id', 'surveyor.id')
                ->select(DB::raw('surveyor.id as id,
                                surveyor.name as name,
                                f.name as user_image,
                                e.name as department_name,
                                surveyor.email as email,
                                c.name as company_name,
                                transaction.covis_class_id as class,
                                transaction.user_id as user,
                                transaction.visited_at as visit,
                                transaction.visit_status as status,
                                transaction.is_revision as rev,
                                SUM(CASE WHEN transaction.status = 3 THEN 1 ELSE 0 END) as total_visit,
                                SUM(CASE WHEN transaction.covis_class_id = 1 AND transaction.visit_status = 2 THEN 1 ELSE 0 END) as total_regular,
                                SUM(CASE WHEN transaction.covis_class_id = 2 AND transaction.visit_status = 2 THEN 1 ELSE 0 END) as total_lk_motor,
                                SUM(CASE WHEN transaction.covis_class_id = 3 AND transaction.visit_status = 2 THEN 1 ELSE 0 END) as total_lk_mobil,
                                SUM(CASE WHEN transaction.is_revision = 2 AND transaction.visit_status = 2 THEN 1 ELSE 0 END) as total_revision'))
                ->where('surveyor.user_role_id', 7)
                ->whereBetween('transaction.visited_at', [$from, $to])
                ->groupBy('surveyor.id')
                ->get();

        return view('report.achievement-resultx', compact('report','from','to'));
    }

    public function cancel_transaction_report_index()
    {
        return view('report.cancel-order');
    }

    public function cancel_transaction_report_result()
    {
        return view('report.cancel-order-result');
    }

    public function download_report_index()
    {
        return view('report.download-data-fix');
    }

    public function download_pdf_report()
    {
        $pdf = PDF::loadView('pdf.report-pdf')->setPaper('a4', 'landscape');
        return $pdf->download('report.pdf');
    }

    public function download_pdf_lod()
    {
        $pdf = PDF::loadView('pdf.lod-pdf')->setPaper('a4', 'portrait');
        return $pdf->download('lod.pdf');
    }

    public function DownloadDataFix(Request $request)
    {
        $mode = $request->mode;
        $date_from = $request->date_from;
        $date_to = $request->date_to;
        return Excel::download(new DataFixExport($date_from, $date_to, $mode), 'Export_Data_Fix.xlsx');
    }

    public function view_download_data_customer()
    {
        return view('report.download-data-customer');
    }

    public function DownloadDataCustomer()
    {
        return Excel::download(new DataCustomerExport, 'Export_data_customer.xlsx');
    }

}
