<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Course extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'slug',
        'about',
        'path_trailer',
        'thumbnail',
        'teacher_id',
        'category_id',
    ];

    //belongsTo : Many to one,
    //hasMany : one to Many,
    //belongsToMany : Many to Many.

    public function category()
    {
        //sesuaikan dengan database or dbeaver
        return $this->belongsTo(Category::class);
    }
    public function teacher()
    {
        //sesuaikan dengan database or dbeaver
        return $this->belongsTo(Teacher::class);
    }
    public function course_videos()
    {
        //sesuaikan dengan database or dbeaver
        return $this->hasMany(CourseVideo::class);
    }
    public function course_keypoints()
    {
        //sesuaikan dengan database or dbeaver
        return $this->hasMany(CourseKeypoint::class);
    }
    public function students()
    {
        //satu student bisa banyak kelas/course begitupun sebaliknya
        //User::class itu mengarah ke model, dan course_students itu pivot table yang berisi 2 id course dan user
        return $this->belongsToMany(User::class, 'course_students');
    }

}