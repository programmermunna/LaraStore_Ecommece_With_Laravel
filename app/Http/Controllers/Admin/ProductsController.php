<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function Index(){
        return view('admin.content.products.products');
    }

    public function Add(){
        return view('admin.content.products.product-add');
    }

    public function Store(){
        return 'store';
    }

    public function Edit(){
        return view('admin.content.products.product-edit');
    }

    public function Update(){
        return 'update';
    }

    public function Delete(){
        return 'delete';
    }
}
