<?php

namespace App\Models;

use App\Models\Donation;
use Illuminate\Database\Eloquent\Model;

class State extends Model
{
  const CREATED_AT = null;
  /**
   * Get the route key for the model.
   *
   * @return string
   */
  public function getRouteKeyName()
  {
      return 'abbreviation';
  }
  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'id', 'name', 'abbreviation', 'is_visible'
  ];
  /**
   * The attributes that should be cast to native types.
   *
   * @var array
   */
  protected $casts = [
      'is_visible' => 'boolean',
  ];





  /**
   * Get the users attributes from their name.
   *
   * @return integer
   */
  public function getIsVisibleAttribute()
  {
    if( $this->donations->isNotEmpty() ) {
      return true;
    } else {
      return $this->attributes['is_visible'];
    }
  }  /**
   * Get the users attributes from their name.
   *
   * @return integer
   */
  public function getDonationCountAttribute()
  {
    if( $this->is_visible ) {
      return 1;
    } else {
      return $this->donations->count();
    }
  }





  /**
   * Get the users attributes from their name.
   *
   * @return Relationship
   */
  public function donations()
  {
    return $this->hasMany(Donation::class);
  }
}
