<?php declare(strict_types=1);

namespace Modules\Equipment\Repositories\Criteries;

use Illuminate\Database\Eloquent\Builder;
use TarasovKrk\LaravelRepository\Contracts\CriteriaContract;

class FilterFieldCriteria implements CriteriaContract
{
    public function __construct(
        protected array $filteredColumns,
        protected array $filter = [],
    ) {
    }

    public function apply(Builder $query)
    {
        $whereColumns = !empty($this->filter["q"]) ? $this->filter["q"] : $this->filter;

        foreach ($this->filteredColumns as $column) {
            if (isset($whereColumns[$column])) {
                $query->where($column, trim($whereColumns[$column]));
            }
        }
    }
}
