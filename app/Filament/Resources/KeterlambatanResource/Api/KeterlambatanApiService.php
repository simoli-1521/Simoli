<?php
namespace App\Filament\Resources\KeterlambatanResource\Api;

use Rupadana\ApiService\ApiService;
use App\Filament\Resources\KeterlambatanResource;
use Illuminate\Routing\Router;


class KeterlambatanApiService extends ApiService
{
    protected static string | null $resource = KeterlambatanResource::class;

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
