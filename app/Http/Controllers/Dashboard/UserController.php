<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Image;
use Storage;

class UserController extends Controller
{
    public function __construct()
    {
        // create read update delete
        $this->middleware(['permission:read_users'])->only('index');
        $this->middleware(['permission:create_users'])->only('create');
        $this->middleware(['permission:update_users'])->only('edit');
        $this->middleware(['permission:delete_users'])->only('destroy');
    } // end auth middleware __construct
    public function index(Request $request)
    {
        $users = User::whereRoleIs('admin')->where(function ($r) use ($request) {

            return $r->when($request->search, function ($re) use ($request) {
                return $re->where('first_name', 'like', '%' . $request->search . '%')
                    ->orWhere('last_name', 'like', '%' . $request->search . '%');
            });
        })->latest()->paginate(5);

        return view('dashboard.users.index',compact('users'));

    } // end of index

    public function create()
    {
        return view('dashboard.users.create');
    } // end of create

    public function store(Request $request)
    {
        $request->validate([
            'first_name'=>'required',
            'last_name'=>'required',
            'email'=>'required|email|unique:users',
            'image'=>'image',
            'password'=>'required|confirmed',
            'permissions' => 'required|min:1'
        ]);

        $request_data = $request->except(['password','password_confirmation', 'permissions','image']);
        $request_data['password'] = bcrypt($request->password);

        if ($request->image) {

            Image::make($request->image)->resize(300, null, function ($constraint){
                $constraint->aspectRatio();
            })
                ->save(public_path('uploads/users_images/' . $request->image->hashName()));

            $request_data['image'] = $request->image->hashName();
        } // end of if


        $user = User::create($request_data);
        $user->attachRole('admin');
        $user->syncPermissions($request->permissions);

        session()->flash('success',__('site.added_successfully'));
        return redirect()->route('dashboard.users.index');
    } // end of store

    public function edit(User $user)
    {
        return view('dashboard.users.edit',compact('user'));
    } // end of edit

    public function update(Request $request, User $user)
    {
        $request->validate([
            'first_name'=>'required',
            'last_name'=>'required',
            'email'=> ['required', Rule::unique('users')->ignore($user->id),],
            'image'=>'image',
            'permissions' => 'required|min:1',
        ]);

        $request_data = $request->except(['permissions','image']);

        if ($request->image) {

            if ($user->image != 'default.png') {

                Storage::disk('public_uploads')->delete('/users_images/' . $user->image);
            } // end inner if
                Image::make($request->image)->resize(300, null, function ($constraint){
                    $constraint->aspectRatio();
                })
                    ->save(public_path('uploads/users_images/' . $request->image->hashName()));

                $request_data['image'] = $request->image->hashName();

        } // end if

        $user->update($request_data);

        $user->syncPermissions($request->permissions);

        session()->flash('success',__('site.updated_successfully'));
        return redirect()->route('dashboard.users.index');
    } //  end of update

    public function destroy(User $user)
    {
        if ($user->image != 'default.png') {

            Storage::disk('public_uploads')->delete('/users_images/' . $user->image);
        } // end if

        $user->delete();
        session()->flash('success',__('site.deleted_successfully'));
        return redirect()->route('dashboard.user.index');
    } // end of destroy

} // END OF USER CONTROLLER
