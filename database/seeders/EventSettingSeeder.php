<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\EventSetting;
use Carbon\Carbon;

class EventSettingSeeder extends Seeder
{
    public function run(): void
    {
        // Hapus data lama jika ada (biar tidak duplikat)
        EventSetting::truncate();

        EventSetting::create([
            'child_name' => 'Muhammad Zidni Ilman',
            'parent_names' => 'Bpk. Hartono & Ibu Siti',
            'event_date' => Carbon::now()->addDays(14)->setTime(9, 0), // 2 minggu lagi jam 9 pagi
            'location_name' => 'Gedung Serbaguna Al-Barokah',
            'location_address' => 'Jl. Kebahagiaan No. 123, Jakarta Selatan',
            // Link iframe Google Maps dummy
            'maps_iframe' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3966.051839230417!2d106.8249646!3d-6.2568973!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f3d368851d89%3A0x65a4b62232639422!2sKalibata%20City!5e0!3m2!1sid!2sid!4v1648521234567!5m2!1sid!2sid',
            
            // Data Bank Default
            'bank_name_1' => 'BCA',
            'bank_acc_1' => '1234567890',
            'bank_holder_1' => 'Bpk. Hartono',
            
            'bank_name_2' => 'DANA',
            'bank_acc_2' => '081234567890',
            'bank_holder_2' => 'Ibu Siti',
            
            // Gambar biarkan null dulu (nanti upload via admin)
            'hero_image' => null,
            'child_photo' => null,
        ]);
    }
}