<?php

use App\User;
use App\Machines;
use App\Jobs;
use App\MaterialType;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware(['auth:api'])->group(function (){
    //List users
    Route::middleware(['scope:admin'])->get('/users', function (Request $request) {
        return User::get();
    });

    //Edit User
    Route::middleware(['scope:admin'])->put('/users/{userId}', function(Request $request, $userId) {

        try {
            $user = User::findOrFail($userId);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'message' => 'User not found.'
            ], 403);
        }

        $user->update($request->all());

        return response()->json(['message'=>'User updated successfully.']);
    });

    //Delete User
    Route::middleware(['scope:admin,'])->delete('/users/delete/{userId}', function(Request $request, $userId) {

        try {
            $user = User::findOrFail($userId);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'message' => 'User not found.'
            ], 403);
        }

        $user->delete();

        return response()->json(['message'=>'User deleted successfully.']);
    });

    Route::middleware(['scope:admin,manager,engineer,maintenance,operator'])->get('/machines', function(Request $request) {
        return Machines::get();
    });

    Route::middleware(['scope:admin,manager,engineer,maintenance,operator'])->get('/material_types', function(Request $request) {
        return MaterialType::get();
    });

    Route::middleware(['scope:admin,manager,engineer,maintenance,operator'])->get('/jobs/{machine_id}', function(Request $request, $machine_id) {
        return Jobs::with(['machine', 'materialType'])->where('machine_id', '=', $machine_id)->orderBy('priority', 'asc')->get();
    });

    Route::middleware(['scope:admin,manager'])->put('/jobs/updateJobsOrder', function(Request $request) {
        $array = $request->data;

        // foreach ($array as $value) {
        //     return gettype($value);
        // }

        for ($i = 0; $i < count($array); $i++) {
            // return response()->json(gettype($array));
            // return response()->json($array[$i]['id']);
            $array[$i]['priority'] = $i + 1;
            // return response()->json($array[$i]);

            try {
                $job = Jobs::findOrFail($array[$i]['id']);
            } catch (ModelNotFoundException $e) {
                return response()->json([
                    'message' => 'User not found.'
                ], 403);
            }

            DB::table('jobs')->where('id', $array[$i]['id'])->update(['priority' => $i+1]);
            // $job->update(['priority' => 1]);

        }
    });

    Route::middleware(['scope:admin,manager,'])->post('/newJob', function(Request $request) {
        return Jobs::create($request->all());
    });

    Route::middleware(['scope:admin,manager,operator'])->put('/job/{jobID}/startJob', function(Request $request, $jobID) {
        DB::table('jobs')->where('id', $jobID)->update(['start_time' => now(), 'job_status' => 'running']);
    });

    Route::middleware(['scope:admin,manager,operator'])->put('/job/{jobID}/stopJob', function(Request $request, $jobID) {
        DB::table('jobs')->where('id', $jobID)->update(['end_time' => now(), 'job_status' => 'stopped']);
    });
});

Route::post('register', 'AuthController@register');
Route::post('login', 'AuthController@login');

