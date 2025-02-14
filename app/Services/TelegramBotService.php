<?php

namespace App\Services;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\RequestException;
use Illuminate\Support\Facades\Http;

class TelegramBotService
{
    private const API_URL = 'https://api.telegram.org';

    private string $token;

    public function setToken(string $token): void
    {
        $this->token = $token;
    }

    public function getToken() : string
    {
        return $this->token;
    }

    public function rulesUpdate(): array
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

    /**
     * @throws RequestException
     * @throws ConnectionException
     */
    public function sendMessage(array $message)
    {
        return Http::post(sprintf(
            '%1$s/bot%2$s/sendMessage',
            self::API_URL,
            $this->getToken()
        ), $message)->throw()->json();
    }
}
