<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('laravel-examples.users-management', compact('users'));
    }

    public function create(Request $request)
    {
        $validasi = $request->validate([
            'namauser' => 'required|string|max:40',
            'email' => 'required|email',
            'passwordUser' => 'required|string',
        ]);

        User::create([
            'name' => $validasi['namauser'],
            'email' => $validasi['email'],
            'password' => Hash::make($request->passwordUser),
            'role' => $request->role,
        ]);

        return redirect()->route('users-management');
    }

    public function edit($id)
    {
        $edituser = user::findOrFail($id);
        return view('laravel-examples.coba', compact('edituser'));

    }
    public function update(Request $request, $id)
    {
        $validasi = $request->validate([
            'namauser' => 'required|string|max:40',
            'email' => 'required|email',
            'role' => 'required|string',
        ]);

        $barang = User::findOrFail($id);

        $barang->update([
            'name' => $validasi['namauser'],
            'email' => $validasi['email'],
            'password' => Hash::make($request->passwordUser),
            'role' => $request->role,
        ]);

        return redirect()->route('users-management');
    }

    public function delete($id)
    {
        $deleteuser = User::find($id);
        $deleteuser->delete();

        return redirect()->route('users-management');
    }

    public function addUser()
    {
        return view('laravel-examples.add_user');
    }

    public function coba()
    {
        return view('laravel-examples.coba');
    }
}
