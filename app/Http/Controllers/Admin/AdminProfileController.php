<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminProfileController extends Controller
{
    public function update(Request $request)
    {
        $request->user()->update(
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|max:255',
            ])
        );

        return back()->with('status', 'profile-updated');
    }

    public function destroy(Request $request)
    {
        $request->user()->delete();

        return redirect('/')->with('status', 'admin-account-deleted');
    }
}
