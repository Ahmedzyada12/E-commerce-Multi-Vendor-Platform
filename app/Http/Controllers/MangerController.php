<?php

namespace App\Http\Controllers;

use App\Models\Manger;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class MangerController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function manger_register(Request $request)
    {
        // Validate the request data
        //  $request->validate([
        //      'name' => 'required|string|max:255',
        //      'email' => 'required|string|email|max:255|unique:mangers,email',
        //      'password' => 'required|confirmed',
        //      'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Validate the image
        //  ]);
        // Process the image
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/images');
            $image->move($destinationPath, $imageName);
        }

        // Create a new manager in the database
        Manger::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password), // Encrypt the password before storing it
            'role_id' => 1, // Assuming '1' is the role ID for managers
            'image' => $imageName, // Save the image name/path in the database
        ]);

        // Redirect to the dashboard route after successful registration
        return redirect()->route('manageAdmin');
    }

    public function manger()
    {
        return view('Bacckend.admin.signup');
    }
    public function vendor()
    {
        return view('Bacckend.admin.signup_vendor');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::guard('admin')->attempt($credentials)) {
            return redirect()->route('admin.dash');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }


    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('loginAdmin');
    }

    public function index()
    {
        return view('auth.login');
    }
   
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Manger $manger)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Manger $manger)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Manger $manger)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $user = Manger::findOrFail($id); // Find the category or fail
        $user->delete(); // Delete the category
        return redirect()->back()->with('success', 'User deleted successfully');
    }
}