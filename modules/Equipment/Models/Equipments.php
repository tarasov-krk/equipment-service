<?php

namespace Modules\Equipment\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Equipments extends Model
{
    use SoftDeletes;

    protected $fillable = [
        "equipment_type_id",
        "serial_number",
        "description",
    ];

    /**
     * Поля, которые можно использовать в фильтрации
     *
     * @var array|string[]
     */
    public static array $filteredColumns = [
        "id",
        "serial_number",
    ];

    /**
     * Тип оборудования
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function equipmentType(): BelongsTo
    {
        return $this->belongsTo(EquipmentTypes::class);
    }
}
