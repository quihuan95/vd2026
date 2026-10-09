<?php

namespace Tests\Feature;

use Tests\TestCase;

class AdminAuthenticationTest extends TestCase
{
    public function test_unauthenticated_admin_request_redirects_to_admin_login(): void
    {
        $response = $this->get('/admin');

        $response->assertRedirectToRoute('admin.login');
    }

    public function test_removed_admin_modules_are_not_accessible(): void
    {
        $this->get('/admin/abstracts')->assertNotFound();
        $this->get('/admin/speakers')->assertNotFound();
    }
}
