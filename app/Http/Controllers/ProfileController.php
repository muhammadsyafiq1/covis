<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;
use App\Models\UserImage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class ProfileController extends Controller
{
    public function index()
    {
        $user = User::get();
        $role = Role::pluck('name', 'id');
        // dd(auth()->user()->id);

        return view('profile.user-profile', compact('user', 'role'));
    }

    public function changePassword()
    {
        return view('profile.change-password');
    }

    public function postChangePassword(Request $request)
    {
        $validate = $request->validate([
            'password' => [
                'required',
                'string',
                'regex:/[0-9]/'
            ]
        ]);

        $user = User::findOrFail(auth()->user()->id);
        $user->update([
            'password' => Hash::make($request->password),
            'password_updated_at' => Carbon::now()
        ]);

        return redirect()->back()->with(['success' => 'Password has been changed']);
    }

    public function updatePhone(Request $request)
    {
        $phone = $request->phone;
        $user = User::findOrFail(auth()->user()->id);
        $user->update([
            'mobile_no' => MiscellaneousController::formatPhoneNumber($phone)
        ]);
        return redirect('profile')->with(['success' => 'Phone Number has been updated']);
    }


    public function updateProfilImage (Request $request)
    {

        $request->validate([
            'foto' => 'image',
        ]);

        $userProfil = UserImage::where('user_id', Auth::user()->id)->first();
        $foto = $request->file('foto');

        if($request->hasFile('foto')){
            // if($request->foto && file_exists(storage_path('app/public/'.$request->foto))){
            //     Storage::delete('public/images/'.$request->foto);
            // }
            // $file = $request->file('foto')->store('images','public');
            // $userProfil->foto = $file;

            $name = auth()->user()->name . '_' . time() . '.' . $foto->getClientOriginalExtension();
            $path = public_path('images/avatar/');
            $old_image = $path . $userProfil->name;
            unlink($old_image);

            $userProfil->update([
                'name' => $name
            ]);

            $foto->move(public_path('images/avatar/'), $name);
        }

        return redirect('profile')->with(['success' => 'foto profile has been updated']);
    }

}
