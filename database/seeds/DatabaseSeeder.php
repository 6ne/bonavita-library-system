<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);

      // All password 1234
      DB::table('users')->insert([
        [
          'name' => 'Admin1',
          'nis' => 'admin1',
          'password' => '$2y$10$Opy8MEEvi7d3LV2.q0p5cuRwiOjPy10zqI3mmBZ6ghscNM3/jZY2q',
          'major' => 'Admin',
          'is_admin' => true
        ],
        [
          'name' => 'Admin2',
          'nis' => 'admin2',
          'password' => '$2y$10$Opy8MEEvi7d3LV2.q0p5cuRwiOjPy10zqI3mmBZ6ghscNM3/jZY2q',
          'major' => 'Admin',
          'is_admin' => true
        ],
        [
          'name' => 'Guru',
          'nis' => 'guru',
          'password' => '$2y$10$Opy8MEEvi7d3LV2.q0p5cuRwiOjPy10zqI3mmBZ6ghscNM3/jZY2q',
          'major' => 'Teacher',
          'is_admin' => false
        ],
      ]);

      DB::table('users')->insert([
        [
          'name' => 'Clavin June',
          'nis' => '2001539682',
          'password' => '$2y$10$Opy8MEEvi7d3LV2.q0p5cuRwiOjPy10zqI3mmBZ6ghscNM3/jZY2q',
          'major' => 'TKJ',
          'grade' => 12,
          'class' => 2
        ],
        [
          'name' => 'Jessica Tania',
          'nis' => '2191651035',
          'password' => '$2y$10$Opy8MEEvi7d3LV2.q0p5cuRwiOjPy10zqI3mmBZ6ghscNM3/jZY2q',
          'major' => 'MM',
          'grade' => 11,
          'class' => 1
        ],
      ]);

      DB::table('books')->insert([
        [
          'title' => 'A',
          'author' => 'A',
          'stock' => 10
        ],
        [
          'title' => 'B',
          'author' => 'B',
          'stock' => 10
        ],
        [
          'title' => 'C',
          'author' => 'C',
          'stock' => 10
        ],
        [
          'title' => 'D',
          'author' => 'D',
          'stock' => 10
        ],
      ]);
    }
}
