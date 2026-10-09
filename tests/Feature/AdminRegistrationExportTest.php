<?php

namespace Tests\Feature;

use App\Models\Registration;
use App\Models\User;
use Illuminate\Foundation\Testing\LazilyRefreshDatabase;
use Illuminate\Support\Carbon;
use Tests\TestCase;
use ZipArchive;

class AdminRegistrationExportTest extends TestCase
{
    use LazilyRefreshDatabase;

    public function test_admin_can_export_searched_registrations_with_requested_columns(): void
    {
        $this->travelTo(Carbon::parse('2026-10-09 10:30:00'));
        $admin = User::factory()->create();
        Registration::create($this->registrationAttributes([
            'delegate_id' => 'VDUH26-DEL-0001',
            'full_name' => 'Nguyễn Văn Có Trong File',
            'payment_status' => 'paid',
            'gender' => 'male',
            'dob' => '1985-05-15',
            'organization' => 'Bệnh viện Hữu nghị Việt Đức',
            'department' => 'Ngoại Tổng hợp',
            'job_title' => 'Bác sĩ',
            'attend_dinner' => true,
        ]));
        Registration::create($this->registrationAttributes([
            'delegate_id' => 'VDUH26-DEL-0002',
            'full_name' => 'Người Không Thuộc Bộ Lọc',
            'payment_status' => 'cancelled',
            'qr_code_token' => 'qr-token-0002',
        ]));

        $response = $this->actingAs($admin)->get('/admin/registrations-export?search=Trong%20File');

        $response->assertOk();
        $response->assertHeader('content-type', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        $response->assertDownload('danh-sach-dai-bieu-2026-10-09-103000.xlsx');

        $archive = new ZipArchive;
        $this->assertTrue($archive->open($response->baseResponse->getFile()->getPathname()));
        $worksheet = $archive->getFromName('xl/worksheets/sheet1.xml');
        $archive->close();

        $this->assertIsString($worksheet);
        $this->assertStringContainsString('Nguyễn Văn Có Trong File', $worksheet);
        $this->assertStringNotContainsString('Người Không Thuộc Bộ Lọc', $worksheet);
        $this->assertStringContainsString('Tham dự tiệc tối', $worksheet);
        $this->assertStringNotContainsString('Trạng thái thanh toán', $worksheet);
        $this->assertStringNotContainsString('Giấy tờ định danh', $worksheet);
        $this->assertSame(18, substr_count($worksheet, '<c '));
    }

    public function test_guest_is_redirected_when_exporting_registrations(): void
    {
        $response = $this->get('/admin/registrations-export');

        $response->assertRedirectToRoute('admin.login');
    }

    /**
     * @param  array<string, mixed>  $overrides
     * @return array<string, mixed>
     */
    private function registrationAttributes(array $overrides = []): array
    {
        return array_merge([
            'delegate_id' => 'VDUH26-DEL-0001',
            'category' => 'independent_delegate',
            'full_name' => 'Nguyễn Văn A',
            'email' => 'delegate@example.com',
            'phone' => '0900000000',
            'payment_status' => 'paid',
            'qr_code_token' => 'qr-token-0001',
        ], $overrides);
    }
}
