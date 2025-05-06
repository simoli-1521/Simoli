<?php

namespace App\Filament\Resources\SuratResource\Api\Handlers;

use App\Filament\Resources\SettingResource;
use App\Filament\Resources\SuratResource;
use Rupadana\ApiService\Http\Handlers;
use Spatie\QueryBuilder\QueryBuilder;
use Illuminate\Http\Request;
use App\Filament\Resources\SuratResource\Api\Transformers\SuratTransformer;

class DetailHandler extends Handlers
{
    public static string | null $uri = '/{id}';
    public static string | null $resource = SuratResource::class;


    /**
     * Show Surat
     *
     * @param Request $request
     * @return SuratTransformer
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

        return new SuratTransformer($query);
    }
}
