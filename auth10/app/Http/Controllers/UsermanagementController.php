<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Exception;

class UsermanagementController extends Controller
{
    //
    public function index()
    {
        $user = User::all();
        return view('usermanagement.users', compact('user'));
    }
    public function add()
    {
        return view('usermanagement.adduser');
    }

    public function create(Request $request)
    {
        // dd($request->all());
        $user = User::where('email', $request->email)->first();
        // dd($user->email);
        if ($user) {
            $request->session()->flash('error', 'User Already Exist');
            return redirect('/users/list');
        } else {
            if ($request->hasfile('profilepicture')) {
                $allowedextention = ['jpeg', 'png', 'jpg'];
                $extention = $request->profilepicture->getClientOriginalExtension();
                $check =  in_array($extention, $allowedextention);
                if ($check) {
                    if ($request->file('profilepicture')) {
                        $fileName = time() . '_' . $request->profilepicture->getClientOriginalName();
                        $filePath = $request->file('profilepicture')->store('public/profilepicture');
                        // dd($filePath);
                        // $filePath = resize(300, 300);
                    }
                }

                try {
                    User::create([
                        'name' => $request->name,
                        'email' => $request->email,
                        'role' => $request->role,
                        'password' =>  Hash::make($request->password),
                        'created_by' => Auth::id(),
                        'profilepicture' => $filePath

                    ]);

                    $request->session()->flash('success', 'User Created Successfully');
                    return redirect('/users/list');
                } catch (Exception $ex) {
                    $notification = array(
                        'error' => $ex->getMessage(),
                        // 'error' => $ex
                    );
                    return back()->with($notification);
                }
            } else {
                try {
                    User::create([
                        'name' => $request->name,
                        'email' => $request->email,
                        'role' => $request->role,
                        'password' =>  Hash::make($request->password),
                        'created_by' => Auth::id(),

                    ]);

                    $request->session()->flash('success', 'User Created Successfully');
                    return redirect('/users/list');
                } catch (Exception $ex) {
                    $notification = array(
                        'error' => $ex->getMessage(),
                        // 'error' => $ex
                    );
                    return back()->with($notification);
                }
            }
        }
    }

    public function edit($id)
    {
        $where = array('id' => $id);
        $users  = User::where($where)->first();

        return view('usermanagement.edituser', compact('users'));
    }

    public function update(Request $request)
    {

        if ($request->hasfile('profilepicture')) {
            $allowedextention = ['jpeg', 'png', 'jpg'];
            $extention = $request->profilepicture->getClientOriginalExtension();
            $check =  in_array($extention, $allowedextention);
            if ($check) {
                if ($request->file('profilepicture')) {
                    $fileName = time() . '_' . $request->profilepicture->getClientOriginalName();
                    $filePath = $request->file('profilepicture')->store('public/profilepicture');
                    // dd($filePath);
                    // $filePath = resize(300, 300);
                }
            }

            try {
                if ($request->password) {
                    User::where('id', $request->id)->update([
                        'name' => $request->name,
                        'email' => $request->email,
                        'role' => $request->role,
                        'password' => Hash::make($request->password),
                        'profilepicture' => $filePath
                    ]);
                } else {
                    User::where('id', $request->id)->update([
                        'name' => $request->name,
                        'email' => $request->email,
                        'role' => $request->role,
                        'profilepicture' => $filePath
                    ]);
                }
                $request->session()->flash('success', 'User Updated Successfully');
                return redirect('/users/list');
            } catch (Exception $ex) {
                $notification = array(
                    //'error' => $ex->getMessage(),
                    'error' => "No Lead Data Found."
                );
                return back()->with($notification);
            }
        } else {
            try {
                if ($request->password) {
                    User::where('id', $request->id)->update([
                        'name' => $request->name,
                        'email' => $request->email,
                        'role' => $request->role,
                        'password' => Hash::make($request->password),
                    ]);
                } else {
                    User::where('id', $request->id)->update([
                        'name' => $request->name,
                        'email' => $request->email,
                        'role' => $request->role,
                    ]);
                }
                $request->session()->flash('success', 'User Updated Successfully');
                return redirect('/users/list');
            } catch (Exception $ex) {
                $notification = array(
                    //'error' => $ex->getMessage(),
                    'error' => "No Lead Data Found."
                );
                return back()->with($notification);
            }
        }
    }
    public function delete(Request $request, $id)
    {
        User::where('id', $id)->delete();
        $request->session()->flash('error', 'Deleted Successfully');
        return redirect('/users/list');
    }
}
