<?php

namespace Database\Seeders;

use App\Models\Language;
use Illuminate\Database\Seeder;

class LanguageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Language::create(['name' => 'English']);
        Language::create(['name' => 'Afrikaans']);
        Language::create(['name' => 'Mandarin Chinese']);
        Language::create(['name' => 'Spanish']);
        Language::create(['name' => 'Arabic']);
        Language::create(['name' => 'Malay']);
        Language::create(['name' => 'Russian']);
        Language::create(['name' => 'Bengali']);
        Language::create(['name' => 'Portuguese']);
        Language::create(['name' => 'French']);
        Language::create(['name' => 'Hausa']);
        Language::create(['name' => 'Punjabi']);
        Language::create(['name' => 'German']);
        Language::create(['name' => 'Japanese']);
        Language::create(['name' => 'Persian']);
        Language::create(['name' => 'Swahili']);
        Language::create(['name' => 'Vietnamese ']);
        Language::create(['name' => 'Italian']);
        Language::create(['name' => 'Korean']);
        Language::create(['name' => 'Chinese']);
        Language::create(['name' => 'Venda']);
        Language::create(['name' => 'Tsonga']);
        Language::create(['name' => 'Swati']);
        Language::create(['name' => 'Xhosa']);
        Language::create(['name' => 'Tswana']);
        Language::create(['name' => 'Ndebele']);
        Language::create(['name' => 'Zulu']);
        Language::create(['name' => 'Northern Sotho']);
        Language::create(['name' => 'Southern Sotho']);
    }
}
