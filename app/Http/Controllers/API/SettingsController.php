<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Employee;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Response;

class SettingsController extends Controller
{
    public function getUserData($id) {
        return response()->json(Employee::where('user_id', $id)->first());
    }

    public function updateUserData(Request $request, $id) {
        $validator = Validator::make($request->all(), [
            'responsability' => ['required', 'string', 'min: 3', 'max: 32'],
            'job_title' => ['required', 'string', 'min: 3', 'max: 32']
        ]);
        if($validator->fails()) {
            return response()->json($validator->messages(), Response::HTTP_BAD_REQUEST);
        }

        $employee = Employee::where('user_id', $id)->update($request->all());
        return response()->json($employee);
    }
}
