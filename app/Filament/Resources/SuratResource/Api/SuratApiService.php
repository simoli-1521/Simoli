<?php
namespace App\Filament\Resources\SuratResource\Api;

use Rupadana\ApiService\ApiService;
use App\Filament\Resources\SuratResource;
use Illuminate\Routing\Router;


class SuratApiService extends ApiService
{
    protected static string | null $resource = SuratResource::class;

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
