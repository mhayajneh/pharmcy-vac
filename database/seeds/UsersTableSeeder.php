<?php

use App\Models\User;

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    User::create([
      'name' => 'admin',
      'email' => 'admin@admin.com',
      'password' => \Illuminate\Support\Facades\Hash::make('admin'),
      'email_verified_at' => now()
    ]);
  }
}
