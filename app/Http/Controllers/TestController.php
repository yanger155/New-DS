<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestController extends Controller
{
    //
    public function index()
    {
        return view('test.index');
    }

    public function create()
    {
        return view('test.create');
    }

    public function store()

    {
        return view('test.store');
    }

    public function show($id)

    {

    }

    public function edit($id)

    {

    }


    public function update($id)

    {

    }

    public function destroy($id)

    {

    }

}
