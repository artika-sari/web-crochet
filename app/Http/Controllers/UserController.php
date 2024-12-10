<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function login() {
        return view('login');
    }

    public function loginAuth(Request $request) {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = $request->only(['email', 'password']);
        if (Auth::attempt($user)) {
            return redirect()->route('home');
        } else {
            return redirect()->back()->with('failed', 'Login failed, please try again later');
        }
    }

    public function logout() {
        Auth::logout();
        return redirect()->route('login')->with('success', 'You have successfully logged out!');
    }

    public function index(Request $request)
    {
        $user = User::where('name', 'LIKE', '%' . $request->search . '%')->simplePaginate(5);
        return view('account.userdata', compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('account.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'role' => 'required',
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        $proses = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'password' => $request->password,
        ]);

        if ($proses) {
            return redirect()->route('users')->with('success', 'Account data has been added');
        } else {
            return redirect()->route('users.add')->with('failed', 'Data account has failed to add');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::where('id', $id)->first();
        return view('account.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'role' => 'required',
            'name' => 'required',
            'email' => 'required',
        ]);

        $proses = User::where('id', $id)->update([
            'role' => $request->role,
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        if ($proses) {
            return redirect()-> route('users')->with('success', 'Data has been successfully changed');
        } else {
            return redirect()->route('users.edit')->with('failed', 'Failed to change data');
        }
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $proses = User::where('id', $id)->delete();
        if ($proses) {
            return redirect()->back()->with('success', 'Item data has been successfully deleted!');
        } else {
            return redirect()->back()->with('failed', 'item data failed to delete');
        }
    }
}
