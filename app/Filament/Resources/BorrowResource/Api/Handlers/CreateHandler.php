<?php
namespace App\Filament\Resources\BorrowResource\Api\Handlers;

use Illuminate\Http\Request;
use Rupadana\ApiService\Http\Handlers;
use App\Filament\Resources\BorrowResource;
use App\Filament\Resources\BorrowResource\Api\Requests\CreateBorrowRequest;

class CreateHandler extends Handlers {
    public static string | null $uri = '/';
    public static string | null $resource = BorrowResource::class;

    public static function getMethod()
    {
        return Handlers::POST;
    }

    public static function getModel() {
        return static::$resource::getModel();
    }

    /**
     * Create Borrow
     *
     * @param CreateBorrowRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function handler(CreateBorrowRequest $request)
    {
        $model = new (static::getModel());

        $model->fill($request->all());

        $model->save();

        return static::sendSuccessResponse($model, "Successfully Create Resource");
    }
}