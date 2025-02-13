<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\JsonResponse;
use LaravelJsonApi\Core\Responses\DataResponse;
use LaravelJsonApi\Core\Document\Error;
use LaravelJsonApi\Core\Responses\MetaResponse;
use LaravelJsonApi\Laravel\Http\Controllers\Actions;
use LaravelJsonApi\Laravel\Http\Controllers\JsonApiController;

class AuthController extends JsonApiController
{
    use Actions\FetchMany;
    use Actions\FetchOne;
    use Actions\Store;
    use Actions\Update;
    use Actions\Destroy;
    use Actions\FetchRelated;
    use Actions\FetchRelationship;
    use Actions\UpdateRelationship;
    use Actions\AttachRelationship;
    use Actions\DetachRelationship;

    /**
     * Get a JWT via given credentials.
     *
     * @return MetaResponse|Error
     */
    public function login(): MetaResponse|Error
    {
        $credentials = request(['email', 'password']);

        if (!$token = auth()->attempt($credentials)) {
            return Error::make()->setStatus(401)->setDetail('Unauthorized');
        }

        return $this->respondWithToken($token);
    }

    /**
     * Get the authenticated User.
     *
     * @return JsonResponse
     */
    public function me()
    {
        return DataResponse::make(auth()->user())->withServer('v1');
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return JsonResponse
     */
    public function logout()
    {
        auth()->logout(true);

        return MetaResponse::make([
            'detail' => 'Successfully logged out',
        ])->withServer('v1');
    }

    /**
     * Refresh a token.
     *
     * @return MetaResponse
     */
    public function refresh(): MetaResponse
    {
        return $this->respondWithToken(auth()->refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param string $token
     *
     * @return MetaResponse
     */
    protected function respondWithToken(string $token): MetaResponse
    {
        return MetaResponse::make([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ])->withServer('v1');
    }
}
