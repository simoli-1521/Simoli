<?php

namespace App\Filament\Resources\BorrowResource\Api\Handlers;

use App\Filament\Resources\SettingResource;
use App\Filament\Resources\BorrowResource;
use Rupadana\ApiService\Http\Handlers;
use Spatie\QueryBuilder\QueryBuilder;
use Illuminate\Http\Request;
use App\Filament\Resources\BorrowResource\Api\Transformers\BorrowTransformer;

class DetailHandler extends Handlers
{
    public static string | null $uri = '/{id}';
    public static string | null $resource = BorrowResource::class;


    /**
     * Show Borrow
     *
     * @param Request $request
     * @return BorrowTransformer
     */
    public function handler(Request $request)
    {
        $id = $request->route('id');
        
        $query = static::getEloquentQuery();

        $query = QueryBuilder::for(
            $query->where(static::getKeyName(), $id)
        )
            ->first();

        if (!$query) return static::sendNotFoundResponse();

        return new BorrowTransformer($query);
    }
}
