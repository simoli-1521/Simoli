<?php
namespace App\Filament\Resources\KehadiranResource\Api;

use Rupadana\ApiService\ApiService;
use App\Filament\Resources\KehadiranResource;
use Illuminate\Routing\Router;


class KehadiranApiService extends ApiService
{
    protected static string | null $resource = KehadiranResource::class;

    public static function handlers() : array
    {
        return [
            Handlers\CreateHandler::class,
            Handlers\UpdateHandler::class,
            Handlers\DeleteHandler::class,
            Handlers\PaginationHandler::class,
            Handlers\DetailHandler::class
        ];

    }
}
