<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $countryDatabaseTable = public_path('backend\country.sql');
        $db = [
            'username' => env('DB_USERNAME'),
            'password' => env('DB_PASSWORD'),
            'host' => env('DB_HOST'),
            'database' => env('DB_DATABASE')
        ];

        exec("mysql --user={$db['username']} --password={$db['password']} --host={$db['host']} --database {$db['database']} < $countryDatabaseTable");

        info('SQL Import Done');
    }
}
