<?php
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\GeneralSetting;

$setting = GeneralSetting::first();
if ($setting) {
    $setting->title = 'Best Laparoscopic, bariatric, Laser surgery hospital in Vizag';
    $setting->meta_description = 'A1 Laparoscopy Hospital offers advanced laparoscopic surgery, bariatric surgery, hernia repair, gallbladder surgery, laser piles treatment and laparoscopic hysterectomy in Visakhapatnam. Book a consultation today.';
    $setting->save();
    echo "Settings updated successfully.\n";
} else {
    echo "General setting not found.\n";
}
