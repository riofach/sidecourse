<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCourseRequest;
use App\Http\Requests\UpdateCourseRequest;
use App\Models\Category;
use App\Models\Course;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //mendapatkan seluruh data dan menampilkan
        //diakses oleh teacher dan owner, jika teacher hanya ditampilkan yang dia tambahkan

        //variable apakah saat ini teacher or owner
        $user = Auth::user();
        //query ini bisa digunakan teacher dan owner
        $query = Course::with('category', 'teacher', 'students')->orderByDesc('id');

        //jika yang login teacher maka $query digunakan yang dibawah ini / filter
        if ($user->hasRole('teacher')) {
            $query->whereHas('teacher', function ($query) use ($user) {
                //dimana user_id pada tabel $user = user id
                $query->where('user_id', $user->id);
            });
        }

        $courses = $query->paginate(10);

        return view('admin.courses.index', compact('courses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //melemparkan data categories
        $categories = Category::all();
        return view('admin.courses.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCourseRequest $request)
    {
        //
        //cek dahulu data teacher siapa
        $teacher = Teacher::where('user_id', Auth::user()->id)->first();
        //jika bukan seperti dibawah ini
        if (!$teacher) {
            return redirect()->route('admin.courses.index')->withErrors('Invalid Teacher');
        }

        DB::transaction(function () use ($request, $teacher) {
            // Validasi input request menggunakan StoreCoursesRequest
            $validated = $request->validated();

            if ($request->hasFile('thumbnail')) {
                $thumbnailPath = $request->file('thumbnail')->store('thumbnails', 'public');
                //pakai bawah ini biar tidak private penyimpanannya
                $validated['thumbnail'] = $thumbnailPath; // Menambahkan path icon ke array validated
            }

            // Mengubah nama kategori menjadi slug (contoh: "Web Design" menjadi "web-design")
            $validated['slug'] = Str::slug($validated['name']);
            $validated['teacher_id'] = $teacher->id;
            // Membuat record baru di tabel categories dengan data yang sudah divalidasi
            $courses = Course::create($validated);

            //setelah Course dibuat, dibuat juga CourseKeyPoints
            if (!empty($validated['course_keypoints'])) {
                foreach ($validated['course_keypoints'] as $keypointText) {
                    $courses->course_keypoints()->create([
                        'name' => $keypointText,
                    ]);
                }
            }
        });
        return redirect()->route('admin.courses.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Course $course)
    {
        //
        return view('admin.courses.show', compact('course'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Course $course)
    {
        //
        $categories = Category::all();
        return view('admin.courses.edit', compact('course', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCourseRequest $request, Course $course)
    {
        //
        // Memulai transaksi database
        DB::transaction(function () use ($request, $course) {
            // Validasi input request menggunakan UpdateCoursesRequest
            $validated = $request->validated();

            // Memeriksa apakah ada file thumbnail yang diupload
            if ($request->hasFile('thumbnail')) {
                // Menyimpan file thumbnail ke dalam storage publik di folder 'thumbnails'
                $thumbnailPath = $request->file('thumbnail')->store('thumbnails', 'public');
                // Menambahkan path thumbnail yang sudah disimpan ke array validated
                $validated['thumbnail'] = $thumbnailPath;
            }

            // Mengubah nama course menjadi slug (contoh: "Web Design" menjadi "web-design")
            $validated['slug'] = Str::slug($validated['name']);
            // Mengupdate model Course dengan data yang sudah divalidasi
            $course->update($validated);

            // Menghapus CourseKeyPoints lama dan menambahkan yang baru jika ada
            if (!empty($validated['course_keypoints'])) {
                // Menghapus semua CourseKeyPoints yang terkait dengan Course saat ini
                $course->course_keypoints()->delete();
                // Menambahkan CourseKeyPoints yang baru
                foreach ($validated['course_keypoints'] as $keypointText) {
                    $course->course_keypoints()->create([
                        'name' => $keypointText,
                    ]);
                }
            }
        });
        return view('admin.courses.show', compact('course'));

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Course $course)
    {
        //
        DB::beginTransaction();

        try {
            $course->delete();
            DB::commit();

            // Mengarahkan pengguna kembali ke halaman indeks kategori setelah menyimpan
            return redirect()->route('admin.courses.index');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('admin.courses.index')->with('error', 'Ada Error Cuk');
        }
    }
}