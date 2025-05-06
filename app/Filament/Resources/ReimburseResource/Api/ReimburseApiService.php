<?php
namespace App\Filament\Resources\ReimburseResource\Api;

use Rupadana\ApiService\ApiService;
use App\Filament\Resources\ReimburseResource;
use Illuminate\Routing\Router;


class ReimburseApiService extends ApiService
{
    protected static string | null $resource = ReimburseResource::class;

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
