<?php

namespace App\Http\Controllers\Centrometal;

use App\Http\Controllers\Controller;

class HumanizedStatusController extends StatusController
{
    private $status_mapping = [
        'B_Tptv1' => ['water_boiler_temperature', 'Water boiler temperature'],
        'B_Tak1_1' => ['accumulation_tank_top_temp', 'Accumulation tank top temperature'],
        'B_Tak2_1' => ['accumulation_tank_bottom_temp', 'Accumulation tank Bottom temperature'],
        'B_Tdpl1' => ['chimney_temperature', 'Chimney temperature'],
        'B_razina' => ['pellet_level', 'Level of fuel pellets', [
            'values' => ['low', 'medium', 'full']
        ]], /*0 low, 1 medium, 2 full */
        'B_Oxy1' => ['chimney_oxygen_sensor', 'Chimney oxygen sensor'],
        'B_gri' => ['burner_heater', 'Burner heater', [
            'values' => ['off', 'on']
        ]],
        'B_FotV' => ['flame', 'Flame', [
            'values' => [1001 => 'off'],
            'default_value' => 'on'
        ]]
    ];

    public function data()
    {
        $data = current(json_decode($this->index(
             [env('CENTROMETAL_INSTALLATION_ID')]
        ), true))['params'];

        $values = [];
        foreach($this->status_mapping as $source_key => $target)
        {
            if(!isset($data[$source_key])) continue;

            $value = $data[$source_key]['v'];

            if(isset($target[2]['values']))
            {
                if(isset($target[2]['values'][$value]))
                {
                    $value = $target[2]['values'][$value];
                }
                else
                {
                    $value = $target[2]['default_value'];
                }
            }


            $values[$target[0]] = [
                'name' => $target[1],
                'value' => $value,
                'time' => $data[$source_key]['ut']
            ];

        }

        return $values;
    }
}
