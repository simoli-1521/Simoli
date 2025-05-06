<?php
namespace App\Filament\Resources\BookRequestResource\Api\Handlers;

use Illuminate\Http\Request;
use Rupadana\ApiService\Http\Handlers;
use App\Filament\Resources\BookRequestResource;
use App\Filament\Resources\BookRequestResource\Api\Requests\UpdateBookRequestRequest;

class UpdateHandler extends Handlers {
    public static string | null $uri = '/{id}';
    public static string | null $resource = BookRequestResource::class;

    public static function getMethod()
    {
        return Handlers::PUT;
    }

    public static function getModel() {
        return static::$resource::getModel();
    }


    /**
     * Update BookRequest
     *
     * @param UpdateBookRequestRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function handler(UpdateBookRequestRequest $request)
    {
        $id = $request->route('id');

        $model = static::getModel()::find($id);

        if (!$model) return static::sendNotFoundResponse();

        $model->fill($request->all());

        $model->save();

        return static::sendSuccessResponse($model, "Successfully Update Resource");
    }
}