<?php
namespace App\Filament\Resources\KehadiranResource\Api\Handlers;

use Illuminate\Http\Request;
use Rupadana\ApiService\Http\Handlers;
use App\Filament\Resources\KehadiranResource;
use App\Filament\Resources\KehadiranResource\Api\Requests\CreateKehadiranRequest;

class CreateHandler extends Handlers {
    public static string | null $uri = '/';
    public static string | null $resource = KehadiranResource::class;

    public static function getMethod()
    {
        return Handlers::POST;
    }

    public static function getModel() {
        return static::$resource::getModel();
    }

    /**
     * Create Kehadiran
     *
     * @param CreateKehadiranRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function handler(CreateKehadiranRequest $request)
    {
        $model = new (static::getModel());

        $model->fill($request->all());

        $model->save();

        return static::sendSuccessResponse($model, "Successfully Create Resource");
    }
}