<?php
namespace App\Filament\Resources\BorrowResource\Api;

use Rupadana\ApiService\ApiService;
use App\Filament\Resources\BorrowResource;
use Illuminate\Routing\Router;


class BorrowApiService extends ApiService
{
    protected static string | null $resource = BorrowResource::class;

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
