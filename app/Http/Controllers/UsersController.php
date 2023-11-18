<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    public $user;
    public function __construct(User $user){
        $this->user = $user;
    }


    public function index(){
        $currentUser = auth()->user();
        $users = User::where('id', '!=', $currentUser->id)->get();
        return view('pages.user.user-index', compact('users'));
    }

    public function create(Request $request){

       $request->validate([
    'name' => ['required', 'string', 'max:255'],
    'email' => ['required', 'string', 'email', 'max:255','unique:users'],
    'password' => ['required', 'confirmed'], // Aturan validasi untuk panjang minimal 8 karakter
]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'fullname'=>$request->fullname,
            'role'=>$request->role
        ]);
        return redirect()->back()->with('message','Akun Berhasil di buat');
    }
    public function deleteUser(User $user){
        $user->delete();
        return response()->json([ 'message' => 'Data success deleted !']);
    }
    public function getusers($id){
        $user=$this->user->find($id);
        return response()->json($user);
    }
    public function updatePassword(Request $request,$id){
        $user = $this->user->find($id);

    // Validate password if provided and ensure it meets your criteria
    if ($request->filled('password')) {
        $this->validate($request, [
            'password' => 'required|confirmed', // Add your password rules here
        ]);
        $user->password = Hash::make($request->password);
    }

    // Update other user details if needed
    $user->name = $request->input('name');
    $user->fullname = $request->input('fullname');
    $user->email = $request->input('email');
    $user->role = $request->input('role');

    $user->save();

    return redirect()->back()->with('message', 'Berhasil terupdate');
    }
}
