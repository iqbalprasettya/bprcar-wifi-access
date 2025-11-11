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
        Schema::create('hotspot_logs', function (Blueprint $table) {
            $table->id();

            // User Information
            $table->string('username', 100)->index();
            $table->string('mac_address', 17)->nullable()->index();
            $table->string('ip_address', 45)->index(); // Support IPv4 & IPv6

            // Action Information
            $table->enum('action', [
                'login_attempt',
                'login_success',
                'login_failed',
                'logout',
                'kicked',
                'session_timeout',
                'view_dashboard'
            ])->index();

            // Session Information
            $table->string('session_id', 100)->nullable();
            $table->timestamp('session_start')->nullable();
            $table->timestamp('session_end')->nullable();
            $table->integer('session_duration')->nullable()->comment('Duration in seconds');

            // Network Information
            $table->string('user_agent', 500)->nullable();
            $table->string('device_type', 50)->nullable(); // mobile, desktop, tablet
            $table->string('browser', 100)->nullable();
            $table->string('platform', 100)->nullable(); // Windows, Android, iOS, etc

            // Traffic Information (from MikroTik)
            $table->bigInteger('bytes_in')->default(0)->comment('Download bytes');
            $table->bigInteger('bytes_out')->default(0)->comment('Upload bytes');
            $table->bigInteger('packets_in')->default(0);
            $table->bigInteger('packets_out')->default(0);

            // Additional Information
            $table->string('destination_url', 500)->nullable();
            $table->text('error_message')->nullable();
            $table->enum('status', ['success', 'failed', 'pending'])->default('pending');
            $table->json('metadata')->nullable()->comment('Additional data from MikroTik');

            // Timestamps
            $table->timestamps();

            // Indexes for better query performance
            $table->index(['username', 'action', 'created_at']);
            $table->index(['created_at']);
            $table->index(['status']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hotspot_logs');
    }
};
