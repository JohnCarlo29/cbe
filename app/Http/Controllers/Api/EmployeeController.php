<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\EmployeeRequest;
use App\Http\Resources\EmployeeResource;
use App\Models\Employee;

class EmployeeController extends Controller
{
    public function index()
    {
        return EmployeeResource::collection(Employee::paginate());
    }

    public function store(EmployeeRequest $request)
    {
        $Employee = Employee::create($request->validated());

        return new EmployeeResource($Employee);
    }

    public function show(Employee $Employee)
    {
        return new EmployeeResource($Employee);
    }

    public function update(Employee $employee, EmployeeRequest $request)
    {
        $Employee = tap($employee)->update($request->validated());

        return new EmployeeResource($employee);
    }

    public function destroy(Employee $Employee)
    {
        $Employee->delete();

        return response()->json(['message' => 'Employee Removed']);
    }
}
