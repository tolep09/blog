<?php

namespace Database\Seeders;

use App\Models\Contact;
use Illuminate\Database\Seeder;

class ContactTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Contact::truncate();

        
        for ($i = 1; $i <=10; $i++)
        {
            Contact::create([
                'name' => "Karina_$i",
                'last_name' => "Torres_$i",
                'email' => "karina_$i@gmail.com",
                'comments' => "Comentarios del usuario Karina_$i Torres_$i"
            ]);
        }
    }
}
