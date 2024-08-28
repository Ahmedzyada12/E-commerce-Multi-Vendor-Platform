<?php

namespace App\Http\Controllers\apicontroller;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    public function manageAdmin()
    {
        $admins = User::with('role')->where('role_id', 1)->get();
        return response()->json($admins, 200);
    }

  
    public function manageUser()
    {
        $users = User::with('role')->where('role_id', 2)->get();
        return response()->json($users, 200);
    }
}