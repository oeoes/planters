<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function index() {
        $employees = Employee::orderByDesc('created_at')->get();
        return view('users.employee.index', [
            'employees' => $employees
        ]);
    }
}
