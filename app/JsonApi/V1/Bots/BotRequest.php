<?php

namespace App\JsonApi\V1\Bots;

use App\Models\Space;
use Illuminate\Validation\Rule;
use LaravelJsonApi\Laravel\Http\Requests\ResourceRequest;
use LaravelJsonApi\Validation\Rule as JsonApiRule;

class BotRequest extends ResourceRequest
{

    /**
     * Get the validation rules for the resource.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'space_id' => ['required', 'integer', Rule::exists(Space::class, 'id')],
            'name' => ['required', 'string'],
            'slug' => ['required', 'string'],
            'token' => ['required', 'string'],
        ];
    }

}
