<?php
namespace App\Filament\Resources\PengajuanResource\Api\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\Pengajuan;

/**
 * @property Pengajuan $resource
 */
class PengajuanTransformer extends JsonResource
{

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return $this->resource->toArray();
    }
}
