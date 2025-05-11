<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Activitylog\Facades\Activity;

class UserController extends Controller
{
    public function fetchAllRecords()
    {
        return response()->json(Student::all());
    }

  //fetch record by name
    public function show($name)
    {
        $user = User::find(1);
        $user->assignRole('admin');  // Assign a role
        $user = User::where('name', $name)->first();
        $user = User::find(2);
        $user->assignRole('user');  // Assign a role
        $user->givePermissionTo('show data');  // Give a permission
        $user = User::where('name', $name)->first();

        if (!$user) {
            return response()->json(['message' => 'user not found'], 404);
        }

        return response()->json($user);
    }

    public function edit($id)
{
    $user = User::findOrFail($id); // Retrieve the user by ID
    return view('users.edit', compact('user')); // Pass the user data to the view
}

    // update record
    public function update(Request $request, $id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json(['message' => 'user not found'], 404);
        }

        $user->update($request->only(['name', 'email', 'password']));

        activity()
        ->performedOn($user) 
        ->causedBy(auth()->user())
        ->log('Updated user information'); 


        return response()->json(['message' => 'User updated successfully!']);

    }

    // delete
    public function delete($id)
    {
        $user = Student::find($id);

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        $user->delete();

        activity()
        ->performedOn($user) 
        ->causedBy(auth()->user())
        ->log('deleted user information'); 

        return response()->json(['message' => 'User deleted successfully']);
    }
}
