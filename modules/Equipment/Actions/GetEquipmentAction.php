<?php declare(strict_types=1);

namespace Modules\Equipment\Actions;

use Modules\Equipment\Models\Equipments;
use Modules\Equipment\Repositories\EquipmentRepository;

/**
 * Class GetEquipmentAction
 *
 * Получить данные по Оборудованию
 *
 * @package Modules\Equipment\Actions
 */
final class GetEquipmentAction
{
    public function __construct(
        protected EquipmentRepository $repository
    ) {
    }

    public function run(int $id): ?Equipments
    {
        return $this->repository->get($id);
    }
}
