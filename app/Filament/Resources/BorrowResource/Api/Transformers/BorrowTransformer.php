<?php
namespace App\Filament\Resources\BorrowResource\Api\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\Borrow;

/**
 * @property Borrow $resource
 */
class BorrowTransformer extends JsonResource
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
