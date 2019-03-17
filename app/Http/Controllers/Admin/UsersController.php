<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\Users\CreateRequest;
use App\Http\Requests\Admin\Users\UpdateRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\UseCases\Auth\RegisterService;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;

class UsersController extends Controller
{

    private $register;

    public function __construct(RegisterService $register)
    {
        $this->register = $register;
    }

    public function index()
    {
        $users = User::orderBy('id')->paginate(20);

        return view('admin.users.index', compact('users'));

    }


    public function create()
    {
        return view('admin.users.create');
    }


    public function store(CreateRequest $request)
    {

        $user = User::new(
            $request['name'],
            $request['email']
        );

        return redirect()->route('admin.users.show', $user);
    }


    public function show(User $user)
    {

        return view('admin.users.show', compact('user'));
    }


    public function edit(User $user)
    {
        $statuses = [
            User::STATUS_WAIT => 'Waiting',
            User::STATUS_ACTIVE => 'Active'
        ];

        return view('admin.users.edit', compact('user', 'statuses'));
    }

    public function update(UpdateRequest $request, User $user)
    {

        $user->update($request->only(['name', 'email']));

        return redirect()->route('admin.users.show', $user);
    }


    public function destroy(User $user)
    {
        $user->delete($user);

        return redirect()->route('admin.users.index');
    }

    public function verify(User $user)
    {
        $this->register->verify($user->id);

        return redirect()->route('admin.users.show', $user);
    }
}
