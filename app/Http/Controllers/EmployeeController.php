<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Employee;
use App\Department;
use Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Carbon\Carbon;
use Image;
use Storage;
use File;

class EmployeeController extends Controller
{

     public function __construct()
    {
        $this->middleware('auth')->except(['index']);  //  OR  $this->middleware('auth', ['except' => 'index']);

    }


    public function index() {
        
        $search = '';
        $resultCount = 0;
        if(request()->has('pag')) {
            Session::put('pag', request()->pag);
            $pag = request()->pag;
        } elseif (Session::has('pag')) {
            $pag = Session('pag');
        } else {
            $pag = 10;
        }

        if(request()->method() == 'POST') {
            if(empty(request()->search)) {
                Session::forget('search');
            } else {$search = request()->search;}
        } else {$search = Session('search');}

        if (!empty($search)) {
            $results = Employee::Filter($search)
                ->Active()
                ->orderBy('LastName')
                ->paginate($pag);
            
            return view('employees/index')->with('results', $results);  //  OR return view('employees/index', compact('results'));

        } else {
            
            return view('employees/index');
        }
    }


    public function create(){

        $departments = Department::WhereNull('parentid')->get();

        //return view('employees/create')->with('departments', $departments);
        return view('employees/createedit')->with('departments', $departments);
    }


    public function edit($id) {
        //$employee = Employee::leftjoin('Departments', 'Employees.DepartmentID', '=', 'Departments.id')->find($id);
        $employee = Employee::Default()->find($id);
        $departments = Department::RootDepartments()->get();
        //return view('employees.edit')->with(['employee'=> $employee, 'departments' => $departments]);
        return view('employees.createedit')->with(['employee'=> $employee, 'departments' => $departments]);
    }


    public function list(){

        $active = null;
        $search = '';

        if(request()->has('pag')) {
            Session::put('pag', request()->pag);
            $pag = request()->pag;
        } elseif (Session::has('pag')) {
            $pag = Session('pag');
        } else {
            $pag = 10;
        }

        if (request()->has('active')) {
            $active = request('active');
        }

        if(request()->method() == 'POST') {
            if(!request()->has('search')) {
                Session::forget('search');                
            } else {
                $search = request()->search;
            }
        } else {
            if (!empty(Session('search'))) {
                $search = Session('search');
            }
        }

        if (!empty($search)) {
            $results = Employee::Filter($search);
        } else {
            $results = Employee::default();
        }

        if ($active == '1') {
            $results->Active();
        } elseif ($active == '0') {
            $results->Inactive();
        }

        return view('employees/list')->with('results', $results->orderBy('LastName')->paginate($pag));

    }


    public function store(Employee $employee) {
        //dd(request()->hasFile('Photo'));
        $emp = Employee::create([
            'KST' => request('KST'),
            'FirstName' => request('FirstName'),
            'LastName' => request('LastName'),
            'Email' => request('Email'),
            'Extension' => request('Extension'),
            'Mobile' => request('Mobile'),
            'Phone' => request('Phone'),
            //'Fax' => request('Fax'),
            'DepartmentID' => request('DepartmentID'),
            'Title' => request('Title'),
            'Location' => request('Location')
        ]);
        //dd(request());
        if (request()->hasFile('Photo')) {

            $ext = request()->file('Photo')->guessExtension();
            Storage::delete($emp->UID);
            $path = request()->file('Photo')->storeAs('public', $emp->UID . '.' . $ext);
            //$image = Image::make(Storage::get($path));
            
            //Storage::put($path, $image);

            $path = explode('/', $path)[1];
            //dd($path);
            $emp->Photo = $path;

        } else {
            //return 'no photo';
            $emp->Photo = 'no_img.png';
        }

            $emp->save();

        return redirect('/list');
    }


   
    public function update($id) {

        $rules = array(
            'KST'       => 'required',
            'FirstName' => 'required',
            'LastName'  => 'required',
            'Extension' => 'numeric',
            'Mobile'    => 'numeric',
            'Phone'     => 'numeric',
            'DepartmentID'     => 'required|numeric',
            'Title'     => 'required',
            'Location'     => 'required'
        );
        $validator = Validator::make(request()->all(), $rules);

        // process the login
        if ($validator->fails()) {
            return Redirect::to('employee/' . $id . '/edit')
                ->withErrors($validator)
                ->withInput(request()->except('password'));
        } else {
            // store
            $emp = Employee::find($id);

            //dd($id);

            $emp->KST = request('KST');
            $emp->FirstName = request('FirstName');
            $emp->LastName  = request('LastName');
            $emp->Email     = request('Email');
            $emp->Extension = request('Extension');
            $emp->Mobile    = request('Mobile');
            $emp->Phone    = request('Phone');
            $emp->DepartmentID    = request('DepartmentID');
            $emp->Title    = request('Title');
            $emp->Location    = request('Location');

            if (request()->hasFile('Photo')) {

                $image = request()->file('Photo');

                $filename = $emp->UID . '.' . $image->getClientOriginalExtension();

                $path = 'public/' . $filename;
 
                Storage::delete($path);

                $img = Image::make($image->getRealPath())->resize(204, null, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                });
                
                Storage::put($path, $img->stream());

                $emp->Photo = $filename;
            } else {
                //return 'no photo' if no file matching <UID>.*;

                if (File::glob($emp->UID . ".*") === false){
                    $emp->Photo = 'no_img.png';
                }

                
            }

                $emp->save();
   
            //Session::flash('message', 'Successfully updated employee!');
            
            return back()->with('status','Datele angajatului au fost modificate cu succes!');
        }
    }


    public function show($uid) {
        return view('employees.show');
    }


    public function delete($uid) {

        Employee::find($uid)->delete();

        return back();

    }


    public function toggleStatus($id) {
        $emp = Employee::find($id);
        if($emp->Plecat == null) {
            Carbon::setToStringFormat('F d Y H:m');
            $plecat = Carbon::now('Europe/Bucharest');
            $emp->Plecat = $plecat;
        
        } else {
             $emp->Plecat = null;
        }
        $emp->save();

        return back();
    }

}
