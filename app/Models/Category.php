<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory, SoftDeletes;

    //cara pertama mass assignment sesuai table
    //cara pertama kalo user memasukkan sensitive data like password
    protected $fillable = [
        'name',
        'slug',
        'icon',
    ];

    //cara modern or kedua dengan begini user bisa memasukkan semua data ditable, kecuali kolom id
    //minusnya user bisa memasukkan semua data
    protected $guarded = [
        'id',
    ];

    public function course()
    {
        //sesuaikan dengan database or dbeaver
        return $this->hasMany(Course::class);
    }
}