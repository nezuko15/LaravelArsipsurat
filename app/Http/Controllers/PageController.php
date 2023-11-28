<?php

namespace App\Http\Controllers;

use App\Models\Arsip;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PageController extends Controller
{
    /**
     * Display all the static pages when authenticated
     *
     * @param string $page
     * @return \Illuminate\View\View
     */
    public function index(string $page)
    {
        if (view()->exists("pages.{$page}.{$page}")) {
            return view("pages.{$page}.{$page}");
        }

        return abort(404);
    }

    public function about()
    {
        return view("pages.about");
    }

    public function kategori()
    {
        $kategori = Kategori::get();

        return view('pages.kategori.index', ['data' => $kategori]);
    }

    public function kategoriTambah()
    {
        $nextId = Kategori::getNextId();
        return view('pages.kategori.tambah', compact('nextId'));
    }

    public function kategoriSimpan(Request $request)
    {
        $request->validate([
            'nama_kategori' => 'required',
            'keterangan' => 'required',
        ]);

        $data = [
            'nama_kategori' => $request->nama_kategori,
            'keterangan' => $request->keterangan,
        ];

        Kategori::create($data);

        return redirect()->route('kategori')->with('success', 'Data berhasil ditambahkan');
    }

    public function kategoriEdit($id)
    {
        $kategori = Kategori::find($id);

        return view('pages.kategori.edit', ['kategori' => $kategori]);
    }

    public function kategoriUpdate($id, Request $request)
    {
        $data = [
            'nama_kategori' => $request->nama_kategori,
            'keterangan' => $request->keterangan,
        ];

        Kategori::find($id)->update($data);

        return redirect()->route('kategori')->with('success', 'Data berhasil diupdate');
    }

    public function kategoriHapus($id)
    {
        Kategori::find($id)->delete();

        return redirect()->route('kategori')->with('success', 'Data berhasil dihapus');
    }

    public function arsip()
    {
        $arsip = Arsip::get();

        return view('pages.arsip.index', ['data' => $arsip]);
    }

    public function arsipTambah()
    {
        $kategoriList = Kategori::all();
        return view('pages.arsip.tambah', compact('kategoriList'));
    }

    public function arsipSimpan(Request $request)
    {
        // Validasi data yang masuk (nomor_surat, kategori_id, judul, file_surat)
        $request->validate([
            'nomor_surat' => 'required',
            'kategori_id' => 'required|exists:kategori,id',
            'judul' => 'required|string|max:255',
            'file_surat' => 'required|mimes:pdf|max:2048', // maksimal ukuran file 2MB
        ]);

        // Mengelola file surat yang diunggah
        $file_surat = $request->file('file_surat');
        $nama_file_surat = 'Surat' . date('Ymdhis') . '.' . $file_surat->getClientOriginalExtension();
        $file_surat->storeAs('file_surat', $nama_file_surat, 'public');

        // Membuat instansiasi model Arsip dan menyimpan data ke dalam database
        $arsip = new Arsip([
            'nomor_surat' => $request->nomor_surat,
            'judul' => $request->judul,
            'file_surat' => $nama_file_surat,
        ]);

        $arsip->kategori()->associate(Kategori::find($request->kategori_id));
        $arsip->save();

        // Redirect atau berikan respon sukses
        return redirect()->route('arsip')->with('success', 'Data berhasil ditambahkan');
    }

    public function arsipLihat($id)
    {
        $surat = Arsip::findOrFail($id);
        return view('pages.arsip.lihat', compact('surat'));
    }

    public function arsipEdit($id)
    {
        // Cari data arsip berdasarkan ID
        $arsip = Arsip::find($id);

        if (!$arsip) {
            return redirect()->route('arsip.index')->with('error', 'Data tidak ditemukan');
        }

        $kategoriList = Kategori::all();

        return view('pages.arsip.edit', compact('arsip', 'kategoriList'));
    }

    public function arsipUpdate(Request $request, $id)
    {
        // Validasi data yang masuk
        $request->validate([
            'nomor_surat' => 'required',
            'kategori_id' => 'required',
            'judul' => 'required|string|max:255',
            'file_surat' => 'nullable|mimes:pdf|max:2048',
        ]);

        // Cari data arsip berdasarkan ID
        $arsip = Arsip::find($id);

        if (!$arsip) {
            return redirect()->route('arsip')->with('error', 'Data tidak ditemukan');
        }

        // Inisialisasi variabel $fileSuratPath
        $fileSuratPath = $arsip->file_surat;

        // Jika ada file surat yang diunggah
        if ($request->hasFile('file_surat')) {
            // Hapus file surat lama jika ada
            if ($arsip->file_surat) {
                // Hapus file dari penyimpanan
                Storage::delete('public/file_surat/' . $arsip->file_surat);
            }

            // Upload file surat baru
            $fileSuratPath = 'Surat' . date('Ymdhis') . '.' . $request->file('file_surat')->getClientOriginalExtension();
            $request->file('file_surat')->storeAs('public/file_surat', $fileSuratPath);
        }

        // Update data ke database
        $arsip->update([
            'nomor_surat' => $request->nomor_surat,
            'kategori_id' => $request->kategori_id,
            'judul' => $request->judul,
            'file_surat' => $fileSuratPath, // Gunakan path file surat baru atau yang lama
        ]);

        // Redirect atau berikan respon sukses
        return redirect()->route('arsip')->with('success', 'Data berhasil diperbarui');
    }

    public function arsipHapus($id)
    {
        // Cari data arsip berdasarkan ID
        $arsip = Arsip::find($id);

        if (!$arsip) {
            return redirect()->route('arsip')->with('error', 'Data tidak ditemukan');
        }

        // Hapus file surat dari penyimpanan jika ada
        if ($arsip->file_surat) {
            // Hapus file dari penyimpanan
            Storage::delete('public/file_surat/' . $arsip->file_surat);
        }

        // Hapus data arsip dari database
        $arsip->delete();

        // Redirect atau berikan respon sukses
        return redirect()->route('arsip')->with('success', 'Data berhasil dihapus');
    }
}
