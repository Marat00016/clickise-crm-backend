<?php

namespace App\JsonApi\V1\Messages;

use App\Models\Contact;
use App\Models\Dialog;
use App\Models\User;
use Illuminate\Validation\Rule;
use LaravelJsonApi\Laravel\Http\Requests\ResourceRequest;
use LaravelJsonApi\Validation\Rule as JsonApiRule;

class MessageRequest extends ResourceRequest
{

    /**
     * Get the validation rules for the resource.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'dialog_uuid' => ['required', 'uuid', Rule::exists(Dialog::class, 'uuid')],
            'contact_uuid' => ['nullable', 'uuid', Rule::exists(Contact::class, 'uuid')],
            'user_id' => ['nullable', 'id', Rule::exists(User::class, 'id')],
            'text' => ['required', 'string'],
        ];
    }

}
