<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Employee;
use App\Models\Position;
use Validator;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pageTitle = 'Employee List';

        // $employees = DB::select(
        //     'select *, employees.id as employee_id, positions.name as position_name
        //     from employees
        //     left join positions on employees.position_id = positions.id'
        // );

        // $employees = DB::table('employees')
        //             ->leftJoin('positions', 'employees.position_id', '=', 'positions.id')
        //             ->get(['employees.*', 'positions.name']);

        $employees = Employee::all();

        return view('employee.index', compact('pageTitle', 'employees'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $pageTitle = 'Create Employee';
        // $positions = DB::table('positions')->get();
        $positions = Position::all();

        return view('employee.create', compact('pageTitle', 'positions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $messages = [
            'required' => ':Attribute harus diisi.',
            'email' => 'Isi :attribute dengan format yang benar',
            'numeric' => 'Isi :attribute dengan angka'
        ];

        $validator = Validator::make($request->all(), [
            'firstName' => 'required',
            'lastName' => 'required',
            'email' => 'required|email',
            'age' => 'required|numeric',
        ], $messages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        //  DB::table('employees')->insert([
        //     'firstname' => $request->firstName,
        //     'lastname' => $request->lastName,
        //     'email' => $request->email,
        //     'age' => $request->age,
        //     'position_id' => $request->position,
        // ]);

        $employee = New Employee;
        $employee->firstname = $request->firstName;
        $employee->lastname = $request->lastName;
        $employee->email = $request->email;
        $employee->age = $request->age;
        $employee->position_id = $request->position;
        $employee->save();

        // return $request->all();
        return redirect()->route('employees.index');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $pageTitle = 'Employee Detail';

        // $employee = collect(DB::select('
        //     select *, employees.id as employee_id, positions.name as position_name
        //     from employees
        //     left join positions on employees.position_id = positions.id
        //     where employees.id = ?',
        //     [$id])
        // )->first();

        // $employee = DB::table('employees')
        //     ->leftJoin('positions', 'employees.position_id', '=', 'positions.id')
        //     ->where('employees.id', $id)->first();

        $employee = Employee::find($id);

        return view('employee.show', compact('pageTitle', 'employee'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // dd($id);
        $pageTitle = ' Edit Employee';

        // $employee = DB::table('employees')
        //     ->leftJoin('positions', 'employees.position_id', '=', 'positions.id')
        //     ->where('employees.id', $id)->first(['employees.*', 'positions.name']);

        $employee = Employee::find($id);

        $positions = DB::table('positions')->get();

        return view('employee.edit', compact('pageTitle', 'employee', 'positions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $messages = [
            'required' => ':Attribute harus diisi.',
            'email' => 'Isi :attribute dengan format yang benar',
            'numeric' => 'Isi :attribute dengan angka'
        ];

        $validator = Validator::make($request->all(), [
            'firstName' => 'required',
            'lastName' => 'required',
            'email' => 'required|email',
            'age' => 'required|numeric',
        ], $messages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $getEmployee = Employee::find($id);
        $getEmployee->firstname = $request->firstName;
        $getEmployee->lastname = $request->lastName;
        $getEmployee->age = $request->age;
        $getEmployee->email = $request->email;
        $getEmployee->position_id = $request->position;
        $getEmployee->save();

        return redirect()->route('employees.index')->with('success', 'Berhasil Mengupdate Data');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // DB::table('employees')
        //     ->where('id', $id)
        //     ->delete();
        Employee::find($id)->delete();

        return redirect()->route('employees.index');
    }
}
