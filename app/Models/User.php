<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'type', 'number', 'location', 'area', 'city', 'cv_path'
    ];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];




    /**
     * Get the users attributes from their name.
     *
     * @return String
     */
    public function getInitialsAttribute()
    {
      $initials = '';
      $words = explode(" ", $this->name);

      foreach ($words as $word) {
        $initials .= strtoupper($word[0]);
      }

      return $initials;
    }
    /**
     * Automatically Generate a user color.
     *
     * @return String
     */
    /*public function getColorAttribute()
    {
      $colors = ['blue', 'indigo', 'purple', 'pink', 'red', 'orange', 'yellow', 'green', 'cyan'];
      $number = hexdec(crc32($this->name));
      $seed = (integer) substr($number, -3);
      $index = $seed % count($colors) - 1;

      return $colors[$index];
    }*/

}
