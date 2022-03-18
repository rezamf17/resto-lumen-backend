<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Image;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Get the authenticated User.
     *
     * @return Response
     */
    public function profile()
    {
        return response()->json(['user' => Auth::user()->load('image')], 200);
    }

    /**
     * Get all User.
     *
     * @return Response
     */
    public function allUsers()
    {
        return response()->json(['users' =>  User::all()], 200);
    }

    /**
     * Get one user.
     *
     * @return Response
     */
    public function singleUser($id)
    {
        try {
            $user = User::findOrFail($id);

            return response()->json(['user' => $user], 200);
        } catch (\Exception $e) {

            return response()->json(['message' => 'user not found!'], 404);
        }
    }

    public function editProfile(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|string',
            'email' => 'required|email',
            // 'image' => 'image|max:1024'
        ]);
            try {
                $user = User::find($id);
                $user->name = $request->name;
                $user->email = $request->email;
                // $user->level = $request->level;
                // dd($user);
                $user->save();
                return response()->json(['user' => $user, 'message' => 'UPDATED'], 201);
            } catch (\Exception $e) {
                // dd($user);
                return response()->json(['message' => 'User Registration Failed!'], 409);
            }
    }

    public function changeImage(Request $request)
    {
        $fileUpload = new Image;
        $fileName = Auth::user()->name;

        try {
            if ($request->file('image_name')){
                $image = $request->file('image_name');
                $namaimage = $fileName.'avatar'.$image->getClientOriginalName();
                $image->move('avatar', $namaimage);
                $fileUpload->image_name = $namaimage;
            }
            $fileUpload->save();
            $user = User::find(Auth::id());
            $user->id_image = $fileUpload->id;
            $user->save();
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function addUser(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed',
            'password_confirmation' => 'required'
        ]);
        try {
            $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->level = $request->level;
        $user->id_image = "1";
        $user->password = $request->password;
        $user->save();
        
        return response()->json([
            'message' => 'Success Add New Account',
            'data_user' => $user 
        ]);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function editUser(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|string',
            'email' => 'required|email',
        ]);
        try {

            if ($request->password == null) {
                $user = User::find($id);
                $user->name = $request->name;
                $user->email = $request->email;
                $user->level = $request->level;
                $user->id_image = $user->id_image;
                $user->save();
            }else{
                $user = User::find($id);
                $user->name = $request->name;
                $user->email = $request->email;
                $user->level = $request->level;
                $user->id_image = $user->id_image;
                $user->password = Hash::make($request->password);
                $user->save();
            }
        
        return response()->json([
            'message' => 'Success Update New Account',
            'data_user' => $user 
        ]);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function deleteUser($id)
        {
            try {
                $user = User::find($id);
                $user->delete();
                return response()->json([
                    'message' => 'Deleted has been Succeed!',
                    'data_user' => $user
                ], 200);
            } catch (\Throwable $th) {
                throw $th;
            }
        }
}
