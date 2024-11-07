<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Course;
use App\Models\CourseStudent;
use App\Models\SubscribeTransaction;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    //
    public function index()
    {
        $user = Auth::user();
        $coursesQuery = Course::query();

        //jika yang login teacher maka $query digunakan yang dibawah ini / filter
        if ($user->hasRole('teacher')) {
            $coursesQuery->whereHas('teacher', function ($query) use ($user) {
                //dimana user_id pada tabel $user = user id
                $query->where('user_id', $user->id);
            });
            $students = CourseStudent::whereIn('course_id', $coursesQuery->select('id'))
                ->distinct('user_id')
                ->count('user_id');
        } else {
            $students = CourseStudent::distinct('user_id')
                ->count('user_id');
        }

        //jika login role owner
        $courses = $coursesQuery->count();
        $categories = Category::count();
        $transactions = SubscribeTransaction::count();
        $teachers = Teacher::count();

        return view('dashboard', compact('students', 'courses', 'categories', 'transactions', 'teachers'));
    }
}