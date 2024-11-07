<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Mengambil semua data kategori dari database, diurutkan berdasarkan ID secara menurun
        // Category adalah model Eloquent yang mewakili tabel categories di database.
        // orderByDesc('id') mengurutkan hasil query berdasarkan kolom 'id' dalam urutan menurun.
        // ->get() mengeksekusi query dan mengambil semua hasil dalam bentuk koleksi Eloquent.      
        $categories = Category::orderByDesc('id')->get();

        // Mengarahkan pengguna ke tampilan 'admin.categories.index' dengan data kategori yang diambil.
        // compact('categories') membuat array asosiatif ['categories' => $categories]
        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRequest $request)
    {
        // Validasi input dari request
        //ini yang lama, yang baru dan lebih optimal misal validated digunakan banyak halaman
        // berada di StoreCategoryRequest.php dan sebelum $request diubah menjadi StoreCategoryRequest
        // $validated = $request->validate([
        //     'name' => ['required', 'string', 'max:255'],
        //     'icon' => ['required', 'image', 'mimes:png,jpg,jpeg'],
        // ]);

        // Memulai transaksi database
        DB::transaction(function () use ($request) {
            // Validasi input request menggunakan StoreCategoryRequest
            $validated = $request->validated();

            if ($request->hasFile('icon')) {
                $iconPath = $request->file('icon')->store('icons', 'public');
                //pakai bawah ini biar tidak private penyimpanannya
                $validated['icon'] = $iconPath; // Menambahkan path icon ke array validated
            } else {
                // Jika tidak ada file icon yang diupload, gunakan path default
                $iconPath = 'images/icon-default.png';
            }

            // Mengubah nama kategori menjadi slug (contoh: "Web Design" menjadi "web-design")
            $validated['slug'] = Str::slug($validated['name']);
            // Membuat record baru di tabel categories dengan data yang sudah divalidasi
            $category = Category::create($validated);
        });

        // Mengarahkan pengguna kembali ke halaman indeks kategori setelah menyimpan
        return redirect()->route('admin.categories.index');

    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        //compact digunakan agar bisa seperti ini contohnya value="{{ $category->name }}"
        return view('admin.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        //
        // Memulai transaksi database
        DB::transaction(function () use ($request, $category) {
            // Validasi input request menggunakan UpdateCategoryRequest
            $validated = $request->validated();

            if ($request->hasFile('icon')) {
                $iconPath = $request->file('icon')->store('icons', 'public');
                //pakai bawah ini biar tidak private penyimpanannya
                $validated['icon'] = $iconPath; // Menambahkan path icon ke array validated
            }

            // Mengubah nama kategori menjadi slug (contoh: "Web Design" menjadi "web-design")
            $validated['slug'] = Str::slug($validated['name']);
            // Update data
            $category->update($validated);
        });

        // Mengarahkan pengguna kembali ke halaman indeks kategori setelah menyimpan
        return redirect()->route('admin.categories.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        //
        DB::beginTransaction();

        try {
            $category->delete();
            DB::commit();

            // Mengarahkan pengguna kembali ke halaman indeks kategori setelah menyimpan
            return redirect()->route('admin.categories.index');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('admin.categories.index')->with('error', 'Terdapat Error');
        }
    }
}