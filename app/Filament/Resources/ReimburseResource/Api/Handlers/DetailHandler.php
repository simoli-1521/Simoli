<?php

namespace App\Filament\Resources\ReimburseResource\Api\Handlers;

use App\Filament\Resources\SettingResource;
use App\Filament\Resources\ReimburseResource;
use Rupadana\ApiService\Http\Handlers;
use Spatie\QueryBuilder\QueryBuilder;
use Illuminate\Http\Request;
use App\Filament\Resources\ReimburseResource\Api\Transformers\ReimburseTransformer;

class DetailHandler extends Handlers
{
    public static string | null $uri = '/{id}';
    public static string | null $resource = ReimburseResource::class;


    /**
     * Show Reimburse
     *
     * @param Request $request
     * @return ReimburseTransformer
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

        return new ReimburseTransformer($query);
    }
}
