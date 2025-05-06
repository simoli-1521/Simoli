<?php
namespace App\Filament\Resources\BookRequestResource\Api\Handlers;

use Illuminate\Http\Request;
use Rupadana\ApiService\Http\Handlers;
use App\Filament\Resources\BookRequestResource;
use App\Filament\Resources\BookRequestResource\Api\Requests\CreateBookRequestRequest;

class CreateHandler extends Handlers {
    public static string | null $uri = '/';
    public static string | null $resource = BookRequestResource::class;

    public static function getMethod()
    {
        return Handlers::POST;
    }

    public static function getModel() {
        return static::$resource::getModel();
    }

    /**
     * Create BookRequest
     *
     * @param CreateBookRequestRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function handler(CreateBookRequestRequest $request)
    {
        $model = new (static::getModel());

        $model->fill($request->all());

        $model->save();

        return static::sendSuccessResponse($model, "Successfully Create Resource");
    }
}