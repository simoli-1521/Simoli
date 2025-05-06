<?php
namespace App\Filament\Resources\ReimburseResource\Api\Handlers;

use Illuminate\Http\Request;
use Rupadana\ApiService\Http\Handlers;
use App\Filament\Resources\ReimburseResource;
use App\Filament\Resources\ReimburseResource\Api\Requests\CreateReimburseRequest;

class CreateHandler extends Handlers {
    public static string | null $uri = '/';
    public static string | null $resource = ReimburseResource::class;

    public static function getMethod()
    {
        return Handlers::POST;
    }

    public static function getModel() {
        return static::$resource::getModel();
    }

    /**
     * Create Reimburse
     *
     * @param CreateReimburseRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function handler(CreateReimburseRequest $request)
    {
        $model = new (static::getModel());

        $model->fill($request->all());

        $model->save();

        return static::sendSuccessResponse($model, "Successfully Create Resource");
    }
}