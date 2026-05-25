<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\Member;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        /**
         * =========================
         * ADMIN USER
         * =========================
         */
        $admin = User::create([
            'name' => 'Admin Perpustakaan',
            'email' => 'perpustakaan@man1bengkalis.sch.id',
            'phone' => '089502337262',
            'role' => 'admin',
            'password' => Hash::make('password'),
        ]);

        /**
         * =========================
         * MEMBER USER
         * =========================
         */
        $userMember = User::create([
            'name' => 'Nurhidayah',
            'email' => 'nurhidayah@gmail.com',
            'phone' => '081275627187',
            'role' => 'member',
            'password' => Hash::make('password'),
        ]);

        /**
         * =========================
         * MEMBER PROFILE
         * =========================
         */
        Member::create([
            'user_id' => $userMember->id,
            'nisn' => '1234567890',
            'class' => 'XII RPL 1',
            'address' => 'Bengkalis',
            'gender' => 'P',
        ]);

        /**
         * =========================
         * BOOKS
         * =========================
         */
        $books = [
            ['B001', 'Algoritma dan Pemrograman', 'Rinaldi Munir'],
            ['B002', 'Struktur Data', 'Sutanto'],
            ['B003', 'Basis Data', 'Abdul Kadir'],
            ['B004', 'Pemrograman Web Laravel', 'Wahyu Setiawan'],
            ['B005', 'Jaringan Komputer', 'Tanenbaum'],
            ['B006', 'Sistem Operasi', 'Silberschatz'],
            ['B007', 'Machine Learning Dasar', 'Andrew Ng'],
            ['B008', 'Artificial Intelligence', 'Stuart Russell'],
            ['B009', 'Pemrograman Python', 'Guido van Rossum'],
            ['B010', 'Pemrograman Java', 'James Gosling'],
        ];

        foreach ($books as $book) {
            Book::create([
                'code' => $book[0],
                'title' => $book[1],
                'author' => $book[2],
                'published_year' => rand(2015, 2024),
                'description' => 'Buku tentang ' . $book[1],
                'stock' => rand(3, 10),
            ]);
        }
    }
}
