<?php

namespace Database\Seeders;

use App\Models\Tanaman;
use Illuminate\Database\Seeder;

class TanamanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tanaman = [
            [
                'nama' => 'Monstera',
                'deskripsi' => 'Monstera adalah tanaman hias populer dengan daun besar berlubang yang unik. Tanaman ini berasal dari hutan tropis Amerika Tengah.',
                'cara_perawatan' => 'Letakkan di tempat dengan cahaya tidak langsung, siram saat tanah kering 2-3 cm dari permukaan, dan berikan kelembapan yang cukup.',
                'gambar' => 'monstera.jpg'
            ],
        ];

        foreach ($tanaman as $data) {
            Tanaman::updateOrCreate(
                ['nama' => $data['nama']],
                $data
            );
        }
    }
}
