<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CovisTransaction;

class MiscellaneousController extends Controller
{
    // contact_no
    public static function formatPhoneNumber($number)
    {
        switch(strlen($number)) {
            case 9 :
                $number = '+62 ' . substr($number, 0, 3) . '-' . substr($number, 3, 4) . '-' . substr($number, 7, 2);
            break;
            case 10 :
                $number = '+62 ' . substr($number, 0, 3) . '-' . substr($number, 3, 4) . '-' . substr($number, 7, 3);
            break;
            case 11 :
                $number = '+62 ' . substr($number, 0, 3) . '-' . substr($number, 3, 4) . '-' . substr($number, 7, 4);
            break;
            default :
                $number = $number;
        }
        return $number;
    }

    // contact_office_no
    public static function formatOfficeNumber($number)
    {
        switch (strlen($number)) {
            case 9:
                $number = '+62-' . substr($number, 0, 2) . ' ' . substr($number, 2, 4) . '-' . substr($number, 6, 4);
                break;
            case 10:
                $number = '+62-' . substr($number, 0, 2) . ' ' . substr($number, 2, 4) . '-' . substr($number, 6, 5);
                break;
            case 11:
                $number = '+62-' . substr($number, 0, 2) . ' ' . substr($number, 2, 4) . '-' . substr($number, 6, 6);
                break;

            default:
                $number = $number;
                break;
        }
        return $number;
    }

    public static function generateUID()
    {
        $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < 12; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        $striped = substr($randomString, 0, 4) . '-' . substr($randomString, 4, 4) . '-' . substr($randomString, 8, 4);
        $check = CovisTransaction::where('uuid', $striped)->first();
        if (!$check) {
            return $striped;
        } else {
            return $this->generateUID();
        }
    }
}
