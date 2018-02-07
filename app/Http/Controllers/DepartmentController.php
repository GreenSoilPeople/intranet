<?php

namespace App\Http\Controllers;

use Validator;
use Illuminate\Http\Request;
use App\Department;

class DepartmentController extends Controller
{
     public function __construct()
    {
        $this->middleware('auth');

    }


    public function index() {

        $departments = Department::RootDepartments();
        //dd($departments);
        return view('departments.index')->with('departments', $departments->get());
    }


    public function store() {
        //return request()->all();
        Department::create([
            'Name' => request('Name'),
            'ParentID' => request('ParentID') != -1 ? request('ParentID') : null
        ]);

        return back();
    }

    public function update($id) {
        
        $rules = array(
            'Name'       => 'required'
        );

        $validator = Validator::make(request()->all(), $rules);

        if ($validator->fails()) {
            return back()->withErrors($validator);
        }


        $dep = Department::find($id);
        $dep->Name = request('Name');
        $dep->ParentID = request('ParentID');
        $dep->save();
        return back();
    }

    public function delete($id) {

        $dep = Department::find($id);

        if($dep->employees()->Active()->count() > 0 ) {
            return back()->withErrors(array('message' => 'Departamentul "'. $dep->Name .'" nu poate fi sters pentru ca are angajati'));
        } else {

            $dep->delete();

            return back()->with('status', 'Departamentul "'. $dep->Name .'" a fost sters');

        }

    }
}
