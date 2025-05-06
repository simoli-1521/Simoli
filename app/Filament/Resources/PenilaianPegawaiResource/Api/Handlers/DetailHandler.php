<?php

namespace App\Filament\Resources\PenilaianPegawaiResource\Api\Handlers;

use App\Filament\Resources\SettingResource;
use App\Filament\Resources\PenilaianPegawaiResource;
use Rupadana\ApiService\Http\Handlers;
use Spatie\QueryBuilder\QueryBuilder;
use Illuminate\Http\Request;
use App\Filament\Resources\PenilaianPegawaiResource\Api\Transformers\PenilaianPegawaiTransformer;

class DetailHandler extends Handlers
{
    public static string | null $uri = '/{id}';
    public static string | null $resource = PenilaianPegawaiResource::class;


    /**
     * Show PenilaianPegawai
     *
     * @param Request $request
     * @return PenilaianPegawaiTransformer
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

        return new PenilaianPegawaiTransformer($query);
    }
}
