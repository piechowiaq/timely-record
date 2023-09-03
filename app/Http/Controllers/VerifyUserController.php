<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;


class VerifyUserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {


        return Inertia::render('Auth/Register');

    }


    public function store(Request $request)
    {

    }


}
