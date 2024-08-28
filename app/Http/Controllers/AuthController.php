<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class AuthController extends Controller
{

    public function registerpost(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed'],
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/images');
            $image->move($destinationPath, $imageName);
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            // 'image' => $imageName,
            'role_id' => 2
        ]);
        Auth::login($user);
        return back()->with('success', 'user is register and login');
    }
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
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role_id' => 1,
            'image' => $imageName,
        ]);

        // Redirect to the dashboard route after successful registration
        return redirect()->route('manageAdmin');
    }
    public function vendor_register(Request $request)
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
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role_id' => 3,
            'image' => $imageName,
        ]);

        // Redirect to the dashboard route after successful registration
        return redirect()->route('manageVendor');
    }

    public function loginPost(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = auth()->user();
            if ($user->role_id == 1) {
                return redirect()->route('dashboard_admin')->with('success', 'admin is login');
            } elseif ($user->role_id == 3) {
                return redirect()->route('dashboard_vendor')->with('success', 'vendor is login');
            }
            return redirect()->route('homePage')->with('success', 'user is login');
        } else {
            // Optionally, add an error message if login fails
            return back()->with('warning', 'The provided credentials do not match our records.');
        }
    }

    public function logout(Request $request)
    {

        if (auth()->check() && auth()->user()->role_id == 1 || auth()->check() && auth()->user()->role_id == 3) {
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            return redirect()->route('login')->with('success', ' logout successfully ');
        } elseif (auth()->check() && auth()->user()->role_id == 2) {
            Auth::logout();
            return redirect()->route('homePage')->with('success', 'user is logout ');
        }
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id); // Find the category or fail
        $user->delete(); // Delete the category
        return redirect()->back()->with('success', 'Category deleted successfully');
    }

    public function index()
    {
        return view('auth.login');
    }
}