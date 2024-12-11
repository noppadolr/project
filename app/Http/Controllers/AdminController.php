<?php

namespace App\Http\Controllers;

use App\Http\Requests\AdminUpdateProfile;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{

    public function profile()
    {
        $authid = Auth::user()->id;
        $data=User::findOrFail($authid);
//        dd($data);
        return view('admin.profile',compact('data'));

    }//end method

    public function dashboard()
    {
        return view('admin.dashboard');
    }//end method

    public function forgotPassword()
    {

        return view('admin.forgot-password');

    }
    public function Logout(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    }//end method

    public function UpdateProfile(AdminUpdateProfile $request)
    {
//        dd($request->all());
        $id=Auth::user()->id;
        $data=User::findOrFail($id);

        $data->name=$request->name;
        $data->email=$request->email;
        $data->username=$request->username;
//        if($request->phone) {
            $data->phone = $request->phone;
//        }
        $data->updated_at = Carbon::now();
        if ($request->file('photo')) {
            if ($data->photo) {
                @unlink(public_path('upload/adminImages/' . $data->photo));
            }
            $file = $request->file('photo');
            $filename = $id . "_" . $file->getClientOriginalName();
            $file->move(public_path('upload/adminImages'), $filename);
            $data['photo'] = $filename;
        }
        $data->save();
        return redirect(route('admin.profile'))->with('success', 'Profile updated successfully');

    }//end method

    public function changePassword()
    {
        $authid = Auth::user()->id;
        $data=User::findOrFail($authid);
        return view('admin.change-password',compact('data'));
    }//end method

    public function UpdatePassword(Request $request)
    {

        $request->validate([
            'current_password' => ['required','string','min:3'],
            'password' => ['required', 'string', 'min:3', 'confirmed']
        ]);

        $auth = Auth::user();

        #Match The Old Password
        if(!Hash::check($request->current_password, auth()->user()->password)){
            return back()->with("error", "Old Password Doesn't match!");
        }

// Current password and new password same
        if (strcmp($request->current_password, $request->password) == 0)
        {
            return redirect()->back()->with("error", "New Password cannot be same as your current password.");
        }

        $user =  User::find($auth->id);
        $user->password =  Hash::make($request->password);
        $user->updated_at= Carbon::now();
        $user->save();
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();


        return redirect()->route('login')->with('success', "Password Changed Successfully");

    }//end method
}
