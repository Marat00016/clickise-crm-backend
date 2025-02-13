<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Bot;
use App\Models\Contact;
use App\Models\Dialog;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use LaravelJsonApi\Core\Responses\MetaResponse;
use LaravelJsonApi\Laravel\Http\Controllers\Actions;
use LaravelJsonApi\Laravel\Http\Controllers\JsonApiController;

class WebhookController extends JsonApiController
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

    const API_URL = 'https://api.telegram.org';

    protected function rules(): array
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

    public function handle(Request $request, string $token): MetaResponse
    {
        $bot = Bot::where('webhook_token', $token)->firstOrFail();

        $validated = $request->validate($this->rules());

        $fromId = data_get($validated, 'message.from.id');
        $chatId = data_get($validated, 'message.chat.id');
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

        return MetaResponse::make(Http::post(sprintf('%1$s/bot%2$s/sendMessage', self::API_URL, $bot->token), [
            'chat_id' => $chatId,
            'text' => $request->collect()->toJson(JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE),
        ])->json())->withServer('v1');
    }
}
