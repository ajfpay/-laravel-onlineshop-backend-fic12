<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\User;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    //index

    public function index(Request $request)
    {
        // get user with pagination
        $users = DB::table('users')
        ->when($request->input('name'), function ($query, $name) {
            return $query->where('name', 'like', '%' . $name . '%');
        })
        ->paginate(10);
        return view('pages.user.index', compact('users'));
    }

    //create

    public function create()
    {
        return view('pages.user.create');
    }

    //store

    public function store(Request $request)
    {
        $data = $request->all();
        $data['password'] = bcrypt($request->input('password'));
        User::create($data);
        return redirect()->route('user.index')->with('success', 'User successfully created');
    }

    //show

    public function show($id)
    {
        //show id
        $user = User::findOrFail($id);
        return view('pages.user.show', compact('user'));

    }

    //edit

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('pages.user.edit', compact('user'));
    }

    //update

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $data = $request->all();
        if ($request->input('password')) {
            $data['password'] = bcrypt($request->input('password'));
        } else {
            $data['password'] = $user->password;
        }
        $user->update($data);
        return redirect()->route('user.index')->with('success', 'User successfully updated');
    }

    //destroy

    public function destroy($id)
    {
        //destroy data
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('user.index')->with('success', 'User successfully deleted');
    }

}
