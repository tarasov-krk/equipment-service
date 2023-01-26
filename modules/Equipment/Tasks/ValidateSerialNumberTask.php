<?php declare(strict_types=1);

namespace Modules\Equipment\Tasks;

use Modules\Equipment\Models\EquipmentTypes;

final class ValidateSerialNumberTask
{
    public function run(array $data): array
    {
        $fails = [];
        $maskRules = config("equipment.serial_number_mask_rules");

        foreach ($data as $key => $item) {
            $mask = EquipmentTypes::query()->find($item["equipment_type_id"])?->mask;
            if (!$mask) {
                $fails[$key] = [__("validation.exists", ["attribute" => $key . ".equipment_type_id"])];
            }

            $serialNumber = str_split($item["serial_number"]);
            $mask = str_split($mask);

            foreach ($serialNumber as $itemKey => $char) {
                if (empty($maskRules[$mask[$itemKey]]) || !preg_match($maskRules[$mask[$itemKey]], $char)) {
                    $fails[$key] = [__("The $key.serial_number incorrect")];
                    break;
                }
            }
        }

        return $fails;
    }
}
