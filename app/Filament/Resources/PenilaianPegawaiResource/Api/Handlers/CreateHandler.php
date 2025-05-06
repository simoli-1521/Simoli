<?php
namespace App\Filament\Resources\PenilaianPegawaiResource\Api\Handlers;

use Illuminate\Http\Request;
use Rupadana\ApiService\Http\Handlers;
use App\Filament\Resources\PenilaianPegawaiResource;
use App\Filament\Resources\PenilaianPegawaiResource\Api\Requests\CreatePenilaianPegawaiRequest;

class CreateHandler extends Handlers {
    public static string | null $uri = '/';
    public static string | null $resource = PenilaianPegawaiResource::class;

    public static function getMethod()
    {
        return Handlers::POST;
    }

    public static function getModel() {
        return static::$resource::getModel();
    }

    /**
     * Create PenilaianPegawai
     *
     * @param CreatePenilaianPegawaiRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function handler(CreatePenilaianPegawaiRequest $request)
    {
        $model = new (static::getModel());

        $model->fill($request->all());

        $model->save();

        return static::sendSuccessResponse($model, "Successfully Create Resource");
    }
}