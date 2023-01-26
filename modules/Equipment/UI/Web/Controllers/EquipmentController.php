<?php declare(strict_types=1);

namespace Modules\Equipment\UI\Web\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Modules\Equipment\Actions\DestroyEquipmentAction;
use Modules\Equipment\Actions\GetEquipmentAction;
use Modules\Equipment\Actions\GetEquipmentsFilteredAction;
use Modules\Equipment\Actions\StoreEquipmentAction;
use Modules\Equipment\Actions\UpdateEquipmentAction;
use Modules\Equipment\Transformers\EquipmentResource;
use Modules\Equipment\Transformers\ErrorResource;
use Modules\Equipment\UI\Web\Requests\DestroyEquipmentRequest;
use Modules\Equipment\UI\Web\Requests\UpdateEquipmentRequest;

class EquipmentController extends Controller
{
    /**
     * Получить список оборудования с фильтрацией
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(Request $request): AnonymousResourceCollection
    {
        $data = app(GetEquipmentsFilteredAction::class)->run($request->all());

        return EquipmentResource::collection($data);
    }

    /**
     * Добавить запись об оборудовании
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        $result = app(StoreEquipmentAction::class)->run($request->all());

        return response()->json($result);
    }

    /**
     * Получить данные по оборудованию
     *
     * @param $id
     * @return \Modules\Equipment\Transformers\EquipmentResource
     */
    public function show($id): EquipmentResource
    {
        $data = app(GetEquipmentAction::class)->run((int)$id);

        return EquipmentResource::make($data);
    }

    /**
     * Обновить информацию по оборудованию
     *
     * @param \Modules\Equipment\UI\Web\Requests\UpdateEquipmentRequest $request
     * @param                                                           $id
     * @return \Modules\Equipment\Transformers\EquipmentResource|\Modules\Equipment\Transformers\ErrorResource
     */
    public function update(UpdateEquipmentRequest $request, $id): EquipmentResource|ErrorResource
    {
        try {
            $equipment = app(UpdateEquipmentAction::class)->run((int)$id, $request->validated());
        } catch (\InvalidArgumentException $ex) {
            return ErrorResource::make(["errors" => [$ex->getMessage()]]);
        } catch (\Throwable $ex) {
            return ErrorResource::make(["errors" => [__("Could not update equipment")]]);
        }

        return EquipmentResource::make($equipment);
    }

    /**
     * Удалить оборудование
     *
     * @param \Modules\Equipment\UI\Web\Requests\DestroyEquipmentRequest $request
     * @param int                                                        $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(DestroyEquipmentRequest $request, $id): JsonResponse
    {
        app(DestroyEquipmentAction::class)->run((int)$id);

        return response()->json(["success" => true]);
    }
}
