<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\RequestStoreOrUpdateUser;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware(['roles:admin'])->except(['index', 'show', 'userDataTable']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::orderByDesc('id');
        $users = $users->paginate(50);

        return view('dashboard.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RequestStoreOrUpdateUser $request)
    {
        $validated = $request->validated() + [
            'created_at' => now(),
        ];

        $fileName = time() . '.' . $request->avatar->extension();
        $validated['avatar'] = $fileName;
        $validated['password'] = Hash::make($validated['password']);

        // move file
        $request->avatar->move(public_path('uploads/images'), $fileName);

        $user = User::create($validated);

        return redirect(route('users.index'))->with('success', 'User berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return User::findOrFail($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);

        return view('dashboard.users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(RequestStoreOrUpdateUser $request, $id)
    {
        $validated = $request->validated() + [
            'updated_at' => now(),
        ];

        $user = User::findOrFail($id);

        $validated['avatar'] = $user->avatar;

        if($request->hasFile('avatar')){
            $fileName = time() . '.' . $request->avatar->extension();
            $validated['avatar'] = $fileName;

            // move file
            $request->avatar->move(public_path('uploads/images'), $fileName);
            
            // delete old file
            $oldPath = public_path('/uploads/images/'.$user->avatar);
            if(file_exists($oldPath)){
                unlink($oldPath);
            }
        }

        $user->update($validated);

        return redirect(route('users.index'))->with('success', 'User berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        // delete old file
        $oldPath = public_path('/uploads/images/'.$user->avatar);
        if(file_exists($oldPath)){
            unlink($oldPath);
        }
        $user->delete();

        return redirect(route('users.index'))->with('success', 'User berhasil dihapus.');
    }

    public function userDataTable()
    {
        return view('dashboard.users.index-data');
    }
}
