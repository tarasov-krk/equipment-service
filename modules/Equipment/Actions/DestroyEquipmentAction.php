<?php declare(strict_types=1);

namespace Modules\Equipment\Actions;

use Modules\Equipment\Repositories\EquipmentRepository;

/**
 * Class DestroyEquipmentAction
 *
 * Удалить оборудование
 *
 * @package Modules\Equipment\Actions
 */
final class DestroyEquipmentAction
{
    public function __construct(
        protected EquipmentRepository $repository
    ) {
    }

    public function run(int $id)
    {
        return $this->repository->destroy($id);
    }
}
