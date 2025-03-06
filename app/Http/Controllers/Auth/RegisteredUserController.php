<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $data = $request -> validate([
                    'name'=>'required',
                     'email'=>'required',
                    'password'=>'required|min:8',
                     'password_confirmation' => 'required_with:password|same:password|min:8',
                     'role'=>'required|string'
                 ]);
        // Log::info($request->all());
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role'=>$request->role

        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(route('dashboard', absolute: false));
    }

    public function show(){
        $users = User::all();
        return view('/show',compact('users'));


    }

    public function edit(User $user){
    
        return view('/table',compact('user'));
    }
    public function update(Request $request, User $user) {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'role' => 'required|in:user,author,admin',
        ]);
    
        $user->update($request->all());
    
        return redirect()->route('show.show')->with('success', 'User updated successfully!');
    }
    public function updates(Request $request, User $user) {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'role' => 'required|in:user,author,admin',
        ]);
    
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
        ]);
    
        return redirect()->route('show.show')->with('success', 'User updated successfully.');
    }
    public function destroy(User $user){
        $user->delete();
        return redirect(route('show.show'));
    }
    
    
}
