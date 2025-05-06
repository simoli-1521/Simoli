<?php

namespace App\Filament\Resources\BookRequestResource\Api\Handlers;

use App\Filament\Resources\SettingResource;
use App\Filament\Resources\BookRequestResource;
use Rupadana\ApiService\Http\Handlers;
use Spatie\QueryBuilder\QueryBuilder;
use Illuminate\Http\Request;
use App\Filament\Resources\BookRequestResource\Api\Transformers\BookRequestTransformer;

class DetailHandler extends Handlers
{
    public static string | null $uri = '/{id}';
    public static string | null $resource = BookRequestResource::class;


    /**
     * Show BookRequest
     *
     * @param Request $request
     * @return BookRequestTransformer
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

        return new BookRequestTransformer($query);
    }
}
