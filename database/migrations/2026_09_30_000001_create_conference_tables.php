<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (!Schema::hasTable('registrations')) {
            Schema::create('registrations', function (Blueprint $table) {
                $table->id();
                $table->string('delegate_id', 32)->unique();
                $table->string('category', 50)->default('independent_delegate'); // invited_speaker | independent_delegate | vduh_staff | vip
                $table->string('academic_title', 50)->nullable(); // GS, PGS, TS, BSCKII, BSCKI, ThS, BS, etc.
                $table->string('full_name');
                $table->string('gender', 20)->nullable(); // male | female | other
                $table->date('dob')->nullable();
                $table->string('organization')->nullable();
                $table->string('department')->nullable();
                $table->string('job_title')->nullable();
                $table->string('email');
                $table->string('phone', 50);
                $table->string('country', 16)->default('VN');
                $table->string('professional_title', 50)->nullable(); // member | non_member | student
                $table->boolean('attend_dinner')->default(false);
                $table->boolean('request_cme')->default(false);
                $table->string('cme_id_number', 50)->nullable();
                $table->string('form_language', 10)->default('vi');
                $table->string('payment_method', 50)->default('wire_transfer'); // wire_transfer | complimentary
                $table->string('payment_status', 50)->default('pending_verification'); // pending_verification | paid | complimentary | cancelled
                $table->decimal('amount_vnd', 12, 2)->default(0);
                $table->string('identity_path')->nullable();
                $table->string('payment_proof_path')->nullable();
                $table->string('qr_code_token', 64)->nullable()->unique();
                $table->timestamp('checked_in_at')->nullable();
                $table->string('email_status', 20)->default('pending');
                $table->timestamp('email_sent_at')->nullable();
                $table->timestamp('paid_at')->nullable();
                $table->text('notes')->nullable();
                $table->timestamps();
            });
        }

        if (!Schema::hasTable('abstract_submissions')) {
            Schema::create('abstract_submissions', function (Blueprint $table) {
                $table->id();
                $table->string('abstract_id', 32)->unique();
                $table->string('specialty', 50); // OBG, MAT, REP, SUR, ORT, GAS, CVS, NEU, URO, PHA, DIA, ANE, END, PLA, PED, INF, NUR, EME, OTH
                $table->string('track_other')->nullable();
                $table->string('title', 500);
                $table->text('authors');
                $table->string('presenter_name')->nullable();
                $table->string('email');
                $table->string('phone', 50);
                $table->string('country', 16)->default('VN');
                $table->string('institution')->nullable();
                $table->string('submission_type', 50)->default('research'); // research | case_report | review | poster
                $table->string('presentation_type', 50)->default('either'); // oral | poster | either
                $table->string('file_path')->nullable();
                $table->string('form_language', 10)->default('vi');
                $table->string('review_status', 50)->default('submitted'); // submitted | under_review | accepted | revision_requested | rejected
                $table->text('review_notes')->nullable();
                $table->string('email_status', 20)->default('pending');
                $table->timestamp('email_sent_at')->nullable();
                $table->timestamps();
            });
        }

        if (!Schema::hasTable('speakers')) {
            Schema::create('speakers', function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->string('title')->nullable();
                $table->string('affiliation')->nullable();
                $table->string('topic', 500)->nullable();
                $table->string('session_time', 100)->nullable();
                $table->text('bio_en')->nullable();
                $table->text('bio_vi')->nullable();
                $table->string('photo_path')->nullable();
                $table->integer('sort_order')->default(0);
                $table->boolean('is_published')->default(true);
                $table->timestamps();
            });
        }

        if (!Schema::hasTable('settings')) {
            Schema::create('settings', function (Blueprint $table) {
                $table->id();
                $table->string('key', 100)->unique();
                $table->text('value')->nullable();
                $table->string('group', 50)->default('general');
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
        Schema::dropIfExists('speakers');
        Schema::dropIfExists('abstract_submissions');
        Schema::dropIfExists('registrations');
    }
};
