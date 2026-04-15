<?php

namespace App\Services;

use App\Models\User;

class AuthService
{
    public function updateUser($request, $id)
    {
        $user = User::find($id);
        $_update = [
            'name' => $request->name,
            'phone' => $request->phone,
            'address' => $request->address,
        ];
        if( $user ) $user->update($_update);
        return $user->fresh();
    }

    public function getUser($id)
    {
        return User::find($id);
    }
}