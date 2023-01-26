<?php declare(strict_types=1);

namespace Modules\Equipment\Actions;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Modules\Equipment\Repositories\EquipmentTypeRepository;

/**
 * Class GetEquipmentTypesFilteredAction
 *
 * Получить Типы Оборудования с фильтрацией
 *
 * @package Modules\Equipment\Actions
 */
final class GetEquipmentTypesFilteredAction
{
    public function __construct(
        protected EquipmentTypeRepository $repository
    ) {
    }

    public function run(array $filter = [], $count = null): LengthAwarePaginator
    {
        return $this->repository->getAll($filter, $count);
    }
}
