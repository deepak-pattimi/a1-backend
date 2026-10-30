<?php

namespace Tests\Feature;

use App\Http\Controllers\Api\AppointmentController;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

require_once __DIR__ . '/../CreatesApplication.php';
require_once __DIR__ . '/../TestCase.php';

class DashboardPerformanceTest extends TestCase
{
    public function test_totals_use_one_read_and_preserve_records()
    {
        // Explicit isolated connection: never migrate or write the configured SQL database.
        config(['database.connections.performance_test' => [
            'driver' => 'sqlite', 'database' => ':memory:', 'prefix' => '',
        ], 'database.default' => 'performance_test']);
        $db = DB::connection('performance_test');
        $db->getSchemaBuilder()->create('appointments', function (Blueprint $table) {
            $table->increments('id');
            $table->string('status')->nullable();
            $table->string('payment_method')->nullable();
            $table->string('payment_status')->nullable();
            $table->decimal('amount', 10, 2)->nullable();
        });

        $controller = new AppointmentController();
        $this->assertSame([
            'totalAppointments' => 0, 'pendingAppointments' => 0,
            'onlinePayments' => 0, 'offlinePayments' => 0,
        ], $controller->getDashboardStats()->getData(true));

        $db->table('appointments')->insert([
            ['status' => 'confirmed', 'payment_method' => 'online', 'payment_status' => 'completed', 'amount' => 120.25],
            ['status' => 'pending', 'payment_method' => 'offline', 'payment_status' => 'completed', 'amount' => 40.50],
            ['status' => 'pending', 'payment_method' => 'online', 'payment_status' => 'failed', 'amount' => 999],
            ['status' => null, 'payment_method' => null, 'payment_status' => null, 'amount' => null],
        ]);
        $before = $db->table('appointments')->get()->toJson();
        $db->enableQueryLog();
        $db->flushQueryLog();
        $response = $controller->getDashboardStats();
        $this->assertCount(1, $db->getQueryLog());
        $this->assertSame(200, $response->getStatusCode());
        $this->assertSame([
            'totalAppointments' => 4, 'pendingAppointments' => 2,
            'onlinePayments' => 120.25, 'offlinePayments' => 40.5,
        ], $response->getData(true));
        $this->assertSame($before, $db->table('appointments')->get()->toJson());
    }
}
