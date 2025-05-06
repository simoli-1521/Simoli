<?php
namespace App\Filament\Resources\PengajuanResource\Api\Handlers;

use Illuminate\Http\Request;
use Rupadana\ApiService\Http\Handlers;
use App\Filament\Resources\PengajuanResource;
use App\Filament\Resources\PengajuanResource\Api\Requests\CreatePengajuanRequest;

class CreateHandler extends Handlers {
    public static string | null $uri = '/';
    public static string | null $resource = PengajuanResource::class;

    public static function getMethod()
    {
        return Handlers::POST;
    }

    public static function getModel() {
        return static::$resource::getModel();
    }

    /**
     * Create Pengajuan
     *
     * @param CreatePengajuanRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function handler(CreatePengajuanRequest $request)
    {
        $model = new (static::getModel());

        $model->fill($request->all());

        $model->save();

        return static::sendSuccessResponse($model, "Successfully Create Resource");
    }
}