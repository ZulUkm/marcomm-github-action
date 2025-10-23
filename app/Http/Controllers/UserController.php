<?php

namespace App\Http\Controllers;

use App\Services\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $users = $this->userService->getAllUsers();
        $status = $request->input('status-cat');
        return view('user.index', compact('users'));
    }

    public function edit(string $id)
    {
        $user = $this->userService->getUserById($id);
        $roles = $this->userService->getAllRoles();

        return view('user.edit', compact('user', 'roles'));
    }

    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'name'          => 'required|string|max:255',
            'email'         => 'required|email|max:255|unique:users,email,' . $id,
            'telephone'     => 'nullable|string|max:20',
            'user_type'     => 'nullable|string|max:255',
            'is_active'     => 'required|in:1,0',
            'roles'         => 'array',
            'roles.*'       => 'string|exists:roles,name',
            'staff_picture' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'remove_staff_picture' => 'nullable|boolean',
        ]);

        $user = $this->userService->getUserById($id);

        if ($request->has('remove_staff_picture') && $request->remove_staff_picture == 1) {
            if ($user->staff_picture && file_exists(public_path($user->staff_picture))) {
                unlink(public_path($user->staff_picture)); 
            }
            $validatedData['staff_picture'] = null; 
        }

        if ($request->hasFile('staff_picture')) {
            $path = $request->file('staff_picture')->store('profile_pictures', 'public');
            $validatedData['staff_picture'] = '/storage/' . $path;
        }

        unset($validatedData['ukmper']);

        $this->userService->updateUser($id, $validatedData);

        $this->userService->updateUserRoles($id, $request->input('roles', []));

        return redirect()->route('users.index', $id)
            ->with('success', 'User profile updated successfully.');
    }


    public function destroy(string $id)
    {
        $this->userService->deleteUser($id);
        return redirect()->route('users.index')->with('success', 'User deleted successfully.');
    }
}
