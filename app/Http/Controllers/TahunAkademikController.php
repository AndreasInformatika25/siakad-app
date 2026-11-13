<?php

namespace App\Http\Controllers;

use App\Models\TahunAkademik;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class TahunAkademikController extends Controller
{
    /**
     * Menampilkan daftar tahun akademik.
     */
    public function index()
    {
        // Ambil semua data, kita serahin urusan sorting/search ke DataTables di view
        $tahunAkademik = TahunAkademik::all();
        return view('tahun-akademik.index', compact('tahunAkademik'));
    }

    /**
     * Menampilkan form tambah data.
     */
    public function create()
    {
        return view('tahun-akademik.create');
    }

    /**
     * Menyimpan data baru ke database.
     */
    public function store(Request $request)
    {
        $request->validate([
            'tahun' => [
                'required',
                'string',
                'max:9',
                // Validasi kombinasi tahun & semester harus unik di tabel tahun_akademik
                Rule::unique('tahun_akademik')->where(function ($query) use ($request) {
                    return $query->where('semester', $request->semester);
                })
            ],
            'semester' => 'required|in:Ganjil,Genap',
            'tanggal_mulai' => 'required|date',
            // Validasi tanggal selesai wajib setelah tanggal mulai
            'tanggal_selesai' => 'required|date|after:tanggal_mulai',
            'status' => 'nullable'
        ], [
            'tahun.unique' => 'Kombinasi Tahun Akademik dan Semester ini sudah ada!',
            'tanggal_selesai.after' => 'Tanggal selesai harus lebih besar dari tanggal mulai.'
        ]);

        // Tangkap value checkbox status (kalau diceklis nilainya 1, kalau nggak 0)
        $isAktif = $request->has('status') ? 1 : 0;

        // Aturan Bisnis: Hanya boleh ada satu tahun akademik berstatus aktif.
        if ($isAktif == 1) {
            // "Lengserkan" tahun akademik lain yang lagi aktif
            TahunAkademik::where('status', 1)->update(['status' => 0]);
        }

        TahunAkademik::create([
            'tahun' => $request->tahun,
            'semester' => $request->semester,
            'tanggal_mulai' => $request->tanggal_mulai,
            'tanggal_selesai' => $request->tanggal_selesai,
            'status' => $isAktif,
        ]);

        return redirect()->route('tahun-akademik.index')
            ->with('success', 'Tahun Akademik berhasil ditambahkan!');
    }

    /**
     * Menampilkan form edit data.
     */
    public function edit(TahunAkademik $tahunAkademik)
    {
        // Pakai route model binding (inject class model langsung) biar nggak usah findOrFail manual
        return view('tahun-akademik.edit', compact('tahunAkademik'));
    }

    /**
     * Mengupdate data ke database.
     */
    public function update(Request $request, TahunAkademik $tahunAkademik)
    {
        $request->validate([
            'tahun' => [
                'required',
                'string',
                'max:9',
                // Validasi unik kombinasi, tapi abaikan record yang lagi diedit ini
                Rule::unique('tahun_akademik')->where(function ($query) use ($request) {
                    return $query->where('semester', $request->semester);
                })->ignore($tahunAkademik->id)
            ],
            'semester' => 'required|in:Ganjil,Genap',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after:tanggal_mulai',
            'status' => 'nullable'
        ], [
            'tahun.unique' => 'Kombinasi Tahun Akademik dan Semester ini sudah ada!',
            'tanggal_selesai.after' => 'Tanggal selesai harus lebih besar dari tanggal mulai.'
        ]);

        $isAktif = $request->has('status') ? 1 : 0;

        // Kalau di-set jadi aktif, nonaktifkan yang lain
        if ($isAktif == 1) {
            TahunAkademik::where('id', '!=', $tahunAkademik->id)
                         ->where('status', 1)
                         ->update(['status' => 0]);
        }

        $tahunAkademik->update([
            'tahun' => $request->tahun,
            'semester' => $request->semester,
            'tanggal_mulai' => $request->tanggal_mulai,
            'tanggal_selesai' => $request->tanggal_selesai,
            'status' => $isAktif,
        ]);

        return redirect()->route('tahun-akademik.index')
            ->with('success', 'Tahun Akademik berhasil diubah!');
    }

    /**
     * Menghapus data dari database.
     */
    public function destroy(TahunAkademik $tahunAkademik)
    {
        $tahunAkademik->delete();

        return redirect()->route('tahun-akademik.index')
            ->with('success', 'Tahun Akademik berhasil dihapus!');
    }
}