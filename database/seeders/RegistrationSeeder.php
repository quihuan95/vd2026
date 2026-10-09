<?php

namespace Database\Seeders;

use App\Models\Registration;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class RegistrationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('vi_VN');
        $faker->seed(2026);

        $organizations = [
            'Bệnh viện Hữu nghị Việt Đức',
            'Bệnh viện Bạch Mai',
            'Bệnh viện Trung ương Huế',
            'Bệnh viện Chợ Rẫy',
            'Bệnh viện Đại học Y Hà Nội',
            'Bệnh viện Đại học Y Dược TP.HCM',
            'Bệnh viện Đa khoa Xanh Pôn',
            'Trường Đại học Y Hà Nội',
        ];
        $departments = [
            'Ngoại Tổng hợp',
            'Phẫu thuật Tim mạch và Lồng ngực',
            'Chấn thương Chỉnh hình',
            'Phẫu thuật Thần kinh',
            'Gây mê Hồi sức',
            'Tiêu hóa',
            'Tiết niệu',
            'Điều dưỡng',
        ];
        $categories = [
            'independent_delegate',
            'independent_delegate',
            'independent_delegate',
            'vduh_staff',
            'invited_speaker',
            'vip',
        ];
        $professionalTitles = ['member', 'non_member', 'student'];
        $academicTitles = [null, 'BS', 'ThS.BS', 'TS.BS', 'BSCKII', 'PGS.TS'];

        foreach (range(1, 40) as $number) {
            $category = $categories[($number - 1) % count($categories)];
            $professionalTitle = $professionalTitles[($number - 1) % count($professionalTitles)];
            $paymentStatus = $this->paymentStatus($category, $number);
            $registeredAt = now()
                ->subDays($number % 20)
                ->setTime(8 + ($number % 9), ($number * 7) % 60);

            Registration::firstOrCreate(
                ['delegate_id' => sprintf('VDUH26-DEL-%04d', $number)],
                [
                    'category' => $category,
                    'academic_title' => $academicTitles[($number - 1) % count($academicTitles)],
                    'full_name' => $faker->name(),
                    'gender' => $number % 2 === 0 ? 'female' : 'male',
                    'dob' => $faker->dateTimeBetween('-65 years', '-24 years')->format('Y-m-d'),
                    'organization' => $organizations[($number - 1) % count($organizations)],
                    'department' => $departments[($number - 1) % count($departments)],
                    'job_title' => $number % 5 === 0 ? 'Trưởng khoa' : 'Bác sĩ',
                    'email' => sprintf('daibieu%04d@example.test', $number),
                    'phone' => sprintf('09%08d', 10_000_000 + $number),
                    'country' => 'VN',
                    'professional_title' => $professionalTitle,
                    'attend_dinner' => $number % 3 !== 0,
                    'request_cme' => $number % 4 !== 0,
                    'cme_id_number' => $number % 4 !== 0 ? sprintf('001%09d', $number) : null,
                    'form_language' => 'vi',
                    'payment_method' => $category === 'independent_delegate' ? 'wire_transfer' : 'complimentary',
                    'payment_status' => $paymentStatus,
                    'amount_vnd' => $this->amount($category, $professionalTitle),
                    'identity_path' => null,
                    'payment_proof_path' => null,
                    'qr_code_token' => hash('sha256', "vduh-registration-{$number}"),
                    'checked_in_at' => $number % 4 === 0 && $paymentStatus !== 'cancelled'
                        ? $registeredAt->copy()->addDays(20)
                        : null,
                    'email_status' => 'sent',
                    'email_sent_at' => $registeredAt->copy()->addMinutes(2),
                    'paid_at' => in_array($paymentStatus, ['paid', 'complimentary'], true)
                        ? $registeredAt->copy()->addHours(3)
                        : null,
                    'notes' => $number % 10 === 0 ? 'Đại biểu cần hỗ trợ tại quầy check-in.' : null,
                    'created_at' => $registeredAt,
                ],
            );
        }
    }

    private function paymentStatus(string $category, int $number): string
    {
        if ($category !== 'independent_delegate') {
            return 'complimentary';
        }

        return match ($number % 5) {
            0 => 'cancelled',
            1, 2 => 'paid',
            default => 'pending_verification',
        };
    }

    private function amount(string $category, string $professionalTitle): int
    {
        if ($category !== 'independent_delegate') {
            return 0;
        }

        return match ($professionalTitle) {
            'member' => 1_500_000,
            'student' => 1_000_000,
            default => 2_000_000,
        };
    }
}
