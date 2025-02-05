<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function create(Request $request)
    {
        try {
            $validated = $request->validate([
                'client_uuid' => 'uuid',
                'telegram_chat_id' => 'required|integer',
                'name' => 'string',
                'email' => 'string',
                'phone' => 'integer',
            ]);
        } catch (\Throwable $th) {
            return $th;
        }

        return Contact::create($validated);
    }

    public function read()
    {

    }

    public function update()
    {

    }

    public function delete()
    {

    }
}
