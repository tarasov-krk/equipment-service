<?php declare(strict_types=1);

namespace Modules\Equipment\Tasks;

use Illuminate\Support\Facades\Validator;

final class ValidateEquipmentDataTask
{
    public function run(array $data): array
    {
        $validator = Validator::make($data, [
            "*.equipment_type_id" => 'required|integer',
            "*.serial_number"     => "required|string|size:10",
            "*.desc"              => "string|max:255",
        ]);

        $fails = [];

        if ($validator->fails()) {
            foreach ($validator->errors()->getMessages() as $attribute => $messages) {
                $fails[\Str::substr($attribute, 0, 1)] = $messages;
            }
        }

        $validData = array_diff_key($data, $fails);

        $failsSerialNumber = app(ValidateSerialNumberTask::class)->run($validData);

        return $fails + $failsSerialNumber;
    }
}
