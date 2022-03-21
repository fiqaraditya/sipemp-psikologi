<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class PewawancaraController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pewawancaras = User::where('role', '=', 'pewawancara')->get();
        return view("daftar_pewawancara", compact('pewawancaras'));
    }
}
