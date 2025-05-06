<?php
namespace App\Filament\Resources\PengajuanResource\Api\Handlers;

use Illuminate\Http\Request;
use Rupadana\ApiService\Http\Handlers;
use App\Filament\Resources\PengajuanResource;
use App\Filament\Resources\PengajuanResource\Api\Requests\UpdatePengajuanRequest;

class UpdateHandler extends Handlers {
    public static string | null $uri = '/{id}';
    public static string | null $resource = PengajuanResource::class;

    public static function getMethod()
    {
        return Handlers::PUT;
    }

    public static function getModel() {
        return static::$resource::getModel();
    }


    /**
     * Update Pengajuan
     *
     * @param UpdatePengajuanRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function handler(UpdatePengajuanRequest $request)
    {
        $id = $request->route('id');

        $model = static::getModel()::find($id);

        if (!$model) return static::sendNotFoundResponse();

        $model->fill($request->all());

        $model->save();

        return static::sendSuccessResponse($model, "Successfully Update Resource");
    }
}