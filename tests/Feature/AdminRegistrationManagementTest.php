<?php

namespace Tests\Feature;

use App\Models\Registration;
use App\Models\User;
use Illuminate\Foundation\Testing\LazilyRefreshDatabase;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class AdminRegistrationManagementTest extends TestCase
{
    use LazilyRefreshDatabase;

    public function test_admin_can_delete_registration_and_its_uploaded_files(): void
    {
        Storage::fake('public');
        Storage::disk('public')->put('registrations/identity.pdf', 'identity');
        Storage::disk('public')->put('registrations/payment.jpg', 'payment');
        $admin = User::factory()->create();
        $registration = Registration::create($this->registrationAttributes([
            'identity_path' => 'registrations/identity.pdf',
            'payment_proof_path' => 'registrations/payment.jpg',
        ]));

        $response = $this->actingAs($admin)->delete(route('admin.registrations.destroy', $registration));

        $response->assertRedirectToRoute('admin.registrations');
        $response->assertSessionHas('success', 'Đã xóa đại biểu VDUH26-DEL-0001.');
        $this->assertModelMissing($registration);
        Storage::disk('public')->assertMissing('registrations/identity.pdf');
        Storage::disk('public')->assertMissing('registrations/payment.jpg');
    }

    public function test_guest_cannot_delete_registration(): void
    {
        $registration = Registration::create($this->registrationAttributes());

        $response = $this->delete(route('admin.registrations.destroy', $registration));

        $response->assertRedirectToRoute('admin.login');
        $this->assertModelExists($registration);
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
