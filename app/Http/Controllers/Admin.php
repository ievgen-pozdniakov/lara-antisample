<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Admin extends Controller
{
    public function view($adminId)
    {
            return User::find($adminId);
    }

    public function create(Request $request) {
        $user = new User();
        $user->name = $request->get('name') ?? 'John Doe';
        $user->email = $request->get('email');
        $user->email_verified_at = true;
        $user->password = $request->get('email') ?? 'qwerty123';

        $user->save();

        return response()->noContent();
    }

    public function update(Request $request, $adminId) {
        $user = User::find($adminId);
        $userFields = ['name', 'email', 'password'];

        foreach ($userFields as $field) {
            if ($request->has($field)) {
                $user->$field = $request->get($field);
            }
            $user->save();
        }

        return response()->noContent();
    }

    public function changePassword(Request $request, $adminId)
    {
        Auth::check();
        $authUser = Auth::user();

        app('log')->info("User {$authUser->name} changed password",);

        $user = User::find($adminId);
        $user->password = $request->get('password');

        return response()->noContent();
    }

    public function delete($adminId)
    {
        $user = User::find($adminId);

        $user->delete();

        return response()->noContent();
    }
}
