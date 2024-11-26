<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSubscribeTransactionRequest;
use App\Models\Course;
use App\Models\SubscribeTransaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class FrontController extends Controller
{
    public function index()
    {
        $courses = Course::with(['category', 'teacher', 'students'])->orderByDesc('id')->get();
        return view('front.index', compact('courses'));
    }
    public function details(Course $course)
    {
        return view('front.details', compact('course'));
    }
    public function learning(Course $course, $courseVideoId)
    {
        $user = Auth::user();
        if (!$user->hasActiveSubscription()) {
            return redirect()->route('front.pricing');
        }

        $video = $course->course_videos->firstWhere('id', $courseVideoId);

        $user->courses()->syncWithoutDetaching($course->id);

        return view('front.learning', compact('course', 'video'));
    }
    public function pricing()
    {
        return view('front.pricing');
    }
    public function checkout()
    {
        $user = Auth::user();
        if ($user->hasActiveSubscription()) {
            return redirect()->route('front.index');
        }

        return view('front.checkout');
    }

    public function checkout_store(StoreSubscribeTransactionRequest $request)
    {
        $user = Auth::user();
        if ($user->hasActiveSubscription()) {
            return redirect()->route('front.index');
        }

        // Memulai transaksi database
        DB::transaction(function () use ($request, $user) {
            // Validasi input request menggunakan StoreCategoryRequest
            $validated = $request->validated();

            if ($request->hasFile('proof')) {
                $proofPath = $request->file('proof')->store('proofs', 'public');
                $validated['proof'] = $proofPath;
            }

            // validasi userid
            $validated['user_id'] = $user->id;
            $validated['total_amount'] = 350000;
            $validated['is_paid'] = false;
            // Membuat record baru di tabel categories dengan data yang sudah divalidasi
            $transaction = SubscribeTransaction::create($validated);
        });

        session()->flash('success', 'Transaksi Successfull! Wait Admin to Confirm');
        // Mengarahkan pengguna kembali ke halaman indeks kategori setelah menyimpan
        return redirect()->route('dashboard');
    }
}