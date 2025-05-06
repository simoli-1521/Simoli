<?php
namespace App\Filament\Resources\PenilaianPegawaiResource\Api\Handlers;

use Illuminate\Http\Request;
use Rupadana\ApiService\Http\Handlers;
use App\Filament\Resources\PenilaianPegawaiResource;
use App\Filament\Resources\PenilaianPegawaiResource\Api\Requests\UpdatePenilaianPegawaiRequest;

class UpdateHandler extends Handlers {
    public static string | null $uri = '/{id}';
    public static string | null $resource = PenilaianPegawaiResource::class;

    public static function getMethod()
    {
        return Handlers::PUT;
    }

    public static function getModel() {
        return static::$resource::getModel();
    }


    /**
     * Update PenilaianPegawai
     *
     * @param UpdatePenilaianPegawaiRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function handler(UpdatePenilaianPegawaiRequest $request)
    {
        $id = $request->route('id');

        $model = static::getModel()::find($id);

        if (!$model) return static::sendNotFoundResponse();

        $model->fill($request->all());

        $model->save();

        return static::sendSuccessResponse($model, "Successfully Update Resource");
    }
}