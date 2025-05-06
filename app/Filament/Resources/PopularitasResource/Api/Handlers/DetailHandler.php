<?php

namespace App\Filament\Resources\PopularitasResource\Api\Handlers;

use App\Filament\Resources\SettingResource;
use App\Filament\Resources\PopularitasResource;
use Rupadana\ApiService\Http\Handlers;
use Spatie\QueryBuilder\QueryBuilder;
use Illuminate\Http\Request;
use App\Filament\Resources\PopularitasResource\Api\Transformers\PopularitasTransformer;

class DetailHandler extends Handlers
{
    public static string | null $uri = '/{id}';
    public static string | null $resource = PopularitasResource::class;


    /**
     * Show Popularitas
     *
     * @param Request $request
     * @return PopularitasTransformer
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

        return new PopularitasTransformer($query);
    }
}
