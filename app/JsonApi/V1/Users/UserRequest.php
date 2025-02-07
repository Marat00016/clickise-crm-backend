<?php

namespace App\JsonApi\V1\Users;

use Illuminate\Validation\Rule;
use LaravelJsonApi\Laravel\Http\Requests\ResourceRequest;
use LaravelJsonApi\Validation\Rule as JsonApiRule;

class UserRequest extends ResourceRequest
{

    /**
     * Get the validation rules for the resource.
     *
     * @return array
     */
    public function rules(): array
    {
        $user = $this->model();
        $uniqueEmail = Rule::unique('users', 'email');

        if ($user) {
            $uniqueEmail->ignoreModel($user);
        }

        return [
            'name' => ['required', 'string'],
            'email' => ['required', 'email', $uniqueEmail],
            'email_verified_at' => ['nullable', 'date'],
            'password' => ['required', 'string', 'min:8'],
            'rememberToken' => ['nullable', 'string'],
            'role_id' => ['required', 'integer', Rule::exists('roles', 'id')],
        ];
    }

}
