<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index()
    {
        return view('form');
    }

    public function store(Request $request)
    {
        $request->session()->put('name', $request->name);
        $request->session()->put('hobby', $request->hobby);
        $request->session()->put('gender', $request->gender );
        $request->session()->put('favorite', $request->favorite);
        $request->session()->put('maritalStatus', $request->maritalStatus);
        return redirect('detail');
    }

    public function show(Request $request)
    {
        $data = $request->session()->all();
        return view('detail', compact('data'));
    }
}
