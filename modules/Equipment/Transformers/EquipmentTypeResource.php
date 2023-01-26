<?php

namespace Modules\Equipment\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;

class EquipmentTypeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request): array
    {
        if (is_null($this->resource)) {
            return [];
        }

        return [
            "id"   => $this->id,
            "name" => $this->name,
            "mask" => $this->mask,
        ];
    }
}
