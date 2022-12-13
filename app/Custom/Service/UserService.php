<?php
namespace App\Custom\Service;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserService
{
    public function getUserData()
    {
    }

    public function storeUserData($request)
    {
        $user = User::updateOrCreate(
            ['id' => $request->edit_id],
            [
                'title' => $request->title,
                'name' => $request->name,
                'email' => $request->email,
                'gender' => $request->gender,
                'dob' => $request->dob,
                'religion' => $request->religion,
                'username' => $request->username,
                'phone' => $request->phone,
                'address_1' => $request->address_1,
                'address_2' => $request->address_2,
                'password' => Hash::make($request->role_id),
                'status' => $request->status == 'on' ? 1 : 0,
            ]
        );
        // $request->except(['status', 'role_id'])

        $user->assignRole($request->role_id);

        return $this;
    }

    public function editUserData($user)
    {
        return $user;
    }
}
