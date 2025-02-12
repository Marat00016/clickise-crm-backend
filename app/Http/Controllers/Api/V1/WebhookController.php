<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Bot;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use LaravelJsonApi\Laravel\Http\Controllers\Actions;

class WebhookController extends Controller
{
    use Actions\FetchMany;
    use Actions\FetchOne;
    use Actions\Store;
    use Actions\Update;
    use Actions\Destroy;
    use Actions\FetchRelated;
    use Actions\FetchRelationship;
    use Actions\UpdateRelationship;
    use Actions\AttachRelationship;
    use Actions\DetachRelationship;

    public function handle(Request $request, $token)
    {
        $bot = Bot::where('webhook_token', $token)->firstOrFail();
        $contact = Contact::firstOrFail();

        return Http::post(sprintf('https://api.telegram.org/bot%1$s/sendMessage', $bot->token), [
            'chat_id' => $contact->chat_id,
            'text' => json_encode($request->getContent(), JSON_UNESCAPED_UNICODE),
        ])->json();
    }
}
