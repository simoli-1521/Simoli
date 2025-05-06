<?php
namespace App\Filament\Resources\PenjadwalanResource\Api\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\Penjadwalan;

/**
 * @property Penjadwalan $resource
 */
class PenjadwalanTransformer extends JsonResource
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
