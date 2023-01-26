<?php declare(strict_types=1);

namespace Modules\Equipment\Repositories;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Modules\Equipment\Models\Equipments;
use Modules\Equipment\Repositories\Criteries\FilterFieldCriteria;
use TarasovKrk\LaravelAbstraction\Repositories\AbstractRepository;

class EquipmentRepository extends AbstractRepository
{
    public function __construct(Equipments $model)
    {
        parent::__construct($model);
    }

    /**
     * @param array $filter
     * @return mixed
     */
    public function getAll(array $filter = [], $count = null): LengthAwarePaginator
    {
        return $this
            ->addCriteria(new FilterFieldCriteria(Equipments::$filteredColumns, $filter))
            ->paginate($count ?? 10);
    }
}
