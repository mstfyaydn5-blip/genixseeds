<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingsSeeder extends Seeder
{
    public function run(): void
    {
        // Copy the real Genix Seeds logo + favicon into public storage
        $srcDir = database_path('seed-images/branding');
        $destDir = storage_path('app/public/branding');
        if (\Illuminate\Support\Facades\File::isDirectory($srcDir)) {
            \Illuminate\Support\Facades\File::ensureDirectoryExists($destDir);
            \Illuminate\Support\Facades\File::copyDirectory($srcDir, $destDir);
        }

        $settings = [
            ['key' => 'logo', 'value' => 'branding/logo.png', 'group' => 'general'],
            ['key' => 'favicon', 'value' => 'branding/favicon.png', 'group' => 'general'],
            ['key' => 'site_name_en', 'value' => 'Genix Seeds', 'group' => 'general'],
            ['key' => 'site_name_ar', 'value' => 'جينكس سيدز', 'group' => 'general'],
            ['key' => 'tagline_en', 'value' => 'High Quality Vegetable Seeds', 'group' => 'general'],
            ['key' => 'tagline_ar', 'value' => 'بذور خضروات عالية الجودة', 'group' => 'general'],
            ['key' => 'phone', 'value' => '+1 (555) 123-4567', 'group' => 'general'],
            ['key' => 'email', 'value' => 'info@genixseeds.example', 'group' => 'general'],
            ['key' => 'address_en', 'value' => '123 Farmland Avenue, Green Valley', 'group' => 'general'],
            ['key' => 'address_ar', 'value' => '123 شارع المزارع، الوادي الأخضر', 'group' => 'general'],
            ['key' => 'facebook', 'value' => 'https://facebook.com/genixseeds', 'group' => 'general'],
            ['key' => 'twitter', 'value' => 'https://twitter.com/genixseeds', 'group' => 'general'],
            ['key' => 'instagram', 'value' => 'https://instagram.com/genixseeds', 'group' => 'general'],
            ['key' => 'linkedin', 'value' => 'https://linkedin.com', 'group' => 'general'],
            ['key' => 'meta_title_en', 'value' => 'Genix Seeds | Wholesale Vegetable Seed Breeder & Producer', 'group' => 'seo'],
            ['key' => 'meta_title_ar', 'value' => 'جينكس سيدز | تربية وإنتاج بذور الخضروات بالجملة', 'group' => 'seo'],
            ['key' => 'meta_description_en', 'value' => 'Genix Seeds is a wholesale vegetable seed breeder and producer, supplying high quality hybrid seed varieties to growers and distributors worldwide.', 'group' => 'seo'],
            ['key' => 'meta_description_ar', 'value' => 'جينكس سيدز شركة متخصصة في تربية وإنتاج بذور الخضروات بالجملة، توفر أصنافاً هجينة عالية الجودة للمزارعين والموزعين حول العالم.', 'group' => 'seo'],
        ];

        foreach ($settings as $s) {
            Setting::updateOrCreate(['key' => $s['key']], $s);
        }
    }
}
