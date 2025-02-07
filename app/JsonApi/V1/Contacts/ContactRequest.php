<?php

namespace App\JsonApi\V1\Contacts;

use Illuminate\Validation\Rule;
use LaravelJsonApi\Laravel\Http\Requests\ResourceRequest;
use LaravelJsonApi\Validation\Rule as JsonApiRule;

class ContactRequest extends ResourceRequest
{

    /**
     * Get the validation rules for the resource.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'client_uuid' => ['uuid'],
            'telegram_chat_id' => ['required', 'integer'],
            'name' => ['string'],
            'email' => ['string'],
            'phone' => ['integer'],
            'sales_status_id' => ['integer'],
            'support_status_id' => ['integer'],
        ];
    }

}
