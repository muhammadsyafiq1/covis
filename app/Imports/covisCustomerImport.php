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
use App\Models\User;
use App\Models\CovisClasses;
use App\Models\CovisPriority;
use App\Models\CovisTransaction;
use App\Models\CovisTransactionImage;
use App\Http\Controllers\MiscellaneousController;
use Illuminate\Validation\Rule;
use Ramsey\Uuid\Uuid;

class CovisCustomerImport implements ToCollection, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */

    public function collection(Collection $row)
    {
        $arr = [];
        $arr2 = [];

        foreach ($row as $key) {
            $agunan = CovisType::where('code', $key['collateral_type'])->first(); 
            $cek_customer = CovisCustomer::where('name', $key['customer_name'])
                            ->where('address', $key['address'])
                            ->where('covis_type_id', $agunan->id)
                            ->select('name')->first();
            if ($cek_customer) {
                array_push($arr2, $key['customer_name']);
            }
            array_push($arr, $key['customer_name']);
        }

        if (count($arr2) > 0) {
            dd($arr2);
        }

        foreach ($row as $r) {
            $branchh = str_replace("\n", " ", $r['branch_code']);
            $branch = Branch::where('code', $r['branch_code'])->first();
            $region = Region::where('code', $r['region_code'])->first();
            $type = CovisType::where('code', $r['collateral_type'])->first();
            $district = District::where('code', $r['district_code'])->first();
            if (!$district) dd('This district \'' . $r['district_name'] . '\' not fonud');
            $city = City::where('code',  $district->city_code)->first();
            $province = Province::where('code', $city->province_code)->first();

            if (!$branch) dd('This branch \'' . $r['branch'] . '\' not fonud');
            if (!$region) dd('This region \'' . $r['region_code'] . '\' not fonud');
            if (!$type) dd('This collateral type \'' . $r['type'] . '\' not fonud');
            
            //add customer
            $data = CovisCustomer::create([
                'code' => CovisCustomer::generateUniqueCode(),
                'project_id' => 1,
                'company_id' => 1,
                'branch_id' => $branch->id,
                'region_id' => $region->id,
                'covis_type_id' => $type->id,
                'name' => $r['customer_name'],
                'address' => $r['address'],
                'province_code' => $province->code,
                'city_code' => $city->code,
                'district_code' => $district->code,
                'contact_name' => $r['contact_name'],
                'contact_office_no' => MiscellaneousController::formatOfficeNumber($r['contact_office_no']),
                'contact_no' => MiscellaneousController::formatPhoneNumber($r['contact_no']),
                'contact_no_second' => MiscellaneousController::formatPhoneNumber($r['contact_no_second']),
                'ao_name' => $r['ao_name'],
                'ao_no' => $r['ao_mobile_no'],
                'is_active' => 1,
                'created_by' =>  auth()->user()->name
            ]);
            
            //add order
            if($r['verificator']){
                
                $veri = User::where('id', $r['verificator'])->first();
                $class = CovisClasses::where('code', $r['class_code'])->first();
                $prio = CovisPriority::where('code', $r['priority_code'])->first();

                if (!$class) dd('Pliss add classification on your template');
                if (!$prio) dd('Pliss add priority on your template');

                $uid = Uuid::uuid4();
                
                $td = $r['termination_date'] == null ? null : \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($r['termination_date']); 
                $bd = $r['backdate'] == null ? null : \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($r['backdate']); 
                
                $data = CovisTransaction::create([
                    'uuid' => $uid,
                    'covis_customer_id' => $data->id,
                    'user_id' => $veri->id,
                    'covis_class_id' => $class->id,
                    'covis_priority_id' => $prio->id,
                    'admin_note' => $r['admin_note'],
                    'termination_date' => $td,
                    'backdate' => $bd,
                    'status' => 1,
                    'visit_status' => 1,
                ]);
            
                CovisTransactionImage::create([
                    'covis_transaction_id' => $data->id,
                ]);
            }
        }
    }
}
