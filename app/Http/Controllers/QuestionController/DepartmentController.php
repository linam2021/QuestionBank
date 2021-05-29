<?php

namespace App\Http\Controllers\QuestionController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\Department;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class DepartmentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        try
        {
            $departments=DB::table('departments')
            ->select('departments.id','departments.department_name')
            ->paginate(10);
            return view('layouts.home')->with(['departments'=>$departments]);
        } catch (\Throwable $th) {
            return redirect()->route('showDepartments')->with('error',$th->getMessage());
        }
    }


    public function addDepartment(Request $request)
    {
        try
        {
            $input = $request->all();
            $validator = Validator::make($input,[
                'department_name'=>'required|unique:departments,department_name',
            ]);
            if( $validator->fails()) {
                Session::flash('department_name', $request->department_name);
                return redirect()->back()->withErrors($validator);
            }
            else
            {
                Department::create([
                    'department_name'=>$request->department_name
                ]);
                return redirect()->route('showDepartments')->with('success','تم إضافة المسار بنجاح');
            }
        } catch (\Throwable $th) {
            Session::flash('department_name', $request->department_name);
            return redirect()->route('showDepartments')->with('error',$th->getMessage());
        }
    }
}
