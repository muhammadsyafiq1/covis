<?php

namespace App\Exports;

// use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use App\Models\CovisCustomer;
use Illuminate\Support\Facades\DB;

class DataCustomerExport implements FromQuery, WithTitle, ShouldAutoSize, WithHeadings, WithStyles
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function query()
    {
        return DB::table('covis_customers as a')
        ->leftJoin('companies as b','a.company_id', 'b.id')
        ->leftJoin('projects as c','a.project_id', 'c.id')
        ->leftJoin('branchs as d','a.branch_id', 'd.id')
        ->leftJoin('regions as e','a.region_id', 'e.id')
        ->leftJoin('covis_types as f','a.covis_type_id', 'f.id')
        ->leftJoin('indonesia_cities as g','a.city_code', 'g.code')
        ->leftJoin('indonesia_districts as h','a.district_code', 'h.code')
        ->leftJoin('indonesia_provinces as i','a.province_code', 'i.code')
        ->select(
            'a.name as debitur',
            'f.name as agunan',
            'd.name as branch',
            'e.name as region',
            'a.address as address',
            'g.name as city',
            'h.name as district',
            'i.name as province',
            'a.contact_name as PIC',
            'a.ao_name as account_officer_name',
            'a.contact_no as contact_no',
            'a.contact_office_no as contact_office_no'
        )
        ->orderBy('a.name');
    }

    public function title(): string
    {
        return 'Data Customer Covis';
    }

    public function headings(): array
    {
        return [
            'Nama Debitur',
            'Agunan',
            'Branch',
            'Region',
            'Address',
            'City',
            'District',
            'Province',
            'PIC',
            'Account Office',
            'Contact No',
            'Contact Office No',
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            // Style the first row as bold text.
            1    => ['font' => ['bold' => true]],
        ];
    }
}
