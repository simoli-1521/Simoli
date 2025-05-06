<?php
namespace App\Filament\Resources\PenilaianPegawaiResource\Api;

use Rupadana\ApiService\ApiService;
use App\Filament\Resources\PenilaianPegawaiResource;
use Illuminate\Routing\Router;


class PenilaianPegawaiApiService extends ApiService
{
    protected static string | null $resource = PenilaianPegawaiResource::class;

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
