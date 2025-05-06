<?php
namespace App\Filament\Resources\PenjadwalanResource\Api\Handlers;

use Illuminate\Http\Request;
use Rupadana\ApiService\Http\Handlers;
use App\Filament\Resources\PenjadwalanResource;
use App\Filament\Resources\PenjadwalanResource\Api\Requests\CreatePenjadwalanRequest;

class CreateHandler extends Handlers {
    public static string | null $uri = '/';
    public static string | null $resource = PenjadwalanResource::class;

    public static function getMethod()
    {
        return Handlers::POST;
    }

    public static function getModel() {
        return static::$resource::getModel();
    }

    /**
     * Create Penjadwalan
     *
     * @param CreatePenjadwalanRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function handler(CreatePenjadwalanRequest $request)
    {
        $model = new (static::getModel());

        $model->fill($request->all());

        $model->save();

        return static::sendSuccessResponse($model, "Successfully Create Resource");
    }
}