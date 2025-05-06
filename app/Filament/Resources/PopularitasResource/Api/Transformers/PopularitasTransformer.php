<?php
namespace App\Filament\Resources\PopularitasResource\Api\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\Popularitas;

/**
 * @property Popularitas $resource
 */
class PopularitasTransformer extends JsonResource
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
