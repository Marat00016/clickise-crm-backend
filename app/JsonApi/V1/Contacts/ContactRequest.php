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
            'client_uuid' => ['required', 'uuid', Rule::exists('clients', 'uuid')],
            'chat_id' => ['required', 'integer'],
            'name' => ['string', 'nullable'],
            'email' => ['email', 'nullable'],
            'phone' => ['integer', 'nullable'],
            'sales_status_id' => ['integer', 'nullable', Rule::exists('sales_statuses', 'id')],
            'support_status_id' => ['integer', 'nullable', Rule::exists('support_statuses', 'id')],
        ];
    }
}
