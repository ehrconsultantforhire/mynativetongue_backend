<?php

use Illuminate\Database\Seeder;

class WordTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('words')->truncate();

        $words = 
        [
            [   
                'plan_id' => 1,
                'language_id' => 3,
                'word'=> 'maison',
                'status'=> 'active',
                'created_at'   =>  date('Y-m-d H:i:s'),
            ],[   
                'plan_id' => 1,
                'language_id' => 3,
                'word'=> 'salle',
                'status'=> 'active',
                'created_at'   =>  date('Y-m-d H:i:s'),
            ],[   
                'plan_id' => 1,
                'language_id' => 3,
                'word'=> 'cuisine',
                'status'=> 'active',
                'created_at'   =>  date('Y-m-d H:i:s'),
            ],[   
                'plan_id' => 1,
                'language_id' => 3,
                'word'=> 'salle à manger',
                'status'=> 'active',
                'created_at'   =>  date('Y-m-d H:i:s'),
            ],[   
                'plan_id' => 1,
                'language_id' => 3,
                'word'=> 'bureau',
                'status'=> 'active',
                'created_at'   =>  date('Y-m-d H:i:s'),
            ],[   
                'plan_id' => 1,
                'language_id' => 3,
                'word'=> 'salon',
                'status'=> 'active',
                'created_at'   =>  date('Y-m-d H:i:s'),
            ],[   
                'plan_id' => 1,
                'language_id' => 3,
                'word'=> 'La chambre',
                'status'=> 'active',
                'created_at'   =>  date('Y-m-d H:i:s'),
            ],[   
                'plan_id' => 1,
                'language_id' => 3,
                'word'=> 'salle de bain',
                'status'=> 'active',
                'created_at'   =>  date('Y-m-d H:i:s'),
            ],[   
                'plan_id' => 1,
                'language_id' => 3,
                'word'=> 'toilettes',
                'status'=> 'active',
                'created_at'   =>  date('Y-m-d H:i:s'),
            ],[   
                'plan_id' => 1,
                'language_id' => 3,
                'word'=> 'sous-sol',
                'status'=> 'active',
                'created_at'   =>  date('Y-m-d H:i:s'),
            ],[   
                'plan_id' => 1,
                'language_id' => 3,
                'word'=> 'Le grenier',
                'status'=> 'active',
                'created_at'   =>  date('Y-m-d H:i:s'),
            ],[   
                'plan_id' => 1,
                'language_id' => 3,
                'word'=> 'porte',
                'status'=> 'active',
                'created_at'   =>  date('Y-m-d H:i:s'),
            ],[   
                'plan_id' => 1,
                'language_id' => 3,
                'word'=> 'fenêtre',
                'status'=> 'active',
                'created_at'   =>  date('Y-m-d H:i:s'),
            ],[   
                'plan_id' => 1,
                'language_id' => 3,
                'word'=> 'Le couloir',
                'status'=> 'active',
                'created_at'   =>  date('Y-m-d H:i:s'),
            ],[   
                'plan_id' => 1,
                'language_id' => 3,
                'word'=> 'escalier',
                'status'=> 'active',
                'created_at'   =>  date('Y-m-d H:i:s'),
            ],[   
                'plan_id' => 1,
                'language_id' => 3,
                'word'=> 'Le mur',
                'status'=> 'active',
                'created_at'   =>  date('Y-m-d H:i:s'),
            ],[   
                'plan_id' => 1,
                'language_id' => 3,
                'word'=> 'Le sol',
                'status'=> 'active',
                'created_at'   =>  date('Y-m-d H:i:s'),
            ],[   
                'plan_id' => 1,
                'language_id' => 3,
                'word'=> 'Le plafond',
                'status'=> 'active',
                'created_at'   =>  date('Y-m-d H:i:s'),
            ],[   
                'plan_id' => 1,
                'language_id' => 3,
                'word'=> 'bureau',
                'status'=> 'active',
                'created_at'   =>  date('Y-m-d H:i:s'),
            ],[   
                'plan_id' => 1,
                'language_id' => 3,
                'word'=> 'ordinateur',
                'status'=> 'active',
                'created_at'   =>  date('Y-m-d H:i:s'),
            ],[   
                'plan_id' => 1,
                'language_id' => 3,
                'word'=> 'L’étagère',
                'status'=> 'active',
                'created_at'   =>  date('Y-m-d H:i:s'),
            ],[   
                'plan_id' => 1,
                'language_id' => 3,
                'word'=> 'livre',
                'status'=> 'active',
                'created_at'   =>  date('Y-m-d H:i:s'),
            ],[   
                'plan_id' => 1,
                'language_id' => 3,
                'word'=> 'télévision',
                'status'=> 'active',
                'created_at'   =>  date('Y-m-d H:i:s'),
            ],[   
                'plan_id' => 1,
                'language_id' => 3,
                'word'=> 'canapé',
                'status'=> 'active',
                'created_at'   =>  date('Y-m-d H:i:s'),
            ],[   
                'plan_id' => 1,
                'language_id' => 3,
                'word'=> 'chaise',
                'status'=> 'active',
                'created_at'   =>  date('Y-m-d H:i:s'),
            ],
// -------------------------------------------------------------------------------// 

            [   
                'plan_id' => 1,
                'language_id' => 9,
                'word'=> 'τόνος',
                'status'=> 'active',
                'created_at'   =>  date('Y-m-d H:i:s'),
            ],[   
                'plan_id' => 1,
                'language_id' => 9,
                'word'=> 'δυστύχημα',
                'status'=> 'active',
                'created_at'   =>  date('Y-m-d H:i:s'),
            ],[   
                'plan_id' => 1,
                'language_id' => 9,
                'word'=> 'λογιστής',
                'status'=> 'active',
                'created_at'   =>  date('Y-m-d H:i:s'),
            ],[   
                'plan_id' => 1,
                'language_id' => 9,
                'word'=> 'αναγνωρίζω',
                'status'=> 'active',
                'created_at'   =>  date('Y-m-d H:i:s'),
            ],[   
                'plan_id' => 1,
                'language_id' => 9,
                'word'=> 'ηθοποιός',
                'status'=> 'active',
                'created_at'   =>  date('Y-m-d H:i:s'),
            ],[   
                'plan_id' => 1,
                'language_id' => 9,
                'word'=> 'άφρο (χτένισμα)',
                'status'=> 'active',
                'created_at'   =>  date('Y-m-d H:i:s'),
            ],[   
                'plan_id' => 1,
                'language_id' => 9,
                'word'=> 'απόγευμα',
                'status'=> 'active',
                'created_at'   =>  date('Y-m-d H:i:s'),
            ],[   
                'plan_id' => 1,
                'language_id' => 9,
                'word'=> 'αεροδρόμιο',
                'status'=> 'active',
                'created_at'   =>  date('Y-m-d H:i:s'),
            ],[   
                'plan_id' => 1,
                'language_id' => 9,
                'word'=> 'ταράσσω',
                'status'=> 'active',
                'created_at'   =>  date('Y-m-d H:i:s'),
            ],[   
                'plan_id' => 1,
                'language_id' => 9,
                'word'=> 'οινόπνευμα',
                'status'=> 'active',
                'created_at'   =>  date('Y-m-d H:i:s'),
            ],[   
                'plan_id' => 1,
                'language_id' => 9,
                'word'=> 'επίπεδος',
                'status'=> 'active',
                'created_at'   =>  date('Y-m-d H:i:s'),
            ],[   
                'plan_id' => 1,
                'language_id' => 9,
                'word'=> 'αργία',
                'status'=> 'active',
                'created_at'   =>  date('Y-m-d H:i:s'),
            ],[   
                'plan_id' => 1,
                'language_id' => 9,
                'word'=> 'μητέρα',
                'status'=> 'active',
                'created_at'   =>  date('Y-m-d H:i:s'),
            ],[   
                'plan_id' => 1,
                'language_id' => 9,
                'word'=> 'πατέρας',
                'status'=> 'active',
                'created_at'   =>  date('Y-m-d H:i:s'),
            ],[   
                'plan_id' => 1,
                'language_id' => 9,
                'word'=> 'αδελφός',
                'status'=> 'active',
                'created_at'   =>  date('Y-m-d H:i:s'),
            ],[   
                'plan_id' => 1,
                'language_id' => 9,
                'word'=> 'αδερφή',
                'status'=> 'active',
                'created_at'   =>  date('Y-m-d H:i:s'),
            ],[   
                'plan_id' => 1,
                'language_id' => 9,
                'word'=> 'βιβλίο',
                'status'=> 'active',
                'created_at'   =>  date('Y-m-d H:i:s'),
            ],[   
                'plan_id' => 1,
                'language_id' => 9,
                'word'=> 'σχολείο',
                'status'=> 'active',
                'created_at'   =>  date('Y-m-d H:i:s'),
            ],[   
                'plan_id' => 1,
                'language_id' => 9,
                'word'=> 'τηλεφωνώ',
                'status'=> 'active',
                'created_at'   =>  date('Y-m-d H:i:s'),
            ],[   
                'plan_id' => 1,
                'language_id' => 9,
                'word'=> 'πονώ',
                'status'=> 'active',
                'created_at'   =>  date('Y-m-d H:i:s'),
            ],[   
                'plan_id' => 1,
                'language_id' => 9,
                'word'=> 'μπογιά',
                'status'=> 'active',
                'created_at'   =>  date('Y-m-d H:i:s'),
            ],[   
                'plan_id' => 1,
                'language_id' => 9,
                'word'=> 'κάνω τον μπείμπι σίτερ',
                'status'=> 'active',
                'created_at'   =>  date('Y-m-d H:i:s'),
            ],[   
                'plan_id' => 1,
                'language_id' => 9,
                'word'=> 'υποστηρίζω',
                'status'=> 'active',
                'created_at'   =>  date('Y-m-d H:i:s'),
            ],[   
                'plan_id' => 1,
                'language_id' => 9,
                'word'=> 'καπνιστό χοιρινό',
                'status'=> 'active',
                'created_at'   =>  date('Y-m-d H:i:s'),
            ],[   
                'plan_id' => 1,
                'language_id' => 9,
                'word'=> 'απεικονίζω',
                'status'=> 'active',
                'created_at'   =>  date('Y-m-d H:i:s'),
            ],  

// --------------------------------------------------------------------------------//
 
            [   
                'plan_id' => 1,
                'language_id' => 2,
                'word'=> 'TenTen',
                'status'=> 'active',
                'created_at'   =>  date('Y-m-d H:i:s'),
            ],[   
                'plan_id' => 1,
                'language_id' => 2,
                'word'=> 'Imbecile',
                'status'=> 'active',
                'created_at'   =>  date('Y-m-d H:i:s'),
            ],[   
                'plan_id' => 1,
                'language_id' => 2,
                'word'=> 'Egare',
                'status'=> 'active',
                'created_at'   =>  date('Y-m-d H:i:s'),
            ],[   
                'plan_id' => 1,
                'language_id' => 2,
                'word'=> 'Bekeke',
                'status'=> 'active',
                'created_at'   =>  date('Y-m-d H:i:s'),
            ],[   
                'plan_id' => 1,
                'language_id' => 2,
                'word'=> 'Lobeyy',
                'status'=> 'active',
                'created_at'   =>  date('Y-m-d H:i:s'),
            ],[   
                'plan_id' => 1,
                'language_id' => 2,
                'word'=> 'Languichatte Debordus',
                'status'=> 'active',
                'created_at'   =>  date('Y-m-d H:i:s'),
            ],[   
                'plan_id' => 1,
                'language_id' => 2,
                'word'=> 'Biblo',
                'status'=> 'active',
                'created_at'   =>  date('Y-m-d H:i:s'),
            ],[   
                'plan_id' => 1,
                'language_id' => 2,
                'word'=> 'Flanke',
                'status'=> 'active',
                'created_at'   =>  date('Y-m-d H:i:s'),
            ],[   
                'plan_id' => 1,
                'language_id' => 2,
                'word'=> 'Dekouraje',
                'status'=> 'active',
                'created_at'   =>  date('Y-m-d H:i:s'),
            ],[   
                'plan_id' => 1,
                'language_id' => 2,
                'word'=> 'Ale vou zan',
                'status'=> 'active',
                'created_at'   =>  date('Y-m-d H:i:s'),
            ],[   
                'plan_id' => 1,
                'language_id' => 2,
                'word'=> 'Job pow',
                'status'=> 'active',
                'created_at'   =>  date('Y-m-d H:i:s'),
            ],[   
                'plan_id' => 1,
                'language_id' => 2,
                'word'=> 'Tanpri souple',
                'status'=> 'active',
                'created_at'   =>  date('Y-m-d H:i:s'),
            ],[   
                'plan_id' => 1,
                'language_id' => 2,
                'word'=> 'Labouyi',
                'status'=> 'active',
                'created_at'   =>  date('Y-m-d H:i:s'),
            ],[   
                'plan_id' => 1,
                'language_id' => 2,
                'word'=> 'Plume poul',
                'status'=> 'active',
                'created_at'   =>  date('Y-m-d H:i:s'),
            ],[   
                'plan_id' => 1,
                'language_id' => 2,
                'word'=> 'Pande sertant',
                'status'=> 'active',
                'created_at'   =>  date('Y-m-d H:i:s'),
            ],[   
                'plan_id' => 1,
                'language_id' => 2,
                'word'=> 'Soup pain',
                'status'=> 'active',
                'created_at'   =>  date('Y-m-d H:i:s'),
            ],[   
                'plan_id' => 1,
                'language_id' => 2,
                'word'=> 'luille maskriti',
                'status'=> 'active',
                'created_at'   =>  date('Y-m-d H:i:s'),
            ],[   
                'plan_id' => 1,
                'language_id' => 2,
                'word'=> 'Woosh',
                'status'=> 'active',
                'created_at'   =>  date('Y-m-d H:i:s'),
            ],[   
                'plan_id' => 1,
                'language_id' => 2,
                'word'=> 'Betiz',
                'status'=> 'active',
                'created_at'   =>  date('Y-m-d H:i:s'),
            ],[   
                'plan_id' => 1,
                'language_id' => 2,
                'word'=> 'Zin',
                'status'=> 'active',
                'created_at'   =>  date('Y-m-d H:i:s'),
            ],[   
                'plan_id' => 1,
                'language_id' => 2,
                'word'=> 'Kwense',
                'status'=> 'active',
                'created_at'   =>  date('Y-m-d H:i:s'),
            ],[   
                'plan_id' => 1,
                'language_id' => 2,
                'word'=> 'Zeb',
                'status'=> 'active',
                'created_at'   =>  date('Y-m-d H:i:s'),
            ],[   
                'plan_id' => 1,
                'language_id' => 2,
                'word'=> 'Epav',
                'status'=> 'active',
                'created_at'   =>  date('Y-m-d H:i:s'),
            ],[   
                'plan_id' => 1,
                'language_id' => 2,
                'word'=> 'Baton',
                'status'=> 'active',
                'created_at'   =>  date('Y-m-d H:i:s'),
            ],[   
                'plan_id' => 1,
                'language_id' => 2,
                'word'=> 'Koute pye',
                'status'=> 'active',
                'created_at'   =>  date('Y-m-d H:i:s'),
            ],

//----------------------------------------------------------------------------------//


            [   
                'plan_id' => 1,
                'language_id' => 4,
                'word'=> 'Salchicha con arroz',
                'status'=> 'active',
                'created_at'   =>  date('Y-m-d H:i:s'),
            ],[   
                'plan_id' => 1,
                'language_id' => 4,
                'word'=> 'Para mi Bebe cologne',
                'status'=> 'active',
                'created_at'   =>  date('Y-m-d H:i:s'),
            ],[   
                'plan_id' => 1,
                'language_id' => 4,
                'word'=> 'Chancletas',
                'status'=> 'active',
                'created_at'   =>  date('Y-m-d H:i:s'),
            ],[   
                'plan_id' => 1,
                'language_id' => 4,
                'word'=> 'Vitrina',
                'status'=> 'active',
                'created_at'   =>  date('Y-m-d H:i:s'),
            ],[   
                'plan_id' => 1,
                'language_id' => 4,
                'word'=> 'Telenovela',
                'status'=> 'active',
                'created_at'   =>  date('Y-m-d H:i:s'),
            ],[   
                'plan_id' => 1,
                'language_id' => 4,
                'word'=> 'Noche buena',
                'status'=> 'active',
                'created_at'   =>  date('Y-m-d H:i:s'),
            ],[   
                'plan_id' => 1,
                'language_id' => 4,
                'word'=> 'Mi burrito',
                'status'=> 'active',
                'created_at'   =>  date('Y-m-d H:i:s'),
            ],[   
                'plan_id' => 1,
                'language_id' => 4,
                'word'=> 'Cafecito',
                'status'=> 'active',
                'created_at'   =>  date('Y-m-d H:i:s'),
            ],[   
                'plan_id' => 1,
                'language_id' => 4,
                'word'=> 'Cafe con leche',
                'status'=> 'active',
                'created_at'   =>  date('Y-m-d H:i:s'),
            ],[   
                'plan_id' => 1,
                'language_id' => 4,
                'word'=> 'Bustello',
                'status'=> 'active',
                'created_at'   =>  date('Y-m-d H:i:s'),
            ],[   
                'plan_id' => 1,
                'language_id' => 4,
                'word'=> 'Pilon',
                'status'=> 'active',
                'created_at'   =>  date('Y-m-d H:i:s'),
            ],[   
                'plan_id' => 1,
                'language_id' => 4,
                'word'=> 'La llave',
                'status'=> 'active',
                'created_at'   =>  date('Y-m-d H:i:s'),
            ],[   
                'plan_id' => 1,
                'language_id' => 4,
                'word'=> 'Bachata',
                'status'=> 'active',
                'created_at'   =>  date('Y-m-d H:i:s'),
            ],[   
                'plan_id' => 1,
                'language_id' => 4,
                'word'=> 'Salsa',
                'status'=> 'active',
                'created_at'   =>  date('Y-m-d H:i:s'),
            ],[   
                'plan_id' => 1,
                'language_id' => 4,
                'word'=> 'Meringue',
                'status'=> 'active',
                'created_at'   =>  date('Y-m-d H:i:s'),
            ],[   
                'plan_id' => 1,
                'language_id' => 4,
                'word'=> 'Hector Lavoe',
                'status'=> 'active',
                'created_at'   =>  date('Y-m-d H:i:s'),
            ],[   
                'plan_id' => 1,
                'language_id' => 4,
                'word'=> 'Celia Cruz',
                'status'=> 'active',
                'created_at'   =>  date('Y-m-d H:i:s'),
            ],[   
                'plan_id' => 1,
                'language_id' => 4,
                'word'=> 'Marc Anthony',
                'status'=> 'active',
                'created_at'   =>  date('Y-m-d H:i:s'),
            ],[   
                'plan_id' => 1,
                'language_id' => 4,
                'word'=> 'Ana Gabrie',
                'status'=> 'active',
                'created_at'   =>  date('Y-m-d H:i:s'),
            ],[   
                'plan_id' => 1,
                'language_id' => 4,
                'word'=> 'Aventura',
                'status'=> 'active',
                'created_at'   =>  date('Y-m-d H:i:s'),
            ],[   
                'plan_id' => 1,
                'language_id' => 4,
                'word'=> 'Bandera',
                'status'=> 'active',
                'created_at'   =>  date('Y-m-d H:i:s'),
            ],[   
                'plan_id' => 1,
                'language_id' => 4,
                'word'=> 'Quinceañera',
                'status'=> 'active',
                'created_at'   =>  date('Y-m-d H:i:s'),
            ],[   
                'plan_id' => 1,
                'language_id' => 4,
                'word'=> 'Bad Bunny',
                'status'=> 'active',
                'created_at'   =>  date('Y-m-d H:i:s'),
            ],[   
                'plan_id' => 1,
                'language_id' => 4,
                'word'=> 'Maluma',
                'status'=> 'active',
                'created_at'   =>  date('Y-m-d H:i:s'),
            ],[   
                'plan_id' => 1,
                'language_id' => 4,
                'word'=> 'Arroz con pollo',
                'status'=> 'active',
                'created_at'   =>  date('Y-m-d H:i:s'),
            ], 

//----------------------------------------------------------------------------------//

            [   
                'plan_id' => 1,
                'language_id' => 5,
                'word'=> 'hat verloren',
                'status'=> 'active',
                'created_at'   =>  date('Y-m-d H:i:s'),
            ],[   
                'plan_id' => 1,
                'language_id' => 5,
                'word'=> 'Skelett',
                'status'=> 'active',
                'created_at'   =>  date('Y-m-d H:i:s'),
            ],[   
                'plan_id' => 1,
                'language_id' => 5,
                'word'=> 'Pasta',
                'status'=> 'active',
                'created_at'   =>  date('Y-m-d H:i:s'),
            ],[   
                'plan_id' => 1,
                'language_id' => 5,
                'word'=> 'die Seide',
                'status'=> 'active',
                'created_at'   =>  date('Y-m-d H:i:s'),
            ],[   
                'plan_id' => 1,
                'language_id' => 5,
                'word'=> 'Grabstein',
                'status'=> 'active',
                'created_at'   =>  date('Y-m-d H:i:s'),
            ],[   
                'plan_id' => 1,
                'language_id' => 5,
                'word'=> 'Fett',
                'status'=> 'active',
                'created_at'   =>  date('Y-m-d H:i:s'),
            ],[   
                'plan_id' => 1,
                'language_id' => 5,
                'word'=> 'Eis',
                'status'=> 'active',
                'created_at'   =>  date('Y-m-d H:i:s'),
            ],[   
                'plan_id' => 1,
                'language_id' => 5,
                'word'=> 'Falten',
                'status'=> 'active',
                'created_at'   =>  date('Y-m-d H:i:s'),
            ],[   
                'plan_id' => 1,
                'language_id' => 5,
                'word'=> 'Schweben',
                'status'=> 'active',
                'created_at'   =>  date('Y-m-d H:i:s'),
            ],[   
                'plan_id' => 1,
                'language_id' => 5,
                'word'=> 'Schlagen',
                'status'=> 'active',
                'created_at'   =>  date('Y-m-d H:i:s'),
            ],[   
                'plan_id' => 1,
                'language_id' => 5,
                'word'=> 'Gruppe',
                'status'=> 'active',
                'created_at'   =>  date('Y-m-d H:i:s'),
            ],[   
                'plan_id' => 1,
                'language_id' => 5,
                'word'=> 'Eiffelturm',
                'status'=> 'active',
                'created_at'   =>  date('Y-m-d H:i:s'),
            ],[   
                'plan_id' => 1,
                'language_id' => 5,
                'word'=> 'Lotterie',
                'status'=> 'active',
                'created_at'   =>  date('Y-m-d H:i:s'),
            ],[   
                'plan_id' => 1,
                'language_id' => 5,
                'word'=> 'Kichern',
                'status'=> 'active',
                'created_at'   =>  date('Y-m-d H:i:s'),
            ],[   
                'plan_id' => 1,
                'language_id' => 5,
                'word'=> 'Otto von Bismark',
                'status'=> 'active',
                'created_at'   =>  date('Y-m-d H:i:s'),
            ],[   
                'plan_id' => 1,
                'language_id' => 5,
                'word'=> 'Kriechen',
                'status'=> 'active',
                'created_at'   =>  date('Y-m-d H:i:s'),
            ],[   
                'plan_id' => 1,
                'language_id' => 5,
                'word'=> 'Schule',
                'status'=> 'active',
                'created_at'   =>  date('Y-m-d H:i:s'),
            ],[   
                'plan_id' => 1,
                'language_id' => 5,
                'word'=> 'Oktoberfest',
                'status'=> 'active',
                'created_at'   =>  date('Y-m-d H:i:s'),
            ],[   
                'plan_id' => 1,
                'language_id' => 5,
                'word'=> 'Bier',
                'status'=> 'active',
                'created_at'   =>  date('Y-m-d H:i:s'),
            ],[   
                'plan_id' => 1,
                'language_id' => 5,
                'word'=> 'Würstchen',
                'status'=> 'active',
                'created_at'   =>  date('Y-m-d H:i:s'),
            ],[   
                'plan_id' => 1,
                'language_id' => 5,
                'word'=> 'Sanssouci Palace',
                'status'=> 'active',
                'created_at'   =>  date('Y-m-d H:i:s'),
            ],[   
                'plan_id' => 1,
                'language_id' => 5,
                'word'=> 'Angela Merkel',
                'status'=> 'active',
                'created_at'   =>  date('Y-m-d H:i:s'),
            ],[   
                'plan_id' => 1,
                'language_id' => 5,
                'word'=> 'Neuschwanstein Castle',
                'status'=> 'active',
                'created_at'   =>  date('Y-m-d H:i:s'),
            ],[   
                'plan_id' => 1,
                'language_id' => 5,
                'word'=> 'Kölner Dom',
                'status'=> 'active',
                'created_at'   =>  date('Y-m-d H:i:s'),
            ],[   
                'plan_id' => 1,
                'language_id' => 5,
                'word'=> 'Brandenburger Tor',
                'status'=> 'active',
                'created_at'   =>  date('Y-m-d H:i:s'),
            ], 
//-----------------------------------------------------------------------------------//


                        [   
                'plan_id' => 1,
                'language_id' => 1,
                'word'=> 'Mobile',
                'status'=> 'active',
                'created_at'   =>  date('Y-m-d H:i:s'),
            ],[   
                'plan_id' => 1,
                'language_id' => 1,
                'word'=> 'Plane',
                'status'=> 'active',
                'created_at'   =>  date('Y-m-d H:i:s'),
            ],[   
                'plan_id' => 1,
                'language_id' => 1,
                'word'=> 'Pasta',
                'status'=> 'active',
                'created_at'   =>  date('Y-m-d H:i:s'),
            ],[   
                'plan_id' => 1,
                'language_id' => 1,
                'word'=> 'Charger',
                'status'=> 'active',
                'created_at'   =>  date('Y-m-d H:i:s'),
            ],[   
                'plan_id' => 1,
                'language_id' => 1,
                'word'=> 'Apple',
                'status'=> 'active',
                'created_at'   =>  date('Y-m-d H:i:s'),
            ],[   
                'plan_id' => 1,
                'language_id' => 1,
                'word'=> 'Postman',
                'status'=> 'active',
                'created_at'   =>  date('Y-m-d H:i:s'),
            ],[   
                'plan_id' => 1,
                'language_id' => 1,
                'word'=> 'Gold mine',
                'status'=> 'active',
                'created_at'   =>  date('Y-m-d H:i:s'),
            ],[   
                'plan_id' => 1,
                'language_id' => 1,
                'word'=> 'World cup',
                'status'=> 'active',
                'created_at'   =>  date('Y-m-d H:i:s'),
            ],[   
                'plan_id' => 1,
                'language_id' => 1,
                'word'=> 'Messi',
                'status'=> 'active',
                'created_at'   =>  date('Y-m-d H:i:s'),
            ],[   
                'plan_id' => 1,
                'language_id' => 1,
                'word'=> 'How are you?',
                'status'=> 'active',
                'created_at'   =>  date('Y-m-d H:i:s'),
            ],[   
                'plan_id' => 1,
                'language_id' => 1,
                'word'=> 'Silver',
                'status'=> 'active',
                'created_at'   =>  date('Y-m-d H:i:s'),
            ],[   
                'plan_id' => 1,
                'language_id' => 1,
                'word'=> 'Description',
                'status'=> 'active',
                'created_at'   =>  date('Y-m-d H:i:s'),
            ],[   
                'plan_id' => 1,
                'language_id' => 1,
                'word'=> 'Team',
                'status'=> 'active',
                'created_at'   =>  date('Y-m-d H:i:s'),
            ],[   
                'plan_id' => 1,
                'language_id' => 1,
                'word'=> 'Cricket',
                'status'=> 'active',
                'created_at'   =>  date('Y-m-d H:i:s'),
            ],[   
                'plan_id' => 1,
                'language_id' => 1,
                'word'=> 'Search',
                'status'=> 'active',
                'created_at'   =>  date('Y-m-d H:i:s'),
            ],[   
                'plan_id' => 1,
                'language_id' => 1,
                'word'=> 'Structure',
                'status'=> 'active',
                'created_at'   =>  date('Y-m-d H:i:s'),
            ],[   
                'plan_id' => 1,
                'language_id' => 1,
                'word'=> 'Browse',
                'status'=> 'active',
                'created_at'   =>  date('Y-m-d H:i:s'),
            ],[   
                'plan_id' => 1,
                'language_id' => 1,
                'word'=> 'New',
                'status'=> 'active',
                'created_at'   =>  date('Y-m-d H:i:s'),
            ],[   
                'plan_id' => 1,
                'language_id' => 1,
                'word'=> 'Server',
                'status'=> 'active',
                'created_at'   =>  date('Y-m-d H:i:s'),
            ],[   
                'plan_id' => 1,
                'language_id' => 1,
                'word'=> 'Game',
                'status'=> 'active',
                'created_at'   =>  date('Y-m-d H:i:s'),
            ],[   
                'plan_id' => 1,
                'language_id' => 1,
                'word'=> 'Internet',
                'status'=> 'active',
                'created_at'   =>  date('Y-m-d H:i:s'),
            ],[   
                'plan_id' => 1,
                'language_id' => 1,
                'word'=> 'Folder',
                'status'=> 'active',
                'created_at'   =>  date('Y-m-d H:i:s'),
            ],[   
                'plan_id' => 1,
                'language_id' => 1,
                'word'=> 'Cable',
                'status'=> 'active',
                'created_at'   =>  date('Y-m-d H:i:s'),
            ],[   
                'plan_id' => 1,
                'language_id' => 1,
                'word'=> 'Laptop',
                'status'=> 'active',
                'created_at'   =>  date('Y-m-d H:i:s'),
            ],[   
                'plan_id' => 1,
                'language_id' => 1,
                'word'=> 'Light',
                'status'=> 'active',
                'created_at'   =>  date('Y-m-d H:i:s'),
            ], 
        ];
        
        DB::table('words')->insert($words);

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        
    }
}
