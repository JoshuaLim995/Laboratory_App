<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Silber\Bouncer\Database\HasRolesAndAbilities;
use Carbon\Carbon;

class User extends Authenticatable
{
    use HasRolesAndAbilities;
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
    'name', 'email', 'password', 'username', 'department', 'programme', 'supervisor', 'contact', 'work_bench', 'office', 'approved'
    // 'name', 'email', 'password', 'username', 'department', 'contact',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
    'password', 'remember_token',
    ];

    public function role($value)
    {
        if(count($this->roles) > 0 )
            return $this->roles->pluck($value)[0];
        else
            return 'N/A';
    }

    public function getProgramme()
    {
        if($this->programme)
            return $this->programme;
        else
            return 'N/A';
    }

    public function getSupervisor()
    {
        if($this->supervisor)
            return $this->supervisor;
        else
            return 'N/A';
    }

    public function isUser()
    {
        if($this->isA('dlmsa', 'assistant', 'admin', 'as', 'ug', 'pg'))
            return true;
        else
            return false;
    }

    public function isStaff()
    {
        if($this->isA('dlmsa', 'assistant', 'admin', 'as'))
            return true;
        else
            return false;
    }

    public function isStudent()
    {
        if($this->isA('ug', 'pg'))
            return true;
        else
            return false;
    }

    public function isdlmsa()
    {
        if($this->isA('dlmsa'))
            return true;
        else
            return false;
    }

    public function isAdmin()
    {
        if($this->isA('dlmsa', 'admin'))
            return true;
        else
            return false;
    }

    public function isApproved()
    {
        if($this->approved === '1')
            return true;
        else
            return false;
    }

    public function loans()
    {
        return $this->hasMany(Loan::class);
    }

    public function loanStatus($value)
    {
        return $this->loans()->where('status', '=', $value);
    }

    public function pending_loans()
    {
        return $this->loans()->where('status', '=', '0');
    }

    public function approved_loans()
    {
        return $this->loans()->where('status', '=', '1');
    }

    public function prepared_loans()
    {
        return $this->loans()->where('status', '=', '2');
    }

    public function overdue_loans()
    {
        return $this->loans()->where('status', '=', '99');
    }

    public function reservations()
    {
        $now = Carbon::now()->toDateString();
        return $this->hasMany(Reservation::class)->where('starts_at', '>=', $now)->orderBy('starts_at');
    }

    public function rent_locker()
    {
        return $this->hasOne(RentLocker::class);
    }
}
