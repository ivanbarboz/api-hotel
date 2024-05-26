<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    public function index(){
        $departments = Department::get();
        return response()->json($departments);
    }

    public  function create(Request $request){
        Department::create($request->all());
        return response()->json(['response','Departamento creado correctamente']);
    }
}


