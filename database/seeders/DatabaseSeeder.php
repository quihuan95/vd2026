<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(AdminSeeder::class);

        // General settings
        $settings = [
            'conference_name_vi' => 'Hội nghị Khoa học Quốc tế Bệnh viện Hữu nghị Việt Đức 2026',
            'conference_name_en' => 'Viet Duc University Hospital International Scientific Conference 2026',
            'secretariat_email' => 'eventvietduc@vduh.org',
            'hotline' => '+84 948 996 688',
            'sec_dr_maianh_email' => 'Drbuimaianh@gmail.com',
            'sec_dr_maianh_phone' => '+84 904 218 389',
            'logistics_dr_nghia_email' => 'nghiabt@vduh.org',
            'logistics_dr_nghia_phone' => '+84 948 996 688',
            'logistics_ms_van_email' => 'phambichvan@vduh.org',
            'logistics_ms_van_phone' => '+84 917 738 321',
            'abstract_deadline' => '2026-10-15',
            'early_bird_deadline' => '2026-10-01',
            'registration_open' => '1',
            'abstract_open' => '1',
            'bank_account_name' => 'BỆNH VIỆN HỮU NGHỊ VIỆT ĐỨC',
            'bank_account_number' => '12310000033700',
            'bank_name' => 'BIDV - Chi nhánh Quang Trung, Hà Nội',
        ];

        foreach ($settings as $key => $val) {
            Setting::updateOrCreate(
                ['key' => $key],
                ['value' => $val, 'group' => 'conference']
            );
        }

        $this->call(SpeakerSeeder::class);

        $this->call(RegistrationSeeder::class);
    }
}
