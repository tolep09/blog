<?php

namespace App\Http\Controllers\dashboard;

use App\Models\Tag;
use App\Models\User;
use Illuminate\Http\Request;
use App\Events\UserRegistered;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserPost;
use App\Http\Requests\UpdateUserPut;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'rol.admin']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::with('rol')->orderBy('created_at', 'desc')->paginate(3);
        return view('dashboard.users.index')->with('users', $users);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.users.create')->with('user', new User());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserPost $sup)
    {
        $user = User::create([
            'name' => $sup['name'],
            'rol_id' => 2,
            'email' => $sup['email'],
            'password' => $sup['password'],
        ]);
        
        event(new UserRegistered($user));
        
        return back()->with('message', 'Usuario guardado con éxito');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $category
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view('dashboard.users.show')->with('user', $user);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $this->authorize('edit', $user);
        return view('dashboard.users.edit')->with('user', $user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $category
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserPut $uup, User $user)
    {
        $this->authorize('update', $user);
        $user->update([
            'name' => $uup['name'],
            'email' => $uup['email'],
        ]);

        return back()->with('message', 'Usuario ' . $user->id . ' actualizado con éxito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();
        return back()->with('message', 'Usuario ' . $user->id . ' eliminado con éxito');
    }
}
