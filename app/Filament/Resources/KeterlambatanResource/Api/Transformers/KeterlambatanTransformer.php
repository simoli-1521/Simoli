<?php
namespace App\Filament\Resources\KeterlambatanResource\Api\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\Keterlambatan;

/**
 * @property Keterlambatan $resource
 */
class KeterlambatanTransformer extends JsonResource
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
