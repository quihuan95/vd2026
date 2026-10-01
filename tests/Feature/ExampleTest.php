<?php

namespace Tests\Feature;

use App\Models\Registration;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    use RefreshDatabase;

    public function test_the_application_returns_a_successful_response(): void
    {
        $response = $this->get('/');
        $response->assertRedirect('/vi');

        $home = $this->get('/vi');
        $home->assertStatus(200);
        $home->assertSee('Hội nghị Khoa học Quốc tế Bệnh viện Hữu nghị Việt Đức 2026');
    }

    public function test_welcome_letter_page_displays_director_message(): void
    {
        $response = $this->get('/vi/about');
        $response->assertStatus(200);
        $response->assertSee('PGS. TS. Dương Đức Hùng');
        $response->assertSee('19 tháng 11 năm 2026');
    }

    public function test_venue_page_displays_ncc(): void
    {
        $response = $this->get('/vi/venue');
        $response->assertStatus(200);
        $response->assertSee('Trung tâm Hội nghị Quốc gia');
        $response->assertSee('Đang cập nhật');
    }

    public function test_faq_page_displays_exact_items(): void
    {
        $response = $this->get('/vi/faq');
        $response->assertStatus(200);
        $response->assertSee('Hội nghị sẽ chỉ được tổ chức dưới hình thức trực tiếp');
        $response->assertSee('CME (3 giờ tín chỉ)');
    }

    public function test_contact_page_displays_exact_secretariat(): void
    {
        $response = $this->get('/vi/contact');
        $response->assertStatus(200);
        $response->assertSee('eventvietduc@vduh.org');
        $response->assertSee('TS. Bùi Mai Anh');
        $response->assertSee('TS. Bùi Trung Nghĩa');
        $response->assertSee('Bà Phạm Bích Vân');
    }

    public function test_updating_pages_display_updating_component(): void
    {
        $pages = ['program', 'speakers', 'committees', 'sponsorship', 'layout', 'fees', 'guidelines', 'abstract', 'travel'];
        foreach ($pages as $page) {
            $response = $this->get("/vi/{$page}");
            $response->assertStatus(200);
            $response->assertSee('Đang cập nhật');
        }
    }

    public function test_registration_submission_with_doc_fields(): void
    {
        $response = $this->post('/vi/register', [
            'full_name' => 'Nguyễn Văn Test',
            'gender' => 'male',
            'dob' => '1985-05-15',
            'organization' => 'Bệnh viện Hữu nghị Việt Đức',
            'department' => 'Khoa Phẫu thuật Tim mạch',
            'job_title' => 'Bác sĩ phẫu thuật',
            'email' => 'bacsitest@example.com',
            'phone' => '0912345678',
            'attend_dinner' => '1',
        ]);

        $this->assertDatabaseHas('registrations', [
            'full_name' => 'Nguyễn Văn Test',
            'email' => 'bacsitest@example.com',
            'phone' => '0912345678',
            'attend_dinner' => 1,
        ]);

        $reg = Registration::where('email', 'bacsitest@example.com')->first();
        $this->assertNotNull($reg);
        $response->assertRedirect("/vi/register?success=1&id={$reg->delegate_id}&token={$reg->qr_code_token}");
    }

    public function test_english_locale_pages(): void
    {
        $response = $this->get('/en');
        $response->assertStatus(200);
        $response->assertSee('Viet Duc University Hospital');

        $responseAbout = $this->get('/en/about');
        $responseAbout->assertStatus(200);
        $responseAbout->assertSee('Assoc. Prof. Duong Duc Hung');
    }
}
