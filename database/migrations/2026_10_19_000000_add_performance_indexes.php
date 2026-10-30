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
        // Add indexes to banners
        if (Schema::hasTable('banners')) {
            Schema::table('banners', function (Blueprint $table) {
                $table->index(['active', 'order_position'], 'banners_active_order_idx');
            });
        }

        // Add indexes to blogs
        if (Schema::hasTable('blogs')) {
            Schema::table('blogs', function (Blueprint $table) {
                if (!Schema::hasIndex('blogs', 'blogs_slug_idx')) {
                    $table->index('slug', 'blogs_slug_idx');
                }
                $table->index(['status', 'created_at'], 'blogs_status_created_idx');
            });
        }

        // Add indexes to pages
        if (Schema::hasTable('pages')) {
            Schema::table('pages', function (Blueprint $table) {
                $table->index('category_id', 'pages_category_id_idx');
            });
        }

        // Add indexes to category
        if (Schema::hasTable('category')) {
            Schema::table('category', function (Blueprint $table) {
                $table->index('order_no', 'category_order_no_idx');
            });
        }

        // Add indexes to specialized
        if (Schema::hasTable('specialized')) {
            Schema::table('specialized', function (Blueprint $table) {
                if (Schema::hasColumn('specialized', 'order_position')) {
                    $table->index('order_position', 'specialized_order_position_idx');
                }
            });
        }

        // Add indexes to depratments
        if (Schema::hasTable('depratments')) {
            Schema::table('depratments', function (Blueprint $table) {
                if (Schema::hasColumn('depratments', 'order_position')) {
                    $table->index('order_position', 'depratments_order_position_idx');
                }
            });
        }

        // Add indexes to testimonials
        if (Schema::hasTable('testimonials')) {
            Schema::table('testimonials', function (Blueprint $table) {
                $table->index('status', 'testimonials_status_idx');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasTable('banners')) {
            Schema::table('banners', function (Blueprint $table) {
                $table->dropIndex('banners_active_order_idx');
            });
        }

        if (Schema::hasTable('blogs')) {
            Schema::table('blogs', function (Blueprint $table) {
                $table->dropIndex('blogs_slug_idx');
                $table->dropIndex('blogs_status_created_idx');
            });
        }

        if (Schema::hasTable('pages')) {
            Schema::table('pages', function (Blueprint $table) {
                $table->dropIndex('pages_category_id_idx');
            });
        }

        if (Schema::hasTable('category')) {
            Schema::table('category', function (Blueprint $table) {
                $table->dropIndex('category_order_no_idx');
            });
        }

        if (Schema::hasTable('specialized')) {
            Schema::table('specialized', function (Blueprint $table) {
                if (Schema::hasColumn('specialized', 'order_position')) {
                    $table->dropIndex('specialized_order_position_idx');
                }
            });
        }

        if (Schema::hasTable('depratments')) {
            Schema::table('depratments', function (Blueprint $table) {
                if (Schema::hasColumn('depratments', 'order_position')) {
                    $table->dropIndex('depratments_order_position_idx');
                }
            });
        }

        if (Schema::hasTable('testimonials')) {
            Schema::table('testimonials', function (Blueprint $table) {
                $table->dropIndex('testimonials_status_idx');
            });
        }
    }
};
