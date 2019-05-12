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
          'nis' => 'admin',
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
        ]
      ]);

      DB::table('users')->insert([
        [
          'name' => 'Clavin June',
          'nis' => '2001539682',
          'password' => '$2y$10$Opy8MEEvi7d3LV2.q0p5cuRwiOjPy10zqI3mmBZ6ghscNM3/jZY2q',
          'major' => 'TKJ',
          'grade' => 12,
          'class' => 2,
          'books_on_held' => 2
        ],
        [
          'name' => 'Jessica Tania',
          'nis' => '2101651035',
          'password' => '$2y$10$Opy8MEEvi7d3LV2.q0p5cuRwiOjPy10zqI3mmBZ6ghscNM3/jZY2q',
          'major' => 'MM',
          'grade' => 11,
          'class' => 1,
          'books_on_held' => 1
        ],
        [
          'name' => 'Contoh',
          'nis' => 'contoh',
          'password' => '$2y$10$Opy8MEEvi7d3LV2.q0p5cuRwiOjPy10zqI3mmBZ6ghscNM3/jZY2q',
          'major' => 'AP',
          'grade' => 10,
          'class' => 3,
          'books_on_held' => 0
        ],
        [
          'name' => 'Example',
          'nis' => 'example',
          'password' => '$2y$10$Opy8MEEvi7d3LV2.q0p5cuRwiOjPy10zqI3mmBZ6ghscNM3/jZY2q',
          'major' => 'AK',
          'grade' => 12,
          'class' => 1,
          'books_on_held' => 0
        ],
      ]);

      DB::table('books')->insert([
        [
          'title' => 'A Tale of Two Cities',
          'author' => 'Charles Dickens',
          'stock' => 10
        ],
        [
          'title' => 'The Lord of the Rings',
          'author' => 'J. R. R. Tolkien',
          'stock' => 10
        ],
        [
          'title' => 'Le Petit Prince (The Little Prince)',
          'author' => 'Antoine de Saint-Exupéry',
          'stock' => 10
        ],
        [
          'title' => 'Harry Potter and the Philosopher\'s Stone',
          'author' => 'J. K. Rowling',
          'stock' => 10
        ],
        [
          'title' => 'Don Quixote',
          'author' => 'Miguel de Cervantes',
          'stock' => 10,
        ],
        [
          'title' => 'The Hobbit',
          'author' => 'J. R. R. Tolkien',
          'stock' => 10,
        ],
        [
          'title' => 'And Then There Were None',
          'author' => 'Agatha Christie',
          'stock' => 10,
        ],
      ]);

      DB::table('notifications')->insert([
        [
          'book_id' => 1,
          'from' => 4,
          'to' => 0,
          'is_new' => 0,
          'status' => 'approved',
          'reason' => 'No reason'
        ],
        [
          'book_id' => 2,
          'from' => 4,
          'to' => 0,
          'is_new' => 0,
          'status' => 'approved',
          'reason' => 'No reason'
        ],
        [
          'book_id' => 3,
          'from' => 5,
          'to' => 0,
          'is_new' => 0,
          'status' => 'rejected',
          'reason' => 'No reason'
        ],
        [
          'book_id' => 4,
          'from' => 5,
          'to' => 0,
          'is_new' => 0,
          'status' => 'rejected',
          'reason' => 'No reason'
        ],
        [
          'book_id' => 2,
          'from' => 5,
          'to' => 0,
          'is_new' => 0,
          'status' => 'rejected',
          'reason' => 'No reason'
        ],
        [
          'book_id' => 1,
          'from' => 5,
          'to' => 0,
          'is_new' => 0,
          'status' => 'approved',
          'reason' => 'No reason'
        ]
      ]);

      DB::table('transactions')->insert([
        [
          'user_id' => 4,
          'book_id' => 1,
          'is_active' => 1,
          'borrowed_at' => '2019-05-01 23:44:42',
          'lend_by' => 'Admin1',
          'returned_at' => '2019-05-04 23:44:42'
        ],
        [
          'user_id' => 4,
          'book_id' => 2,
          'is_active' => 1,
          'borrowed_at' => '2019-05-09 23:44:42',
          'lend_by' => 'Admin1',
          'returned_at' => '2019-05-12 23:44:42'
        ],
        [
          'user_id' => 5,
          'book_id' => 1,
          'is_active' => 1,
          'borrowed_at' => '2019-05-09 23:44:42',
          'lend_by' => 'Admin1',
          'returned_at' => '2019-05-12 23:44:42'
        ]
      ]);
    }
}
