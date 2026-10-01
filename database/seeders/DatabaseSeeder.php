<?php

namespace Database\Seeders;

use App\Models\Setting;
use App\Models\Speaker;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Admin user
        User::updateOrCreate(
            ['email' => 'admin@vduh.org'],
            [
                'name' => 'VDUH 2026 Administrator',
                'password' => Hash::make('vduh2026@admin'),
                'email_verified_at' => now(),
            ]
        );

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

        // Seed keynote speakers
        $speakers = [
            [
                'name' => 'PGS. TS. Dương Đức Hùng',
                'title' => 'Giám đốc Bệnh viện Hữu nghị Việt Đức',
                'affiliation' => 'Bệnh viện Hữu nghị Việt Đức',
                'topic' => 'Khai mạc & Định hướng phát triển Ngoại khoa Việt Nam trong kỷ nguyên mới',
                'session_time' => '19/11/2026 - 08:30',
                'bio_vi' => 'PGS. TS. Dương Đức Hùng là chuyên gia hàng đầu về phẫu thuật tim mạch và lồng ngực tại Việt Nam, hiện là Giám đốc Bệnh viện Hữu nghị Việt Đức. Ông đã có nhiều đóng góp lớn trong việc phát triển các kỹ thuật phẫu thuật tim mạch chuyên sâu và hiện đại hóa hệ thống y tế.',
                'bio_en' => 'Assoc. Prof. Duong Duc Hung, MD, PhD is a renowned cardiovascular and thoracic surgeon in Vietnam and the Director of Viet Duc University Hospital, leading advancements in modern surgical practice.',
                'sort_order' => 1,
                'is_published' => true,
            ],
            [
                'name' => 'Prof. Jean-Marc Regimbeau, MD, PhD',
                'title' => 'Trưởng khoa Ngoại Tiêu hóa & Ghép tạng',
                'affiliation' => 'Bệnh viện Đại học Amiens-Picardie, Pháp',
                'topic' => 'Những tiến bộ mới nhất trong Phẫu thuật Ghép gan và Phẫu thuật Robot đường tiêu hóa',
                'session_time' => '19/11/2026 - 09:30',
                'bio_vi' => 'Giáo sư chuyên ngành phẫu thuật tiêu hóa - gan mật tụy và ghép tạng, nguyên Chủ tịch Hội Phẫu thuật Tiêu hóa Pháp, cộng sự quốc tế lâu năm của BV Hữu nghị Việt Đức.',
                'bio_en' => 'Leading expert in HPB surgery, liver transplantation and robotic gastrointestinal surgery from Amiens University Hospital, France.',
                'sort_order' => 2,
                'is_published' => true,
            ],
            [
                'name' => 'Prof. Kenjiro Kosaki, MD, PhD',
                'title' => 'Giám đốc Trung tâm Y học Di truyền Lâm sàng',
                'affiliation' => 'Đại học Keio, Tokyo, Nhật Bản',
                'topic' => 'Ứng dụng Y học chính xác và Giải trình tự Gen trong Phẫu thuật Nhi và Bệnh lý phức tạp',
                'session_time' => '19/11/2026 - 10:45',
                'bio_vi' => 'Chuyên gia y học chính xác và di truyền học lâm sàng quốc tế từ Đại học Keio, Nhật Bản.',
                'bio_en' => 'International pioneer in clinical genetics and precision medicine from Keio University School of Medicine, Tokyo, Japan.',
                'sort_order' => 3,
                'is_published' => true,
            ],
            [
                'name' => 'TS. Bùi Mai Anh',
                'title' => 'Trưởng Ban Thư ký Chuyên môn Hội nghị',
                'affiliation' => 'Bệnh viện Hữu nghị Việt Đức',
                'topic' => 'Tổng quan các tiến bộ kỹ thuật trong Phẫu thuật Tạo hình - Vi phẫu tại BV Việt Đức',
                'session_time' => '19/11/2026 - 14:00',
                'bio_vi' => 'Chuyên gia vi phẫu và tạo hình tái tạo hàng đầu Bệnh viện Hữu nghị Việt Đức, Trưởng Ban Thư ký chuyên môn Hội nghị.',
                'bio_en' => 'Senior reconstructive and microsurgery specialist at Viet Duc University Hospital, Head of Academic Secretariat.',
                'sort_order' => 4,
                'is_published' => true,
            ],
        ];

        foreach ($speakers as $spk) {
            Speaker::updateOrCreate(
                ['name' => $spk['name']],
                $spk
            );
        }
    }
}
