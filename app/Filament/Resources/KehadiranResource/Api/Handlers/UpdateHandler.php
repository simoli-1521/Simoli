<?php
namespace App\Filament\Resources\KehadiranResource\Api\Handlers;

use Illuminate\Http\Request;
use Rupadana\ApiService\Http\Handlers;
use App\Filament\Resources\KehadiranResource;
use App\Filament\Resources\KehadiranResource\Api\Requests\UpdateKehadiranRequest;

class UpdateHandler extends Handlers {
    public static string | null $uri = '/{id}';
    public static string | null $resource = KehadiranResource::class;

    public static function getMethod()
    {
        return Handlers::PUT;
    }

    public static function getModel() {
        return static::$resource::getModel();
    }


    /**
     * Update Kehadiran
     *
     * @param UpdateKehadiranRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function handler(UpdateKehadiranRequest $request)
    {
        $id = $request->route('id');

        $model = static::getModel()::find($id);

        if (!$model) return static::sendNotFoundResponse();

        $model->fill($request->all());

        $model->save();

        return static::sendSuccessResponse($model, "Successfully Update Resource");
    }
}