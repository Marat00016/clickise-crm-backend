<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Bot;
use App\Models\Contact;
use App\Models\Dialog;
use App\Models\Message;
use App\Services\TelegramBotService;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\RequestException;
use LaravelJsonApi\Core\Document\Error;
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

    protected TelegramBotService $telegram;

    public function __construct(TelegramBotService $telegram)
    {
        $this->telegram = $telegram;
    }

    /**
     * @throws RequestException
     * @throws ConnectionException
     */
    public function handle(string $token): MetaResponse|Error
    {
        $validated = request()->validate($this->telegram->rulesUpdate());

        $fromId = data_get($validated, 'message.from.id');
        if ($fromId) {
            $contact = Contact::firstOrCreate(['chat_id' => $fromId]);

            $bot = Bot::where('webhook_token', $token)->firstOrFail();
            $this->telegram->setToken($bot->token);

            $chatId = data_get($validated, 'message.chat.id');
            $dialog = Dialog::firstOrCreate(['chat_id' => $chatId, 'bot_id' => $bot->id]);

            $dialog->contacts()->syncWithoutDetaching([$contact->uuid]);

            $text = data_get($validated, 'message.text');
            if ($text) {
                Message::create([
                    'dialog_uuid' => $dialog->uuid,
                    'contact_uuid' => $contact->uuid,
                    'text' => $text,
                ]);

                $response = $this->telegram->sendMessage([
                    'chat_id' => $chatId,
                    'text' => json_encode($validated, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE),
                ]);
            }
        }

        if (isset($response)) {
            return MetaResponse::make($response)->withServer('v1');
        } else {
            return Error::make()->setStatus(400)->setDetail('Bad Request');
        }
    }
}
