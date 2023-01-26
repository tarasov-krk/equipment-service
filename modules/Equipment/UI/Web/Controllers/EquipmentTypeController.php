<?php declare(strict_types=1);

namespace Modules\Equipment\UI\Web\Controllers;

use App\Http\Controllers\Controller;
use App\Models\EquipmentType;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Modules\Equipment\Actions\GetEquipmentTypesFilteredAction;
use Modules\Equipment\Transformers\EquipmentTypeResource;

class EquipmentTypeController extends Controller
{
    /**
     * Получить список типов оборудования с фильтрацией
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(Request $request): AnonymousResourceCollection
    {
        $data = app(GetEquipmentTypesFilteredAction::class)->run($request->all());

        return EquipmentTypeResource::collection($data);
    }
}
