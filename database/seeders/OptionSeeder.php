<?php

namespace Database\Seeders;

use App\Models\Option;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $options = [
            [
                'name' => 'Fotos',
                'type' => 1,
                'features' => [
                    [
                        'value' => '10',
                        'description' => '10 Fotos'
                    ],
                    [
                        'value' => '15',
                        'description' => '15 Fotos'
                    ],
                    [
                        'value' => '20',
                        'description' => '20 Fotos'
                    ],
                    [
                        'value' => '25',
                        'description' => '25 Fotos'
                    ]
                ]
            ]
        ];

        foreach ($options as $option) {
            $optionModel = Option::create([
                'name' => $option['name'],
                'type' => $option['type'],
            ]);

            foreach ($option['features'] as $feature) {
                $optionModel->features()->create([
                    'option_id' => $optionModel->id,
                    'value' => $feature['value'],
                    'description' => $feature['description']
                ]);
            }
        }
    }
}
