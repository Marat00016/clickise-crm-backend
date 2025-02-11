<?php

namespace Database\Seeders;

use App\Models\Contact;
use App\Models\Dialog;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DialogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $dialog = Dialog::create([
            'chat_id' => 1,
            'bot_id' => 1,
        ]);

        $contact = Contact::create([
            'chat_id' => 1,
        ]);

        $dialog->users()->attach(1);
        $dialog->contacts()->attach($contact->uuid);
    }
}
