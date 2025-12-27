<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Modify enum to include 'user' and set default to 'user'
        DB::statement("
            ALTER TABLE users 
            MODIFY role ENUM('user', 'admin', 'employee') 
            DEFAULT 'user'
        ");
    }

    public function down(): void
    {
        // Revert back to previous enum
        DB::statement("
            ALTER TABLE users 
            MODIFY role ENUM('admin', 'employee') 
            DEFAULT 'employee'
        ");
    }
};
