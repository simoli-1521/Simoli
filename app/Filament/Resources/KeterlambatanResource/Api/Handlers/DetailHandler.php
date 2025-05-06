<?php

namespace App\Filament\Resources\KeterlambatanResource\Api\Handlers;

use App\Filament\Resources\SettingResource;
use App\Filament\Resources\KeterlambatanResource;
use Rupadana\ApiService\Http\Handlers;
use Spatie\QueryBuilder\QueryBuilder;
use Illuminate\Http\Request;
use App\Filament\Resources\KeterlambatanResource\Api\Transformers\KeterlambatanTransformer;

class DetailHandler extends Handlers
{
    public static string | null $uri = '/{id}';
    public static string | null $resource = KeterlambatanResource::class;


    /**
     * Show Keterlambatan
     *
     * @param Request $request
     * @return KeterlambatanTransformer
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

        return new KeterlambatanTransformer($query);
    }
}
