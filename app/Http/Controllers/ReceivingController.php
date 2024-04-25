<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReceivingController extends Controller
{
    public function index()
    {
        return view('ras.receiving.receivingdashboard');
    }
       public function receivingpending()
    {
        return view('ras.receiving.receivingpending');
    }
    public function receivingreceived()
    {
        return view('ras.receiving.receivingreceived');
    }
    public function receivingedit()
    {
        return view('ras.receiving.receivingedit');
    }
}
