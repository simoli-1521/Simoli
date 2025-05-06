<?php
namespace App\Filament\Resources\PenilaianPegawaiResource\Api\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\PenilaianPegawai;

/**
 * @property PenilaianPegawai $resource
 */
class PenilaianPegawaiTransformer extends JsonResource
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
