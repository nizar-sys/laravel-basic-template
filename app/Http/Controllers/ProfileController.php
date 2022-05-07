<?php

namespace App\Http\Controllers;

use App\Http\Requests\RequestStoreUpdateProfile;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function myProfile()
    {
        $user = Auth::user();
        return view('dashboard.profile.index', compact('user'));
    }

    public function changeFotoProfile(Request $request)
    {
        try {

            $request->validate([
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:20348',
            ]);

            $imageName = time() . '.' . $request->image->extension();

            $request->image->move(public_path('/uploads/images'), $imageName);

            $user = User::findOrFail(Auth::id());

            $old_foto = public_path('/uploads/images/' . $user->avatar);
            if (file_exists($old_foto) && $user->avatar != 'avatar.png') {
                unlink($old_foto);
            }

            $user->update([
                'avatar' => $imageName,
                'updated_at' => date(now())
            ]);


            if ($request->ajax()) {
                return $this->success(null, 'success');
            }

            return redirect(route('profile'))->with('success', 'Berhasil ubah avatar profile');
        } catch (\Throwable $th) {
            if ($request->ajax()) {
                return $this->error('Error ' . $th->getMessage());
            }
            return back()->with('error', 'Error ' . $th->getMessage());
        }   
    }

    public function changeProfile(RequestStoreUpdateProfile $request)
    {
        try {
            $validated = $request->validated() + [
                'updated_at' => date(now())
            ];

            $user = User::findOrFail(Auth::id());

            if(!is_null($request->password)){
                $validated['password'] = Hash::make($request->password);
            } else {
                unset($validated['password']);
            }
            
            $user->update($validated);

            if ($request->ajax()) {
                return $this->success(null, 'Profile berhasil diubah');
            }

            return back()->with('success', 'Profile berhasil diubah');
        } catch (\Throwable $th) {

            if ($request->ajax()) {
                return $this->error('Error ' . $th->getMessage());
            }

            return back()->with('error', 'Error ' . $th->getMessage());
        }
    }
}
