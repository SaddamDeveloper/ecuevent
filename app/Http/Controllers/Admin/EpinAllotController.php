<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EpinAllotController extends Controller
{
    public function memAllotEpinForm(){
        return view('admin.allot_epin_form');
    }
}
