<?php

namespace App\Http\Controllers\Centrometal;

use App\Http\Controllers\Controller;

class HumanizedStatusController extends StatusController
{
    private $status_mapping = [
        'B_Tk1' => ['boiler_temperature', 'Boiler temperature'],
        'B_Tptv1' => ['water_boiler_temperature', 'Water boiler temperature'],
        'B_Tak1_1' => ['accumulation_tank_top_temperature', 'Accumulation tank top temperature'],
        'B_Tak2_1' => ['accumulation_tank_bottom_temperature', 'Accumulation tank Bottom temperature'],
        'B_Tpov1' => ['flow_temperature', 'Flow temperature'],
        'B_Tdpl1' => ['flue_gas_tmperature', 'Flue gas temperature'],

        'B_Oxy1' => ['oxygen_in_flue_gases', 'Oxygen in flue gases %'],


        'B_P3' => ['water_boilter_pump', 'Water boiler pump', [
            'values' => ['off', 'on']
        ]],
        'B_P2' => ['heating_circuit_pump', 'Heating circuit pump', [
            'values' => ['off', 'on']
        ]],

        'B_gri' => ['electric_heater', 'Electric heater', [
            'values' => ['off', 'on']
        ]],
        'B_fan' => ['fan_operation', 'Fan status', [
            'values' => ['off'],
            'default_value' => 'on'
        ]],

        'B_FotV' => ['flame', 'Flame', [
            'values' => [1001 => 'off'],
            'default_value' => 'on'
        ]],


        'B_razina' => ['pellet_level', 'Level of fuel pellets', [
            'values' => ['low', 'medium', 'full']
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

            unset($data[$source_key]);
        }

        return $values;
    }
}
