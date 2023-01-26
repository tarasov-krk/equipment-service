<?php declare(strict_types=1);

namespace Modules\Equipment\Actions;

use Modules\Equipment\Repositories\EquipmentRepository;
use Modules\Equipment\Tasks\ValidateEquipmentDataTask;
use Modules\Equipment\Transformers\EquipmentResource;

/**
 * Class StoreEquipmentAction
 *
 * Сохранить оборудование
 *
 * @package Modules\Equipment\Actions
 */
final class StoreEquipmentAction
{
    public function __construct(
        protected EquipmentRepository $repository
    ) {
    }

    public function run(array $data): array
    {
        $fails = app(ValidateEquipmentDataTask::class)->run($data);
        $success = [];

        $validData = array_diff_key($data, $fails);

        // Сохранить оборудование
        foreach ($validData as $key => $item) {
            try {
                $equipment = $this->repository->store([
                    "equipment_type_id" => $item["equipment_type_id"],
                    "serial_number"     => $item["serial_number"],
                    "description"       => $item["desc"],
                ]);
                $success[$key] = EquipmentResource::make($equipment);
            } catch (\Throwable $e) {
                report($e);
                $fails[$key] = [__("Could not save to database")];
            }
        }

        ksort($fails);

        return [
            "errors"  => $fails,
            "success" => $success,
        ];
    }
}
