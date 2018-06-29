<?php

use Handytravelers\Components\Users\Models\Language;
use Illuminate\Database\Seeder;

class LanguagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Language::insert([
            ['title' =>'العربية', 'iso639code' =>'ar'],
            ['title' =>'سنڌي', 'iso639code' =>'sd'],
            ['title' =>'Azərbaycanca', 'iso639code' =>'az'],
            ['title' =>'Български', 'iso639code' =>'bg'],
            ['title' =>'Bahasa Banjar', 'iso639code' =>'bj'],
            ['title' =>'বাংলা', 'iso639code' =>'bn'],
            ['title' =>'Català', 'iso639code' =>'ca'],
            ['title' =>'Česky', 'iso639code' =>'cs'],
            ['title' =>'Словѣ́ньскъ', 'iso639code' =>'cu'],
            ['title' =>'Deutsch', 'iso639code' =>'de'],
            ['title' =>'Ελληνικά', 'iso639code' =>'el'],
            ['title' =>'English', 'iso639code' =>'en'],
            ['title' =>'Esperanto', 'iso639code' =>'eo'],
            ['title' =>'Español', 'iso639code' =>'es'],
            ['title' =>'فارسی', 'iso639code' =>'fa'],
            ['title' =>'Suomi', 'iso639code' =>'fi'],
            ['title' =>'Français', 'iso639code' =>'fr'],
            ['title' =>'ગુજરાતી', 'iso639code' =>'gu'],
            ['title' =>'עברית', 'iso639code' =>'he'],
            ['title' =>'हिन्दी', 'iso639code' =>'hi'],
            ['title' =>'Հայերեն', 'iso639code' =>'hy'],
            ['title' =>'Bahasa Indonesia', 'iso639code' =>'id'],
            ['title' =>'मराठी', 'iso639code' =>'mr'],
            ['title' =>'Italiano', 'iso639code' =>'it'],
            ['title' =>'日本語', 'iso639code' =>'ja'],
            ['title' =>'Basa Jawa', 'iso639code' =>'jv'],
            ['title' =>'ქართული', 'iso639code' =>'ka'],
            ['title' =>'한국어', 'iso639code' =>'ko'],
            ['title' =>'Latviešu', 'iso639code' =>'lv'],
            ['title' =>'Lietuvių', 'iso639code' =>'lt'],
            ['title' =>'Magyar', 'iso639code' =>'hu'],
            ['title' =>'Bahasa Melayu', 'iso639code' =>'ms'],
            ['title' =>'Македонски', 'iso639code' =>'mk'],
            ['title' =>'مازِرونی', 'iso639code' =>'mz'],
            ['title' =>'नेपाल भाषा', 'iso639code' =>'ne'],
            ['title' =>'नेपाली', 'iso639code' =>'ne'],
            ['title' =>'ਪੰਜਾਬੀ', 'iso639code' =>'pa'],
            ['title' =>'Polski', 'iso639code' =>'pl'],
            ['title' =>'پښتو', 'iso639code' =>'ps'],
            ['title' =>'Português', 'iso639code' =>'pt'],
            ['title' =>'Română', 'iso639code' =>'ro'],
            ['title' =>'Русский', 'iso639code' =>'ru'],
            ['title' =>'Svenska', 'iso639code' =>'sv'],
            ['title' =>'தமிழ்', 'iso639code' =>'ta'],
            ['title' =>'ไทย', 'iso639code' =>'th'],
            ['title' =>'Türkçe', 'iso639code' =>'tr'],
            ['title' =>'Українська', 'iso639code' =>'uk'],
            ['title' =>'Tiếng Việt', 'iso639code' =>'vi'],
            ['title' =>'Yorùbá', 'iso639code' =>'yo'],
            ['title' =>'中文', 'iso639code' =>'zh']
        ]);

    }
}
