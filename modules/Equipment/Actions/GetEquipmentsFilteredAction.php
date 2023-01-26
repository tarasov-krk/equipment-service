<?php declare(strict_types=1);

namespace Modules\Equipment\Actions;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Modules\Equipment\Repositories\EquipmentRepository;

/**
 * Class GetEquipmentsFilteredAction
 *
 * Получить список Оборудования с фильтрацией
 *
 * @package Modules\Equipment\Actions
 */
final class GetEquipmentsFilteredAction
{
    public function __construct(
        protected EquipmentRepository $repository
    ) {
    }

    public function run(array $filter = [], $count = null): LengthAwarePaginator
    {
        return $this->repository->getAll($filter, $count);
    }
}
