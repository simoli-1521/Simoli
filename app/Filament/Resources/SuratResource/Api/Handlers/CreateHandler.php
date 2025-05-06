<?php
namespace App\Filament\Resources\SuratResource\Api\Handlers;

use Illuminate\Http\Request;
use Rupadana\ApiService\Http\Handlers;
use App\Filament\Resources\SuratResource;
use App\Filament\Resources\SuratResource\Api\Requests\CreateSuratRequest;

class CreateHandler extends Handlers {
    public static string | null $uri = '/';
    public static string | null $resource = SuratResource::class;

    public static function getMethod()
    {
        return Handlers::POST;
    }

    public static function getModel() {
        return static::$resource::getModel();
    }

    /**
     * Create Surat
     *
     * @param CreateSuratRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function handler(CreateSuratRequest $request)
    {
        $model = new (static::getModel());

        $model->fill($request->all());

        $model->save();

        return static::sendSuccessResponse($model, "Successfully Create Resource");
    }
}