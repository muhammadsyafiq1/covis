<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use App\Models\CovisTransaction;
use Illuminate\Support\Facades\DB;

class DataFixExport implements FromQuery, WithTitle, ShouldAutoSize, WithHeadings, WithStyles
{
    /**
    * @return \Illuminate\Support\Query
    */

    protected $date_from;
    protected $date_to;
    protected $mode;

    function __construct($date_from, $date_to, $mode) {
        $this->date_from = $date_from;
        $this->date_to = $date_to;
        $this->mode = $mode;
    }

    public function query()
    {
        if($this->mode == 'complete'){
            return DB::table('covis_transactions as a')
                ->join('users as b', 'a.user_id', 'b.id')
                ->join('covis_customers as c', 'a.covis_customer_id','c.id')
                ->join('covis_classes as d', 'a.covis_class_id','d.id')
                ->join('covis_priorities as e', 'a.covis_priority_id','e.id')
                ->join('covis_conditions as f', 'a.covis_condition_id','f.id')
                ->join('covis_used_fors as g', 'a.covis_used_for_id','g.id')
                ->join('covis_access_types as h', 'a.covis_access_type_id','h.id')
                ->join('covis_types as i', 'c.covis_type_id','i.id')
                ->join('indonesia_districts as j', 'c.district_code','j.code')
                ->join('indonesia_cities as k', 'c.city_code','k.code')
                ->join('regions as kanwil', 'c.region_id','kanwil.id')
                ->join('branchs as branch', 'c.branch_id','branch.id')
                ->where('a.status', 3)
                ->where('a.visit_status', 2)
                ->where('a.is_revision', null)
                ->whereBetween(\DB::raw('DATE(a.visited_at)'), [$this->date_from, $this->date_to])
                ->select(
                    // 'c.name as customer_name',
                    DB::raw('UPPER(c.name) AS customer_name'),
                    DB::raw('UPPER(i.name) AS spesifik_agunan'),
                    DB::raw('UPPER(c.address) AS support_address'),
                    DB::raw('UPPER(c.address) AS revisi_address'),
                    DB::raw('UPPER(j.name) AS distrcit'),
                    DB::raw('UPPER(k.name) AS city'),
                    DB::raw('UPPER(branch.name) AS branch_name'),
                    DB::raw('UPPER(kanwil.name) AS kanwil_name'),

                    DB::raw('UPPER(c.contact_name) AS cp'),

                    DB::raw('UPPER(c.contact_no) AS co_no'),
                    DB::raw('UPPER(a.termination_date) AS tod'),
                    DB::raw('UPPER(c.ao_name ) AS account_officer'),
                    DB::raw('DATE(a.visited_at) AS visit'),
                    DB::raw('UPPER(a.revision_date ) AS revisi_date'),
                    DB::raw('UPPER(b.name ) AS verificator'),
                    DB::raw('UPPER(d.name ) AS class'),
                    DB::raw('UPPER(a.admin_note ) AS mesin')
                )
                ->orderBy('c.name');
        }else{
            return DB::table('covis_transactions as a')
            ->join('users as b', 'a.user_id', 'b.id')
            ->join('covis_customers as c', 'a.covis_customer_id','c.id')
            ->join('covis_classes as d', 'a.covis_class_id','d.id')
            ->join('covis_priorities as e', 'a.covis_priority_id','e.id')
            ->join('covis_conditions as f', 'a.covis_condition_id','f.id')
            ->join('covis_used_fors as g', 'a.covis_used_for_id','g.id')
            ->join('covis_access_types as h', 'a.covis_access_type_id','h.id')
            ->join('covis_types as i', 'c.covis_type_id','i.id')
            ->join('indonesia_districts as j', 'c.district_code','j.code')
            ->join('indonesia_cities as k', 'c.city_code','k.code')
            ->join('regions as kanwil', 'c.region_id','kanwil.id')
            ->join('branchs as branch', 'c.branch_id','branch.id')
            ->where('a.status', 3)
            ->where('a.visit_status', 2)
            ->where('a.is_revision', 2)
            ->whereBetween(\DB::raw('DATE(a.revision_date)'), [$this->date_from, $this->date_to])
            ->select(
                // 'c.name as customer_name',
                DB::raw('UPPER(c.name) AS customer_name'),
                DB::raw('UPPER(i.name) AS spesifik_agunan'),
                DB::raw('UPPER(c.address) AS support_address'),
                DB::raw('UPPER(c.address) AS revisi_address'),
                DB::raw('UPPER(j.name) AS distrcit'),
                DB::raw('UPPER(k.name) AS city'),
                DB::raw('UPPER(branch.name) AS branch_name'),
                DB::raw('UPPER(kanwil.name) AS kanwil_name'),

                DB::raw('UPPER(c.contact_name) AS cp'),

                DB::raw('UPPER(c.contact_no) AS co_no'),
                DB::raw('UPPER(a.termination_date) AS tod'),
                DB::raw('UPPER(c.ao_name ) AS account_officer'),
                DB::raw('DATE(a.visited_at) AS visit'),
                DB::raw('UPPER(a.revision_date ) AS revisi_date'),
                DB::raw('UPPER(b.name ) AS verificator'),
                DB::raw('UPPER(d.name ) AS class'),
                DB::raw('UPPER(a.admin_note ) AS mesin')
            )
            ->orderBy('c.name');
        }
    }

    public function title(): string
    {
        return 'DATA FIX COVIS';
    }

    public function headings(): array
    {
        return [
            'CUSTOMER NAME',
            'SPESIFIK AGUNAN',
            'GUARANTEE ADDRESS (SUPPORT)',
            'GUARANTEE ADDRESS (REVISION)',
            'SUB ZONE', 
            'ZONE',
            'BRANCH MAIN OFFICE ',
            'OFFICE ZONE',
            'CP',
            'PHONE NUMBER',
            'DATE OF TERMINATION',
            'AO NAME',
            'VISIT ACTUAL',
            'REVISION VISIT',
            'VERIFICATION',
            'LUAR KOTA',
            'KETERANGAN'
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
        // Style the first row as bold text.
        1    => ['font' => ['bold' => true]],
        2    => ['border' => ['bold' => true]],
        ];
    }
}
