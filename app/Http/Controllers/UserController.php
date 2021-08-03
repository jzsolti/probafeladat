<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UserAccountRequest;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getUser(Request $request)
    {
        $user = auth()->user();
        $user->created = $user->created_at->format('Y-m-d H:i');
        return response($user->only('name', 'email'));
    }

    
}
