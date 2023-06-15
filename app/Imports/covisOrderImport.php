<?php

namespace App\Imports;

use App\Models\Branch;
use App\Models\CovisCustomer;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use App\Models\Project;
use App\Models\Company;
use App\Models\CovisType;
use Laravolt\Indonesia\Models\City;
use Laravolt\Indonesia\Models\District;
use Laravolt\Indonesia\Models\Province;
use App\Models\Region;
use App\Http\Controllers\MiscellaneousController;
use App\Models\CovisClasses;
use App\Models\CovisPriority;
use App\Models\CovisTransaction;
use App\Models\User;
use Illuminate\Validation\Rule;
use Ramsey\Uuid\Uuid;
use App\Models\CovisTransactionImage;
use Carbon\Carbon;


class CovisOrderImport implements ToCollection, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */

    public function collection(Collection $row)
    {


        foreach ($row as $r) {
            // dd($r);
            $cs = CovisCustomer::where('code', $r['customer_code'])->first();
            $veri = User::where('id', $r['verificator'])->first();
            $class = CovisClasses::where('code', $r['class_code'])->first();
            $prio = CovisPriority::where('code', $r['priority_code'])->first();
            $uid = Uuid::uuid4();
            
            $td = $r['termination_date'] == null ? null :\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($r['termination_date']); 
            $bd = $r['backdate'] == null ? null : \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($r['backdate']);
            
            $data = CovisTransaction::create([
                'uuid' => $uid,
                'covis_customer_id' => $cs->id,
                'user_id' => $veri->id,
                'covis_class_id' => $class->id,
                'covis_priority_id' => $prio->id,
                'admin_note' => $r['admin_note'],
                'termination_date' =>  $td,
                'backdate' => $bd,
                'status' => 1,
                'visit_status' => 1,
            ]);
            
            CovisTransactionImage::create([
                'covis_transaction_id' => $data->id,
            ]);
        }
    }

    // public function model(array $row)
    // {
    //     return new CovisCustomer([
    //         'code'     => $row[0],
    //         'company_id'     => $row[1],
    //         'project_id'     => $row[2],
    //         'branch_id'     => $row[3],
    //         'region_id'     => $row[4],
    //         'covis_type_id'     => $row[5],
    //         'address'     => $row[6],
    //         'province_code'     => $row[7],
    //         'city_code'     => $row[8],
    //         'district_code'     => $row[9],
    //         'contact_name'     => $row[10],
    //         'contact_no'     => $row[11],
    //         'ao_name'     => $row[12],
    //         'ao_no'     => $row[13],
    //     ]);
    // }
}
