<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Donation extends Model
{
  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
      'id', 'name', 'email', 'city', 'zip', 'amount', 'source', 'state_id', 'updated_at', 'created_at'
  ];





  /**
   * Get the state for the donation.
   *
   * @return Relationship
   */
  public function state()
  {
    return $this->belongsTo(State::class);
  }
}
