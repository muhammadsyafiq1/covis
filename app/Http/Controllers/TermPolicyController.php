<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TermPolicyController extends Controller
{
    public function index()
    {
        return view('knowledgebase.terms-policy');
    }
}
