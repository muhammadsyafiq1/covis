<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CovisCustomer;
use App\Helpers\ResponseFormatter;

class CustomerController extends Controller
{
    public function all()
    {
        $customer = CovisCustomer::with('companyCustomer', 'projectCustomer', 'branchCustomer', 'regionCustomer', 'covisTypeCustomer', 'provinceCustomer', 'cityCustomer', 'districtCustomer')->get();

        return ResponseFormatter::success($customer, 'Customer successfully generated');
    }
}
