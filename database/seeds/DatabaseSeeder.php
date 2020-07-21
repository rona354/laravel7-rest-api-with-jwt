<?php

use App\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UserSeeder::class);
        $faker = Faker\Factory::create('id_ID'); //import library faker
        $fakerUS = Faker\Factory::create();      // library faker jika tidak ada ID

        $limit = 3; //batasan berapa banyak data

        // $timestamp = Carbon\Carbon::now()->format('Y-m-d H:i:s');

        for ($i = 0; $i < $limit; $i++) {
            $gender = $faker->randomElement(['male', 'female']);
            $agama = $faker->randomElement(['Islam', 'Kristen', 'Katolik', 'Hindu', 'Buddha', 'Konghucu']);

            User::create([            //mengisi data di database
                'nama' => $faker->name($gender),
                'email' => $faker->unique()->safeEmail,     //email unique sehingga tidak ada yang sama
                'password' => bcrypt('secret'),
                'jenis_kelamin' => $gender,
                'tanggal_lahir' => $faker->dateTimeBetween('1980-01-01', '2002-12-31')->format('d-m-Y'), // outputs something like 17/09/2001
                'alamat' => $faker->address,
                'no_telefon' => $faker->phoneNumber,
                'agama' => $agama,
                'jabatan' => $fakerUS->jobTitle,
                'pas_foto' => $faker->image('public/pas_foto', 300, 400, "people", true),       // http://localhost:8000/storage/pas_foto/xxx.jpg
                'created_at' => Carbon\Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon\Carbon::now()->format('Y-m-d H:i:s')
            ]);
        };
    }
}
