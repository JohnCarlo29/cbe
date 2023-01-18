<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\SendSmsRequest;
use App\Jobs\SendSMSJob;
use App\Models\Employee;

class SendSmsController extends Controller
{
    public function __invoke(SendSmsRequest $request)
    {
        Employee::select('mobile_number')
            ->when($request->has('employee_ids'), fn ($query) => $query->whereIn('id', $request->employee_ids))
            ->when($request->has('department_id'), fn ($query) => $query->where('department_id', $request->department_id))
            ->when($request->has('employee_id'), fn ($query) => $query->where('id', $request->employee_id))
            ->chunk(50, function ($employees) {
                foreach ($employees as $employee) {
                    SendSMSJob::dispatch($employee->mobile_number);
                }
            });

        return response()->json(['message' => 'Sending Sms']);
    }
}
