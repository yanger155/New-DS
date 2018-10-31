<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategorysController extends Controller
{
    //
    public function category_add()
    {
        return view('Admin.goods.product-category-add');
    }
    
    public function index()
    {
        return view('Admin.goods.Category_Manage');

    }

    public function create()
    {


    }

    public function store()
    {


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
