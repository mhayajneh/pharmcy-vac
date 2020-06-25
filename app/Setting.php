<?php

namespace App;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
  /**
   * The primary key for the model.
   *
   * @var string
   */
  protected $primaryKey = 'key';
  /**
   * The "type" of the auto-incrementing ID.
   *
   * @var string
   */
  protected $keyType = 'string';
  /**
   * Indicates if the IDs are auto-incrementing.
   *
   * @var bool
   */
  public $incrementing = false;
  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
      'key', 'value', 'description', 'user_id'
  ];
  /**
   * The attributes that should be hidden for serialization.
   *
   * @var array
   */
  protected $hidden = [
    'created_at',
    'updated_at'
  ];
  /**
   * The attributes that should be visible in serialization.
   *
   * @var array
   */
  protected $visible = [];




  /**
   * Get the user who created this setting.
   *
   * @return Relationship
   */
  public function user()
  {
    return $this->belongsTo(User::class)->withDefault([
        'name' => 'System Default',
        'initial' => 'SD',
        'color' => 'green',
    ]);
  }
}
