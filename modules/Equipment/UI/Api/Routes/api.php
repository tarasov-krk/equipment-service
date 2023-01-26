<?php

use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;
use Modules\Equipment\UI\Web\Controllers\EquipmentController;
use Modules\Equipment\UI\Web\Controllers\EquipmentTypeController;

Route::resource('equipment', EquipmentController::class);

Route::group(["prefix" => "equipment-type", "as" => "api.equipment_type."], function (Router $router)
{
    $router->get('/', [EquipmentTypeController::class, "index"])->name("index");
});
