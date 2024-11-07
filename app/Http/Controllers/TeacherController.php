<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTeacherRequest;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Mengambil semua data teacher dari database, diurutkan berdasarkan ID secara menurun
        // Category adalah model Eloquent yang mewakili tabel categories di database.
        // orderByDesc('id') mengurutkan hasil query berdasarkan kolom 'id' dalam urutan menurun.
        // ->get() mengeksekusi query dan mengambil semua hasil dalam bentuk koleksi Eloquent.      
        $teachers = Teacher::orderByDesc('id')->get();

        // Mengarahkan pengguna ke tampilan 'admin.categories.index' dengan data kategori yang diambil.
        // compact('categories') membuat array asosiatif ['categories' => $categories]
        return view('admin.teachers.index', compact('teachers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('admin.teachers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTeacherRequest $request)
    {
        //Menggunakan StoreTeacherRequest untuk memvalidasi data yang dikirim melalui permintaan. Data yang valid akan disimpan dalam variabel $validated
        $validated = $request->validated();
        //Mencari pengguna di tabel users berdasarkan email yang telah divalidasi
        $user = User::where('email', $validated['email'])->first();

        //Jika pengguna tidak ditemukan, kembalikan ke halaman sebelumnya dengan pesan kesalahan
        if (!$user) {
            return back()->withErrors([
                'email' => 'Data Not Found'
            ]);
        }

        //Jika pengguna sudah memiliki peran 'teacher', kembalikan ke halaman sebelumnya dengan pesan kesalahan
        if ($user->hasRole('teacher')) {
            return back()->withErrors([
                'email' => 'Email has been Teacher'
            ]);
        }

        DB::transaction(function () use ($user, $validated) {
            // Menambahkan user_id ke data yang telah divalidasi
            $validated['user_id'] = $user->id;
            // Menandai guru sebagai aktif
            $validated['is_active'] = true;
            // Membuat entri baru dalam tabel 'teachers' dengan data yang telah divalidasi
            Teacher::create($validated);

            if ($user->hasRole('student')) {
                $user->removeRole('student');
            }

            $user->assignRole('teacher');
        });
        return redirect()->route('admin.teachers.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Teacher $teacher)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Teacher $teacher)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Teacher $teacher)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Teacher $teacher)
    {
        //
        try {
            // Menghapus entri teacher dari database
            $teacher->delete();

            // Mencari pengguna yang terkait dengan teacher yang dihapus
            $user = User::find($teacher->user_id);
            $user->removeRole('teacher');
            $user->assignRole('student');

            // Mengarahkan kembali ke halaman sebelumnya setelah operasi berhasil
            return redirect()->back();
        } catch (\Exception $e) {
            // Jika terjadi exception, batalkan transaksi database
            DB::rollBack();
            // Membuat pesan kesalahan dengan informasi exception
            $error = ValidationException::withMessages([
                'system_error' => ['System error!' . $e->getMessage()],
            ]);
            throw $error;
        }
    }
}