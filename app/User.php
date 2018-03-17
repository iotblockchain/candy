<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function invitee()
    {
        return $this->hasMany(User::class, 'from');
    }

    public function updateBonus()
    {
        $count = $this->invitee()->count();

        $vip = $this->calcVip($count);

        $bonus = $this->calcBonus($count, $vip);

        $this->bonus = $bonus;
        $this->should_send_bonus = $bonus - $this->sent_bonus;
        $this->vip = $vip;
        $this->invite_count = $count;

        $this->save();
    }

    public function calcBonus(int $count, int $vip)
    {
        $bonus = 0;

        switch ($vip) {
        case 6:
            $bonus += ($count - 50) * 777;
            $count = 50;
        case 5:
            $bonus += ($count - 30) * 677;
            $count = 30;
        case 4:
            $bonus += ($count - 20) * 377;
            $count = 20;
        case 3:
            $bonus += ($count - 10) * 277;
            $count = 10;
        case 2:
            $bonus += ($count - 5) * 177;
            $count = 5;
        case 1:
            $bonus += $count * 100;
        default:
            $bonus += 100;
        }

        return $bonus;
    }

    public function calcVip(int $count): int
    {
        if ($count <= 0) {
            return 0;
        }

        if ($count >= 1 && $count < 6) {
            return 1;
        }

        if ($count >= 6 && $count < 11) {
            return 2;
        }

        if ($count >= 11 && $count < 21) {
            return 3;
        }

        if ($count >= 21 && $count < 31) {
            return 4;
        }

        if ($count >= 31 && $count < 51) {
            return 5;
        }

        return 6;
    }
}
