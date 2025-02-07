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
        return [
            'name' => ['string', 'required'],
            'email' => ['string', 'nullable'],
            'phone' => ['integer', 'nullable'],
            'inn' => ['integer', 'required'],
            'ogrn' => ['integer', 'nullable'],
            'kpp' => ['integer', 'nullable'],
        ];
    }

}
