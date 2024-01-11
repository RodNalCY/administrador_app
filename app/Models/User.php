<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Contracts\Role;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Support\Facades\Auth;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
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
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function adminlte_image()
    {
        $auth = Auth::user();
        $user = User::selectRaw('empleado.Sexo')
            ->join('empleado', 'users.id', '=', 'empleado.idUsuario')
            ->where('users.id', $auth->id)
            ->first();
        
        if ($user->Sexo == "M") {
            return 'https://cdn1.iconfinder.com/data/icons/avatar-3/512/Doctor-512.png';
        } else {
            return 'https://cdn.icon-icons.com/icons2/582/PNG/512/asistante_icon-icons.com_55049.png';
        }
    }

    public function adminlte_desc()
    {
        $auth = Auth::user();
        $user = User::find($auth->id);

        $roles = $user->getRoleNames();
        return $roles[0];
    }

    public function adminlte_profile_url()
    {
        return 'profile/username';
    }
}
