<?php
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use App\Models\AppointmentDisease;

if (!Schema::hasTable('appointment_diseases')) {
    Schema::create('appointment_diseases', function (Blueprint $table) {
        $table->id();
        $table->string('name');
        $table->boolean('status')->default(true);
        $table->timestamps();
    });
    echo "Table 'appointment_diseases' created.\n";

    // Insert some default diseases to match what they currently have.
    $defaultDiseases = [
        'laparoscopic_surgery' => 'Laparoscopic Surgery',
        'hernia_repair' => 'Hernia Repair',
        'gallbladder_surgery' => 'Gallbladder Surgery',
        'bariatric_surgery' => 'Bariatric Surgery',
        'appendicitis' => 'Appendicitis',
        'laser_piles' => 'Laser Piles Treatment',
        'fistula_fissure' => 'Fistula & Fissure',
        'gastrointestinal' => 'Gastrointestinal Issues',
        'general_surgery' => 'General Surgery'
    ];

    foreach ($defaultDiseases as $key => $value) {
        AppointmentDisease::create(['name' => $value, 'status' => 1]);
    }
    echo "Default diseases inserted.\n";

} else {
    echo "Table 'appointment_diseases' already exists.\n";
}
