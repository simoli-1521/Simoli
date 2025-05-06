<?php
namespace App\Filament\Resources\BookRequestResource\Api;

use Rupadana\ApiService\ApiService;
use App\Filament\Resources\BookRequestResource;
use Illuminate\Routing\Router;


class BookRequestApiService extends ApiService
{
    protected static string | null $resource = BookRequestResource::class;

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
