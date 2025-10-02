<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::latest()->paginate(5);
        return view("admin.users.index", ["users" => $users]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view("admin.users.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            "name"      => ["required", "min:5", "unique:users,name"],
            "email"     => ["required", "unique:users,email", "email"],
            "role"      => ["required", Rule::in(["author", "admin", "user"])],
            "password"  => ["required", "min:8", "confirmed", 'string'],
            "photo"     => ["nullable", "file", "image", "max:2048"] // 2MB max
        ]);

        $userData = [
            "name"      => $validatedData['name'],
            "email"     => $validatedData['email'],
            "role"      => $validatedData['role'],
            "password"  => Hash::make($validatedData['password']),
        ];

        if ($request->hasFile("photo")) {
            $userData['photo'] = $request->file("photo")->store("users");
        }

        User::create($userData);

        return redirect()
            ->route("admin.users.create")
            ->with("success", "Successfully created new user!");
    }

    /**
     * Display the specified resource.
     */
    public function show(int $user)
    {
        //
        $user = User::find($user);
        if (is_null($user)) {
            return to_route("admin.users.index")->with("alert", "User Not Exists");
        }

        return view("admin.users.show", ["user" => $user]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $user)
    {
        //
        $user = User::find($user);
        if (is_null($user)) {
            return to_route("admin.users.index")->with("alert", "User Not Exists");
        }
        return view("admin.users.edit", ["user" => $user]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        // Use route model binding instead of manual find
        $validatedData = $request->validate([
            "name"  => ["required", "min:5", Rule::unique("users", 'name')->ignore($user)],
            "email" => ["required", "email", Rule::unique("users", "email")->ignore($user)],
            "role"  => ["required", Rule::in(["user", "admin", "author"])],
            "photo" => ["nullable", "file", "image", "max:2048"] // 2MB max, nullable
        ]);

        $updateData = [
            "name"  => $validatedData['name'],
            "email" => $validatedData['email'],
            "role"  => $validatedData['role'],
        ];

        // Handle photo upload
        if ($request->hasFile("photo")) {
            // Delete old photo if exists
            if ($user->photo && Storage::exists($user->photo)) {
                Storage::delete($user->photo);
            }
            $updateData['photo'] = $request->file("photo")->store("users");
        }

        $user->update($updateData);

        return redirect()
            ->route("admin.users.edit", $user)
            ->with("success", "User updated successfully");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $user)
    {
        //
        $user = User::find($user);
        if (is_null($user)) {
            return to_route("admin.users.index")->with("alert", "User Not Exists");
        }
        if (!empty($user->photo) && Storage::exists($user->photo)) {
            Storage::delete($user->photo);
        }
        $user->delete();
        return to_route("admin.users.index")->with("success", "Successfully Delete User!");
    }

    public function search(Request $request)
    {
        $search = htmlspecialchars($request->input("search"));
        $users = User::where("name", "LIKE", "%{$search}%")->get();
        if ($users->isEmpty()) {
            return to_route("admin.users.index")->with("alert", "Not Found Any Users Like $search");
        }
        return view("admin.users.search", ["users" => $users])->with("alert", " Found Any Users Like $search");
    }
}
