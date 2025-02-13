<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Bot;
use App\Models\Contact;
use App\Models\Dialog;
use App\Models\Message;
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

    const api = 'https://api.telegram.org';

    public function rules(): array
    {
        return [
            'update_id' => ['required', 'integer'],
            'message' => ['array'],
            'message.message_id' => ['required', 'integer'],
            'message.from' => ['array'],
            'message.from.id' => ['required', 'integer'],
            'message.from.is_bot' => ['required', 'boolean'],
            'message.from.first_name' => ['required', 'string'],
            'message.from.last_name' => ['string'],
            'message.from.username' => ['string'],
            'message.from.language_code' => ['string', 'size:2'],
            'message.chat' => ['required', 'array'],
            'message.chat.id' => ['required', 'integer'],
            'message.chat.first_name' => ['string'],
            'message.chat.last_name' => ['string'],
            'message.chat.username' => ['string'],
            'message.chat.type' => ['required', 'string', 'in:private,group,supergroup,channel'],
            'message.date' => ['required', 'integer'],
            'message.text' => ['string'],
        ];
    }

    public function handle(Request $request, string $token)
    {
        $bot = Bot::where('webhook_token', $token)->firstOrFail();

        $validated = $request->validate($this->rules());

        $fromId = data_get($validated, 'message.from.id');
        $chatId = data_get($validated, 'message.from.id');
        $text = data_get($validated, 'message.text');

        if ($fromId) {
            $dialog = Dialog::firstOrCreate(['chat_id' => $chatId, 'bot_id' => $bot->id]);
            $contact = Contact::firstOrCreate(['chat_id' => $fromId]);
            $dialog->contacts()->syncWithoutDetaching([$contact->uuid]);

            if ($text) {
                Message::create([
                    'dialog_uuid' => $dialog->uuid,
                    'contact_uuid' => $contact->uuid,
                    'text' => $text,
                ]);
            }
        }

        return Http::post(sprintf('%1$s/bot%2$s/sendMessage', self::api, $bot->token), [
            'chat_id' => data_get($validated, 'message.chat.id'),
            'text' => $request->collect()->toJson(JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE),
        ])->json();
    }
}
