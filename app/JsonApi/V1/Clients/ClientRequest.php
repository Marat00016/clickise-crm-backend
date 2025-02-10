<?php

namespace App\JsonApi\V1\Clients;

use Illuminate\Validation\Rule;
use LaravelJsonApi\Laravel\Http\Requests\ResourceRequest;
use LaravelJsonApi\Validation\Rule as JsonApiRule;

class ClientRequest extends ResourceRequest
{
    /**
     * Get the validation rules for the resource.
     *
     * @return array
     */
    public function rules(): array
    {
        $user = $this->model();
        $uniqueEmail = Rule::unique('clients', 'email');

        if ($user) {
            $uniqueEmail->ignoreModel($user);
        }

        return [
            'name' => ['required', 'string'],
            'email' => ['string', 'email', 'nullable', $uniqueEmail],
            'phone' => ['integer', 'nullable'],
            'inn' => ['required', 'integer', 'nullable'],
            'ogrn' => ['integer', 'nullable'],
            'kpp' => ['integer', 'nullable'],
        ];
    }
}
