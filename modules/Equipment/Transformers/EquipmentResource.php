<?php

namespace Modules\Equipment\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;

class EquipmentResource extends JsonResource
{
    public static $wrap = null;

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
            "id"             => $this->id,
            "equipment_type" => EquipmentTypeResource::make($this->equipmentType),
            "serial_number"  => $this->serial_number,
            "desc"           => $this->description,
            "created_at"     => $this->created_at->toDateTimeString(),
            "updated_at"     => $this->updated_at->toDateTimeString(),
        ];
    }
}
