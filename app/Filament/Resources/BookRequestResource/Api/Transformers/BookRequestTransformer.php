<?php
namespace App\Filament\Resources\BookRequestResource\Api\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\BookRequest;

/**
 * @property BookRequest $resource
 */
class BookRequestTransformer extends JsonResource
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
