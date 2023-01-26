<?php declare(strict_types=1);

namespace Modules\Equipment\Actions;

use Modules\Equipment\Repositories\EquipmentRepository;
use Modules\Equipment\Tasks\ValidateSerialNumberTask;

/**
 * Class UpdateEquipmentAction
 *
 * Обновить данные по оборудованию
 *
 * @package Modules\Equipment\Actions
 */
final class UpdateEquipmentAction
{
    public function __construct(
        protected EquipmentRepository $repository
    ) {
    }

    public function run(int $id, array $data)
    {
        $fails = app(ValidateSerialNumberTask::class)->run([$data]);
        if ($fails) {
            throw new \InvalidArgumentException(__("The serial_number incorrect"));
        }

        $this->repository->update($id, [
            "equipment_type_id" => $data["equipment_type_id"],
            "serial_number"     => $data["serial_number"],
            "description"       => $data["desc"],
        ]);

        return $this->repository->get($id);
    }
}
