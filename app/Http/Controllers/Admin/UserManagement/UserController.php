<?php

namespace App\Http\Controllers\Admin\UserManagement;

use App\Mail\UserInvited;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return view('admin.user_management.users.index', [
            'users' => User::with('roles')
                ->where('email', 'like', '%' . $request->input('search_users') . '%')
                ->paginate(10),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize(User::class);

        return view('admin.user_management.users.create', [
            'user' => [],
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize(User::class);

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => bcrypt($request['password']),
        ]);

        return redirect()->route('admin.user_management.user.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $this->authorize($user);

        return view('admin.user_management.users.edit', [
            'user' => $user
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $this->authorize($user);

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $user->name = $request['name'];
        $user->email = $request['email'];
        $request['password'] === null ?: $user->password = bcrypt($request['password']);
        $user->save();

        return redirect()->route('admin.user_management.user.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $this->authorize($user);

        $user->delete();

        return redirect()->route('admin.user_management.user.index');
    }

    /**
     * Show the form for inviting a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function invite()
    {
        $this->authorize('send',User::class);

        return view('admin.user_management.users.invite', [
            'user' => [],
        ]);
    }

    /**
     * Send inventation to new user
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function send(Request $request)
    {
        $this->authorize(User::class);

        $request->validate([
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')],
        ]);

        $email = $request->input('email');

        $this->sendMail($email);

        return redirect()->route('admin.user_management.user.index');
    }

    /**
     * @param string $email
     */
    private function sendMail(string $email)
    {
        Mail::to($email)
            ->send(new UserInvited());
    }
}
