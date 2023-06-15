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
use Illuminate\Validation\Rule;

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
            // dd($key);
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

        // dd($arr2);
        if (count($arr2) > 0) {
            // return back()->with('error', 'Error');
            dd($arr2);
        }

        foreach ($row as $r) {
            // dd($r); die;
            // $project = Project::where('code', $r['project_code'])->first();
            $branchh = str_replace("\n", " ", $r['branch_code']);
            $branch = Branch::where('code', $r['branch_code'])->first();
            $region = Region::where('code', $r['region_code'])->first();
            $type = CovisType::where('code', $r['collateral_type'])->first();
            // $diss = str_replace("\n", " ", $r['district']);
            $district = District::where('code', $r['district_code'])->first();
            if (!$district) dd('This district \'' . $r['district_name'] . '\' not fonud');
            $city = City::where('code',  $district->city_code)->first();
            $province = Province::where('code', $city->province_code)->first();


            if (!$branch) dd('This branch \'' . $r['branch'] . '\' not fonud');
            if (!$region) dd('This region \'' . $r['region_code'] . '\' not fonud');
            if (!$type) dd('This collateral type \'' . $r['type'] . '\' not fonud');
            //
            // $customer = CovisCustomer::where('name', $r['customer_name'])->first();
            // if ($customer) {
            //     dd('Customer ' . $r['customer_name'] . ' has already registered');
            // }
            CovisCustomer::create([
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
