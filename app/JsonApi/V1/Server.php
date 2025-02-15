<?php

namespace App\JsonApi\V1;

use LaravelJsonApi\Core\Server\Server as BaseServer;

class Server extends BaseServer
{

    /**
     * The base URI namespace for this server.
     *
     * @var string
     */
    protected string $baseUri = '/api/v1';

    /**
     * Bootstrap the server when it is handling an HTTP request.
     *
     * @return void
     */
    public function serving(): void
    {
        // no-op
    }

    /**
     * Get the server's list of schemas.
     *
     * @return array
     */
    protected function allSchemas(): array
    {
        return [
            Users\UserSchema::class,
            Contacts\ContactSchema::class,
            Clients\ClientSchema::class,
            Dialogs\DialogSchema::class,
            Messages\MessageSchema::class,
            SalesStatuses\SalesStatusSchema::class,
            SupportStatuses\SupportStatusSchema::class,
            Roles\RoleSchema::class,
            Spaces\SpaceSchema::class,
            Bots\BotSchema::class,
        ];
    }
}
