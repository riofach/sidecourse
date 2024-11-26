<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'occupation',
        'avatar',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function courses()
    {
        //sesuaikan dengan database or dbeaver
        return $this->belongsToMany(Course::class, 'course_students');
    }

    //code apakah user yang login ini aktif subscription?
    public function subscribe_transaction()
    {
        //satu User bisa banyak subscription
        return $this->hasMany(SubscribeTransaction::class);
    }

    //apakah subscription aktif dan sudah bayar ?
    public function hasActiveSubscription()
    {
        $latestSubscription = $this->subscribe_transaction()
            //mengambil transaksi langganan yang sudah dibayar
            ->where('is_paid', true)
            //Mengurutkan hasil query berdasarkan kolom update_at dalam urutan menurun, sehingga langganan terbaru akan berada di urutan pertama.
            ->latest('updated_at')
            //Mengambil entri pertama dari hasil query, yang merupakan langganan terbaru yang sudah dibayar.
            ->first();

        if (!$latestSubscription) {
            return false;
        }
        //Mengubah tanggal mulai langganan (subscription_start_date) menjadi objek Carbon untuk manipulasi tanggal.
        //Menambahkan satu bulan ke tanggal mulai langganan untuk menghitung tanggal akhir langganan.
        $subscriptionEndDate = Carbon::parse($latestSubscription->subscription_start_date)->addMonths(1);
        //Carbon::now(): Mengambil tanggal dan waktu saat ini.
        //Memeriksa apakah tanggal dan waktu saat ini kurang dari atau sama dengan tanggal akhir langganan. Jika ya, fungsi akan mengembalikan true, menandakan bahwa langganan masih aktif.
        return Carbon::now()->lessThanOrEqualTo($subscriptionEndDate);
    }
}