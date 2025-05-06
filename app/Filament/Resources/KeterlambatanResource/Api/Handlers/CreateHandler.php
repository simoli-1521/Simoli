<?php
namespace App\Filament\Resources\KeterlambatanResource\Api\Handlers;

use Illuminate\Http\Request;
use Rupadana\ApiService\Http\Handlers;
use App\Filament\Resources\KeterlambatanResource;
use App\Filament\Resources\KeterlambatanResource\Api\Requests\CreateKeterlambatanRequest;

class CreateHandler extends Handlers {
    public static string | null $uri = '/';
    public static string | null $resource = KeterlambatanResource::class;

    public static function getMethod()
    {
        return Handlers::POST;
    }

    public static function getModel() {
        return static::$resource::getModel();
    }

    /**
     * Create Keterlambatan
     *
     * @param CreateKeterlambatanRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function handler(CreateKeterlambatanRequest $request)
    {
        $model = new (static::getModel());

        $model->fill($request->all());

        $model->save();

        return static::sendSuccessResponse($model, "Successfully Create Resource");
    }
}