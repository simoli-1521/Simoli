<?php
namespace App\Filament\Resources\BorrowResource\Api\Handlers;

use Illuminate\Http\Request;
use Rupadana\ApiService\Http\Handlers;
use App\Filament\Resources\BorrowResource;
use App\Filament\Resources\BorrowResource\Api\Requests\UpdateBorrowRequest;

class UpdateHandler extends Handlers {
    public static string | null $uri = '/{id}';
    public static string | null $resource = BorrowResource::class;

    public static function getMethod()
    {
        return Handlers::PUT;
    }

    public static function getModel() {
        return static::$resource::getModel();
    }


    /**
     * Update Borrow
     *
     * @param UpdateBorrowRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function handler(UpdateBorrowRequest $request)
    {
        $id = $request->route('id');

        $model = static::getModel()::find($id);

        if (!$model) return static::sendNotFoundResponse();

        $model->fill($request->all());

        $model->save();

        return static::sendSuccessResponse($model, "Successfully Update Resource");
    }
}