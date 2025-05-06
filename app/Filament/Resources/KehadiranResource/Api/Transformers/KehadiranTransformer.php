<?php
namespace App\Filament\Resources\KehadiranResource\Api\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\Kehadiran;

/**
 * @property Kehadiran $resource
 */
class KehadiranTransformer extends JsonResource
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
