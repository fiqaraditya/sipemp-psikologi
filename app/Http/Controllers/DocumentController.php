<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Document;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class DocumentController extends Controller
{
    public function create_lk()
    {
        return view('submit1');
    }

    public function create_psikotest()
    {
        return view('submit2');
    }

    public function create_rekomendasi()
    {
        return view('submit3');
    }

    public function create_email()
    {
        return view('submit-email');
    }
}
