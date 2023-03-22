<?php

use Illuminate\Database\Seeder;
use App\Models\Api\Admin\Language;

class LanguageTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $file = base_path('languages.json');
        // $languages = json_decode(file_get_contents($file), true);

        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('languages')->truncate();

        $languages = 
        [
            [   
            'code' =>  'en',
            'name' =>     'English',
            'native_name'=> 'English',
            'status'=> 'active',
            'created_at'   =>  date('Y-m-d H:i:s'),
            'updated_at'   =>  date('Y-m-d H:i:s'),
            ],
            [   
            'code' =>  'ht',
            'name' =>     'Haitian Creole',
            'native_name'=> 'Kreyòl ayisyen',
            'status'=> 'active',
            'created_at'   =>  date('Y-m-d H:i:s'),
            'updated_at'   =>  date('Y-m-d H:i:s'),
            ],
            [   
            'code' =>  'fr',
            'name' =>     'French',
            'native_name'=> 'français, langue française',
            'status'=> 'active',
            'created_at'   =>  date('Y-m-d H:i:s'),
            'updated_at'   =>  date('Y-m-d H:i:s'),
            ],
            [   
            'code' =>  'es',
            'name' =>     'Spanish',
            'native_name'=> 'español, castellano',
            'status'=> 'active',
            'created_at'   =>  date('Y-m-d H:i:s'),
            'updated_at'   =>  date('Y-m-d H:i:s'),
            ],
            [   
            'code' =>  'de',
            'name' =>     'German',
            'native_name'=> 'Deutsch',
            'status'=> 'active',
            'created_at'   =>  date('Y-m-d H:i:s'),
            'updated_at'   =>  date('Y-m-d H:i:s'),
            ],
            [   
            'code' =>  'zh',
            'name' =>     'Chinese(Mandarin)',
            'native_name'=> '中文 (Zhōngwén), 汉语, 漢語',
            'status'=> 'active',
            'created_at'   =>  date('Y-m-d H:i:s'),
            'updated_at'   =>  date('Y-m-d H:i:s'),
            ],
            [   
            'code' =>  'hi',
            'name' =>     'Hindi',
            'native_name'=> 'हिन्दी, हिंदी',
            'status'=> 'active',
            'created_at'   =>  date('Y-m-d H:i:s'),
            'updated_at'   =>  date('Y-m-d H:i:s'),
            ],
            [   
            'code' =>  'it',
            'name' =>     'Italian',
            'native_name'=> 'Italiano',
            'status'=> 'active',
            'created_at'   =>  date('Y-m-d H:i:s'),
            'updated_at'   =>  date('Y-m-d H:i:s'),
            ],
            [   
            'code' =>  'el',
            'name' =>     'Greek',
            'native_name'=> 'Ελληνικά',
            'status'=> 'active',
            'created_at'   =>  date('Y-m-d H:i:s'),
            'updated_at'   =>  date('Y-m-d H:i:s'),
            ],
            [   
            'code' =>  'ar',
            'name' =>     'Arabic',
            'native_name'=> 'العربية',
            'status'=> 'active',
            'created_at'   =>  date('Y-m-d H:i:s'),
            'updated_at'   =>  date('Y-m-d H:i:s'),
            ],
        ];
        
        DB::table('languages')->insert($languages);

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        
    }
}
