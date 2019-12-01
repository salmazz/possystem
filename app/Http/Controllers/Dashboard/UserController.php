<?php

namespace App\Http\Controllers\Dashboard;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Intervention\Image\Facades\Image;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware(['permission:read_users'])->only('index');
        $this->middleware(['permission:create_users'])->only('create');
        $this->middleware(['permission:update_users'])->only('edit');
        $this->middleware(['permission:delete_users'])->only('delete');
    } //end of construct
    public function index(Request $request)
    {
        //
        // if($request->search){
        //      dd($request->all());
        // }

        $users = User::whereRoleIs('admin')->where(function ($q) use ($request) {

            return $q->when($request->search, function ($query) use ($request) {

                return $query->where('first_name', 'like', '%' . $request->search . '%')
                    ->orWhere('last_name', 'like', '%' . $request->search . '%');

            });

        })->latest()->paginate(5);
       
        return view('dashboard.users.index', compact('users'));
    } // end of index

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $users = User::all();

        return view('dashboard.users.create', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|unique:users',
            'password' => 'required|confirmed',
            'image'=> 'image',
            'premissions' => 'required|min:1'

        ]);

        $request_data = $request->except(['password', 'password_confirmation', 'permissions', 'image']);
        $request_data['password'] = bcrypt($request->password);
        if ($request->image) {
            Image::make($request->image)->resize(300, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save(public_path('uploads/user_images/' . $request->image->hashName()));
            $request_data['image'] = $request->image->hashName();
        }
        // dd($request_date);
        $user = User::create($request_data);
        $user->attachRole('admin');
        $user->syncPermissions($request->permissions);

        session()->flash('success', 'site.added_successfully');

        return redirect()->route('dashboard.users.index');
    } //end of store



    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
        return view('dashboard.users.edit', compact('user'));
    } // end of user

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => ['required',Rule::unique('users')->ignore($user->id),],
        ]);


        $request_data = $request->except(['permissions', 'image']);
        if ($request->image) {


            if ($user->image != 'default.png') {
                Storage::disk('public_uploads')->delete('/user_images/' . $user->image);
            }
            Image::make($request->image)->resize(300, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save(public_path('uploads/user_images/' . $request->image->hashName()));
            $request_data['image'] = $request->image->hashName();
        }
        $user->update($request_data);
        $user->syncPermissions($request->permissions);

        session()->flash('success', 'site.updated_successfully');

        return redirect()->route('dashboard.users.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //

        if ($user->image != 'default.png') {

            Storage::disk('public_uploads')->delete('/user_images/' . $user->image);
        } //end of if

        $user->delete();
        session()->flash('success', 'site.deleted_successfully');

        return redirect()->route('dashboard.users.index');
    }
}
