<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        require('data/states_state.php');
        require('data/colors_color.php');

        DB::table('states')->truncate();

        foreach ($states_state as $state) {
            $color = array_filter($colors_color, function ($color) use ($state) {
                return $color['id'] === $state['color_id'];
            });
            $color = array_shift($color);

            $colorHex = '';
            switch ($color['name']) {
                case 'Rouge':
                    $colorHex = '#f5222d';
                    break;
                case 'Bleu':
                    $colorHex = '#1890ff';
                    break;
                case 'Vert':
                    $colorHex = '#52c41a';
                    break;
                case 'Orange':
                    $colorHex = '#faad14';
                    break;
                case 'Gris':
                    $colorHex = '#808080';
                    break;
                default:
                    $colorHex = '';
                    break;
            }

            DB::table('states')->insert([
                'id' => $state['id'],
                'name' => $state['name'],
                'color' => $colorHex
            ]);
        }
    }
}
