<?php
namespace App\Filament\Resources\PopularitasResource\Api\Handlers;

use Illuminate\Http\Request;
use Rupadana\ApiService\Http\Handlers;
use App\Filament\Resources\PopularitasResource;
use App\Filament\Resources\PopularitasResource\Api\Requests\CreatePopularitasRequest;

class CreateHandler extends Handlers {
    public static string | null $uri = '/';
    public static string | null $resource = PopularitasResource::class;

    public static function getMethod()
    {
        return Handlers::POST;
    }

    public static function getModel() {
        return static::$resource::getModel();
    }

    /**
     * Create Popularitas
     *
     * @param CreatePopularitasRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function handler(CreatePopularitasRequest $request)
    {
        $model = new (static::getModel());

        $model->fill($request->all());

        $model->save();

        return static::sendSuccessResponse($model, "Successfully Create Resource");
    }
}