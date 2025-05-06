<?php
namespace App\Filament\Resources\ReimburseResource\Api\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\Reimburse;

/**
 * @property Reimburse $resource
 */
class ReimburseTransformer extends JsonResource
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
