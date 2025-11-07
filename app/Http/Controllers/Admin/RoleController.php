<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::all(); // Bentuknya array
        return view('admin.role.index', compact('roles'));
    }

    public function create()
    {
        return view('admin.role.create');
    }

    public function store(Request $request)
    {
        $validated = $this->validateRole($request);

        // Simpan data baru
        Role::create([
            'nama_role' => $this->formatNamaRole($validated['nama_role']),
        ]);

        return redirect()->route('admin.role.index')->with('success', 'Role berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $role = Role::findOrFail($id);
        return view('admin.role.edit', compact('role'));
    }

    public function update(Request $request, $id)
    {
        // Validasi
        $validated = $this->validateRole($request);

        // Temukan data
        $role = Role::findOrFail($id);

        $role->update([
            'nama_role' => $this->formatNamaRole($validated['nama_role']),
        ]);

        return redirect()->route('admin.role.index')->with('success', 'Role berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $role = Role::findOrFail($id);
        $role->delete();

        return redirect()->route('admin.role.index')->with('success', 'Role berhasil dihapus.');
    }

    // VALIDATION & HELPER

    private function validateRole(Request $request)
    {
        return $request->validate([
            'nama_role' => 'required|string|max:100|unique:role,nama_role,' . ($request->idrole ?? '') . ',idrole',
        ]);
    }

    private function formatNamaRole($nama)
    {
        return ucwords(strtolower(trim($nama)));
    }
}
