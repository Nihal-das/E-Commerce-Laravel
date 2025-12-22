<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function edit(User $user)
    {

        return view('users.edit', ['user' => $user]);
    }

    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name'   => 'required|string|max:30',
            'phone_number' => 'required|digits between:10,11',
            'address'  => 'nullable|max:500',
        ]);

        $user->update([

            'name'   => $validated['name'],
            'phone_number' => $validated['phone_number'],
            'address'  => $validated['address'],
        ]);

        return redirect()
            ->route('users.edit', $user->id)
            ->with('success', 'Item updated successfully');
    }
}
