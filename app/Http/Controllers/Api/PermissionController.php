<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Permission;
use Illuminate\Support\Facades\Storage;

class PermissionController extends Controller
{
    //create
    public function store(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', // 'nullable' ditambahkan untuk opsional
            'date' => 'required|date', // 'date' ditambahkan untuk memastikan format valid
            'reason' => 'required|string|max:255', // Tambahkan validasi panjang teks
        ]);

        // Inisialisasi Permission
        $permission = new Permission([
            'user_id' => $request->user()->id,
            'date_permission' => $validated['date'],
            'reason' => $validated['reason'],
            'is_approved' => 0,
        ]);

        // Simpan file gambar jika ada
        if ($request->hasFile('image')) {
            // $imageName = $request->file('image')->storeAs(
            //     'public/permissions',
            //     $request->file('image')->hashName()
            // );
            try {
                $path = $request->file('image')->store('permissions', 'public');
                // logger("File berhasil disimpan di: $path");
            } catch (\Exception $e) {
                logger("Gagal menyimpan file: " . $e->getMessage());
            }
            $permission->image = $path;
        }

        // Simpan permission ke database
        $permission->save();

        // Return response JSON
        return response()->json(['message' => 'Permission created successfully'], 201);
    }
}
