<?php

namespace Tests\Feature;

use App\Mail\RegistrationConfirmed;
use App\Models\Registration;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Mail;
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
        $home->assertSee('Sơ đồ phòng họp');
        $home->assertSee('PHÒNG 210');
        $home->assertSee('IDMED');
        $home->assertSee('Cổng Vàng');
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
        $pages = ['committees', 'layout', 'fees', 'guidelines', 'abstract', 'travel'];
        foreach ($pages as $page) {
            $response = $this->get("/vi/{$page}");
            $response->assertStatus(200);
            $response->assertSee('Đang cập nhật');
        }
    }

    public function test_sponsorship_page_displays_sponsor_logos(): void
    {
        $response = $this->get('/vi/sponsorship');
        $response->assertStatus(200);
        $response->assertSee('Kim cương');
        $response->assertSee('Bạch kim');
        $response->assertSee('Đồng tài trợ');
        $response->assertSee('Astellas');
        $response->assertSee('Xem bài đăng Astellas');
        $response->assertSee('Novartis');
        $response->assertSee('Pfizer');
        $response->assertSee('Xem bài đăng');
        $response->assertSee('sponsor-posts', false);
        $response->assertDontSee('Medtronic Vietnam');

        $home = $this->get('/vi');
        $home->assertSee('Astellas');
        $home->assertSee('Đồng tài trợ');
    }

    public function test_speakers_page_displays_chairs_and_speakers_directory(): void
    {
        $response = $this->get('/vi/speakers');
        $response->assertStatus(200);
        $response->assertSee('Chủ toạ & Báo cáo viên');
        $response->assertSee('Dương Đức Hùng');
        $response->assertSee('Kwang-Woong Lee');

        $responseChairs = $this->get('/vi/chairs-speakers');
        $responseChairs->assertStatus(200);
        $responseChairs->assertSee('Chủ toạ & Báo cáo viên');
    }

    public function test_program_page_displays_scientific_program(): void
    {
        $response = $this->get('/vi/program');
        $response->assertStatus(200);
        $response->assertSee('Chương trình chi tiết song ngữ');
        $response->assertSee('Bilingual Detailed Program');
        $response->assertSee('PHÒNG KHÁNH TIẾT');
        $response->assertSee('BANQUET HALL');
        $response->assertDontSee('PHÒNG KHÁNH TIẾTBANQUET HALL');
        $response->assertDontSee('Khung thời gian tổng thể');
        $response->assertSee('Assoc. Prof. Le Tu Hoang');
        $response->assertSee('Outcomes of Oblique Lateral Interbody Fusion (OLIF) in lumbar spine disease treatment');
        $response->assertDontSee('Hoàng Mạnh Huy');
        $response->assertSee('Viet Duc University Hospital: 120 years of formation and development');
    }

    public function test_registration_submission_with_doc_fields(): void
    {
        $this->travelTo(Carbon::parse('2026-11-18T11:59:59+07:00'));
        Mail::fake();
        config(['mail.always_cc' => 'dh.qt2@hoabinh-group.com']);

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
        $this->assertSame('sent', $reg->email_status);
        $response->assertRedirect("/vi/register?success=1&id={$reg->delegate_id}&token={$reg->qr_code_token}");

        Mail::assertSent(RegistrationConfirmed::class, function (RegistrationConfirmed $mail) use ($reg) {
            return $mail->hasTo('bacsitest@example.com')
                && $mail->hasCc('dh.qt2@hoabinh-group.com')
                && $mail->registration->is($reg);
        });
    }

    public function test_english_urls_redirect_to_vietnamese(): void
    {
        $this->get('/')->assertRedirect('/vi');
        $this->get('/en')->assertRedirect('/vi');
        $this->get('/en/about')->assertRedirect('/vi/about');

        $this->get('/vi')->assertDontSee('>EN<');
    }

    public function test_registration_form_is_available_before_noon_in_vietnam(): void
    {
        $this->travelTo(Carbon::parse('2026-11-18T04:59:59Z'));

        $this->get('/vi/register')
            ->assertOk()
            ->assertSee('id="register-form"', false)
            ->assertDontSee('Đã đóng đăng ký');
    }

    public function test_registration_closes_at_noon_in_vietnam_and_stays_closed(): void
    {
        Mail::fake();

        foreach (['2026-11-18T05:00:00Z', '2026-11-19T05:00:00Z'] as $time) {
            $this->travelTo(Carbon::parse($time));

            $this->get('/vi/register')
                ->assertOk()
                ->assertSee('Đã đóng đăng ký')
                ->assertDontSee('id="register-form"', false);

            $this->post('/vi/register?success=1&id=forged', [
                'full_name' => 'Nguyễn Văn Test',
                'gender' => 'male',
                'email' => 'late@example.com',
                'phone' => '0912345678',
            ])->assertForbidden()
                ->assertSee('Đã đóng đăng ký')
                ->assertDontSee('Đăng ký thành công!');
        }

        $this->assertDatabaseCount('registrations', 0);
        Mail::assertNothingSent();
    }

    public function test_registration_confirmation_remains_visible_after_closing(): void
    {
        $this->travelTo(Carbon::parse('2026-11-18T12:00:00+07:00'));

        $this->get('/vi/register?success=1&id=VDUH26-TEST')
            ->assertSee('Đăng ký thành công!')
            ->assertDontSee('Đăng ký thêm đại biểu khác')
            ->assertDontSee('id="register-form"', false);
    }
}
