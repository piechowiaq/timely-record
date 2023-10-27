<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Company;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Role::create(['name' => 'Super Admin']);

        $company = Company::create([
            'name' => 'Hotel',
            'city' => 'Warszawa',
        ]);

        $user = User::create([
             'first_name' => 'Super Admin',
             'last_name' => 'Super Admin',
             'email' => 'contact@timelyrecord.com',
             'password' => Hash::make('12345678'),
            'email_verified_at' => Carbon::now()

         ])->assignRole('Super Admin');

        $company->users()->attach($user);

        $this->call([
            RegistrySeeder::class,
        ]);
    }
}
