<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;


class RegisterUserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        dd($request->route('token'));




//        return Inertia::render('Auth/Register');
        return Auth::user();

    }


    public function store(Request $request)
    {

    }


}
