<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class AdminSettingsController extends Controller
{
    /**
     * Display the settings page.
     */
    public function index()
    {
        return view('admin.settings');
    }

    /**
     * Update the settings.
     */
    public function update(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'opening_time' => 'required|date_format:H:i',
            'closing_time' => 'required|date_format:H:i|after:opening_time',
            'slot_duration' => 'required|integer|in:15,30,45,60'
        ], [
            'opening_time.required' => 'Jam buka harus diisi',
            'opening_time.date_format' => 'Format jam buka tidak valid',
            'closing_time.required' => 'Jam berakhir harus diisi',
            'closing_time.date_format' => 'Format jam berakhir tidak valid',
            'closing_time.after' => 'Jam berakhir harus lebih besar dari jam buka',
            'slot_duration.required' => 'Durasi slot harus diisi',
            'slot_duration.in' => 'Durasi slot tidak valid'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()->first()
            ], 422);
        }

        try {
            // Update configuration file
            $this->updateConfigFile([
                'opening_time' => $request->opening_time,
                'closing_time' => $request->closing_time,
                'slot_duration' => $request->slot_duration
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Pengaturan berhasil disimpan!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menyimpan pengaturan'
            ], 500);
        }
    }

    /**
     * Update the configuration file.
     */
    private function updateConfigFile($settings)
    {
        $configPath = config_path('booking.php');
        
        // Create config file if it doesn't exist
        if (!File::exists($configPath)) {
            $defaultConfig = "<?php\n\nreturn [\n";
            $defaultConfig .= "    'opening_time' => '09:00',\n";
            $defaultConfig .= "    'closing_time' => '17:00',\n";
            $defaultConfig .= "    'slot_duration' => 30,\n";
            $defaultConfig .= "];\n";
            File::put($configPath, $defaultConfig);
        }

        // Read current config
        $currentConfig = include $configPath;
        
        // Update settings
        $updatedConfig = array_merge($currentConfig, $settings);
        
        // Write new config
        $configContent = "<?php\n\nreturn [\n";
        foreach ($updatedConfig as $key => $value) {
            if (is_string($value)) {
                $configContent .= "    '{$key}' => '{$value}',\n";
            } else {
                $configContent .= "    '{$key}' => {$value},\n";
            }
        }
        $configContent .= "];\n";
        
        File::put($configPath, $configContent);
        
        // Clear configuration cache
        if (function_exists('opcache_reset')) {
            opcache_reset();
        }
    }
}
