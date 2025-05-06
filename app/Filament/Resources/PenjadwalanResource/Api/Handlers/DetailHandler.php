<?php

namespace App\Filament\Resources\PenjadwalanResource\Api\Handlers;

use App\Filament\Resources\SettingResource;
use App\Filament\Resources\PenjadwalanResource;
use Rupadana\ApiService\Http\Handlers;
use Spatie\QueryBuilder\QueryBuilder;
use Illuminate\Http\Request;
use App\Filament\Resources\PenjadwalanResource\Api\Transformers\PenjadwalanTransformer;

class DetailHandler extends Handlers
{
    public static string | null $uri = '/{id}';
    public static string | null $resource = PenjadwalanResource::class;


    /**
     * Show Penjadwalan
     *
     * @param Request $request
     * @return PenjadwalanTransformer
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

        return new PenjadwalanTransformer($query);
    }
}
