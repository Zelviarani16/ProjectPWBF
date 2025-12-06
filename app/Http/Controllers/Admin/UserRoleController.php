<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Role;
use App\Models\RoleUser;
use Illuminate\Http\Request;

class UserRoleController extends Controller
{
    // Tampilkan manajemen role per user
    public function index()
    {
        $users = User::with(['roles' => function($q){
            $q->withPivot('status');
        }])->get();

        return view('admin.user-role.index', compact('users'));
    }

    // Form tambah role ke user
    public function create()
    {
        $users = User::all();
        $roles = Role::all();

        return view('admin.user-role.create', compact('users', 'roles'));
    }

    // Simpan role ke user
    public function store(Request $request)
    {
        $request->validate([
            'iduser' => 'required|exists:user,iduser',
            'idrole' => 'required|exists:role,idrole',
            'status' => 'required|in:0,1',
        ]);

        $user = User::findOrFail($request->iduser);

        // attach role dengan status
        $user->roles()->syncWithoutDetaching([
            $request->idrole => ['status' => $request->status]
        ]);

        return redirect()->route('admin.user-role.index')->with('success', 'Role berhasil ditambahkan ke user.');
    }

    // Form edit role user
    public function edit($iduser, $idrole)
    {
        $user = User::findOrFail($iduser);
        $role = $user->roles()->where('role.idrole', $idrole)->firstOrFail();

        return view('admin.user-role.edit', compact('user', 'role'));
    }

    // Update role user
    public function update(Request $request, $iduser, $idrole)
    {
        $request->validate([
            'status' => 'required|in:0,1',
        ]);

        $user = User::findOrFail($iduser);

        // update pivot table
        $user->roles()->updateExistingPivot($idrole, ['status' => $request->status]);

        return redirect()->route('admin.user-role.index')
            ->with('success', 'Status role berhasil diperbarui.');
    }


    // Hapus role dari user
    public function destroy($iduser, $idrole)
    {
        $user = User::findOrFail($iduser);
        $user->roles()->detach($idrole);

        return redirect()->route('admin.user-role.index')->with('success', 'Role berhasil dihapus dari user.');
    }

}
