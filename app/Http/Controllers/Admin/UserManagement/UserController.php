<?php

namespace App\Http\Controllers\Admin\UserManagement;

use App\Mail\UserInvited;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class UserController extends Controller
{
    private const PAGINATE_LIMIT = 10;

    public function index(Request $request): View
    {
        return view('admin.user_management.users.index', [
            'users' => User::with('roles')
                ->where('email', 'like', '%' . $request->input('search_users') . '%')
                ->paginate(self::PAGINATE_LIMIT),
        ]);
    }

    public function create(): View
    {
        $this->authorize(User::class);

        return view('admin.user_management.users.create', [
            'user' => [],
        ]);
    }

    public function store(Request $request): RedirectResponse
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

    public function edit(User $user): View
    {
        $this->authorize($user);

        return view('admin.user_management.users.edit', [
            'user' => $user
        ]);
    }

    public function update(Request $request, User $user): RedirectResponse
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

    public function destroy(User $user): RedirectResponse
    {
        $this->authorize($user);

        $user->delete();

        return redirect()->route('admin.user_management.user.index');
    }

    public function invite(): View
    {
        $this->authorize('send',User::class);

        return view('admin.user_management.users.invite', [
            'user' => [],
        ]);
    }

    public function send(Request $request): RedirectResponse
    {
        $this->authorize(User::class);

        $request->validate([
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')],
        ]);

        $email = $request->input('email');

        $this->sendMail($email);

        return redirect()->route('admin.user_management.user.index');
    }

    private function sendMail(string $email): void
    {
        Mail::to($email)
            ->send(new UserInvited());
    }
}
