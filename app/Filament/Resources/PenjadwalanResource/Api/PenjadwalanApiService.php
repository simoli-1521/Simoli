<?php
namespace App\Filament\Resources\PenjadwalanResource\Api;

use Rupadana\ApiService\ApiService;
use App\Filament\Resources\PenjadwalanResource;
use Illuminate\Routing\Router;


class PenjadwalanApiService extends ApiService
{
    protected static string | null $resource = PenjadwalanResource::class;

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
