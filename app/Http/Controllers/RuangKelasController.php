<?php

namespace App\Http\Controllers;

use App\Models\RuangKelas;
use Illuminate\Http\Request;

class RuangKelasController extends Controller
{
    public function index()
    {
        $ruangKelas = RuangKelas::all();
        return view('ruang-kelas.index', compact('ruangKelas'));
    }

    public function create()
    {
        return view('ruang-kelas.create');
    }

    public function store(Request $request)
    {
        // Validasi sesuai spesifikasi tugas P6
        $request->validate([
            'kode_ruang' => 'required|string|max:20|unique:ruang_kelas,kode_ruang',
            'nama_ruang' => 'required|string|max:100',
            'gedung' => 'required|string|max:100',
            'kapasitas' => 'required|integer|min:1', // Minimal 1
            'jenis_ruang' => 'required|in:Teori,Laboratorium,Seminar',
            'status' => 'nullable'
        ], [
            'kode_ruang.unique' => 'Kode ruang ini sudah terdaftar!',
            'kapasitas.min' => 'Kapasitas ruangan minimal 1 orang.'
        ]);

        $isTersedia = $request->has('status') ? 1 : 0;

        RuangKelas::create(array_merge(
            $request->except('status'), 
            ['status' => $isTersedia]
        ));

        return redirect()->route('ruang-kelas.index')
            ->with('success', 'Data Ruang Kelas berhasil ditambahkan!');
    }

    public function edit(RuangKelas $ruangKela)
    {
        // Catatan: Laravel kadang memotong huruf 's' di ujung nama parameter binding,
        // makanya variabelnya otomatis jadi $ruangKela. Kita pakai itu aja biar aman.
        return view('ruang-kelas.edit', compact('ruangKela'));
    }

    public function update(Request $request, RuangKelas $ruangKela)
    {
        $request->validate([
            // Pengecualian unique validation untuk ID yang sedang diedit
            'kode_ruang' => 'required|string|max:20|unique:ruang_kelas,kode_ruang,' . $ruangKela->id,
            'nama_ruang' => 'required|string|max:100',
            'gedung' => 'required|string|max:100',
            'kapasitas' => 'required|integer|min:1',
            'jenis_ruang' => 'required|in:Teori,Laboratorium,Seminar',
            'status' => 'nullable'
        ], [
            'kode_ruang.unique' => 'Kode ruang ini sudah terdaftar!',
            'kapasitas.min' => 'Kapasitas ruangan minimal 1 orang.'
        ]);

        $isTersedia = $request->has('status') ? 1 : 0;

        $ruangKela->update(array_merge(
            $request->except('status'),
            ['status' => $isTersedia]
        ));

        return redirect()->route('ruang-kelas.index')
            ->with('success', 'Data Ruang Kelas berhasil diubah!');
    }

    public function destroy(RuangKelas $ruangKela)
    {
        $ruangKela->delete();
        return redirect()->route('ruang-kelas.index')
            ->with('success', 'Data Ruang Kelas berhasil dihapus!');
    }
}