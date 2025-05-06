<?php

namespace App\Filament\Resources\KehadiranResource\Api\Handlers;

use App\Filament\Resources\SettingResource;
use App\Filament\Resources\KehadiranResource;
use Rupadana\ApiService\Http\Handlers;
use Spatie\QueryBuilder\QueryBuilder;
use Illuminate\Http\Request;
use App\Filament\Resources\KehadiranResource\Api\Transformers\KehadiranTransformer;

class DetailHandler extends Handlers
{
    public static string | null $uri = '/{id}';
    public static string | null $resource = KehadiranResource::class;


    /**
     * Show Kehadiran
     *
     * @param Request $request
     * @return KehadiranTransformer
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

        return new KehadiranTransformer($query);
    }
}
