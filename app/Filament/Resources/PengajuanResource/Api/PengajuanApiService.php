<?php
namespace App\Filament\Resources\PengajuanResource\Api;

use Rupadana\ApiService\ApiService;
use App\Filament\Resources\PengajuanResource;
use Illuminate\Routing\Router;


class PengajuanApiService extends ApiService
{
    protected static string | null $resource = PengajuanResource::class;

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
