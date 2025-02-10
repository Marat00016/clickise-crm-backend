<?php

namespace App\JsonApi\V1\Messages;

use App\Models\Contact;
use App\Models\Dialog;
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
            'contact_uuid' => ['required', 'uuid', Rule::exists(Contact::class, 'uuid')],
            'text' => ['required', 'string'],
        ];
    }

}
