<?php

namespace Modules\Equipment\Models;

use Illuminate\Database\Eloquent\Model;

class EquipmentTypes extends Model
{
    protected $fillable = [
        "name",
        "mask",
    ];

    /**
     * Поля, которые можно использовать в фильтрации
     *
     * @var array|string[]
     */
    public static array $filteredColumns = [
        "id",
        "name",
        "mask",
    ];
}
