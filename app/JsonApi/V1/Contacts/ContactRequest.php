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
            'client_uuid' => ['uuid', 'nullable'],
            'telegram_chat_id' => ['required', 'integer'],
            'name' => ['string', 'nullable'],
            'email' => ['string', 'nullable'],
            'phone' => ['integer', 'nullable'],
            'sales_status_id' => ['integer', 'nullable'],
            'support_status_id' => ['integer', 'nullable'],
        ];
    }

}
