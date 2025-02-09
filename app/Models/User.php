<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Spatie\Permission\Models\Role;
use App\Enums\RoleEnum;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
      protected $fillable = [
        'name',
        'email',
        'nim',
        'nidn',
        'nuptk',
        'nip',
        'current_role_id',
        'faculty_id',
        'department_id',
        'study_program_id',
        'password',
        'created_at',
        'phone',
        'bank_name',
        'bank_number',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
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

    public function faculty()
    {
        return $this->belongsTo(Faculty::class);
    }

    public function studyProgram()
    {
        return $this->belongsTo(StudyProgram::class);
    }

    public function currentRole()
    {
        return $this->roles->where('id', $this->current_role_id)->first();
    }

    public function getPhoto()
    {
        // cek dia punya RoleEnum apa
        if ($this->hasRole([RoleEnum::MAHASISWA, RoleEnum::PKM_CENTER])) {
            $nim = $this->nim;
            // get first 2 digit from nim
            $nim_year = substr($nim, 0, 2);
            $year = date('Y');
            $year = substr($year, 0, 2);

            $nim_year = $year . $nim_year;

            if ($nim == null) {
                return "https://ui-avatars.com/api/?name=" . $this->name . "&color=7F9CF5&background=EBF4FF";
            } else {
                return "https://api.um.ac.id/akademik/operasional/GetFoto.ptikUM?nim=" . $nim . '&angkatan=' . $nim_year;
            }
        } elseif ($this->hasRole([RoleEnum::DOSEN, RoleEnum::PENALARAN])) {
            $nip = $this->nip;
            if ($nip == null) {
                return "https://ui-avatars.com/api/?name=" . $this->name . "&color=7F9CF5&background=EBF4FF";
            } else {
                return "https://simpega.um.ac.id/util/pegawai/foto/" . $nip;
            }
        } else {
            return "https://ui-avatars.com/api/?name=" . $this->name . "&color=7F9CF5&background=EBF4FF";
        }

    }
}
