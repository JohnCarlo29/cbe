<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\DepartmentRequest;
use App\Http\Resources\DepartmentResource;
use App\Models\Department;

class DepartmentController extends Controller
{
    public function index()
    {
        return DepartmentResource::collection(Department::paginate());
    }

    public function store(DepartmentRequest $request)
    {
        $Department = Department::create($request->validated());

        return new DepartmentResource($Department);
    }

    public function show(Department $Department)
    {
        return new DepartmentResource($Department);
    }

    public function update(Department $Department, DepartmentRequest $request)
    {
        $Department = tap($Department)->update($request->validated());

        return new DepartmentResource($Department);
    }

    public function destroy(Department $department)
    {
        $department->delete();

        return response()->json(['message' => 'Department Removed']);
    }
}
