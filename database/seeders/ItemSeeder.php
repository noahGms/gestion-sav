<?php

namespace Database\Seeders;

use App\Models\Address;
use App\Models\Customer;
use App\Models\Item;
use App\Models\Part;
use Illuminate\Database\Seeder;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class ItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        require('data/items_item.php');

        DB::table('items')->truncate();
        DB::table('customers')->truncate();
        DB::table('addresses')->truncate();
        DB::table('parts')->truncate();
        DB::table('item_user')->truncate();

        foreach ($items_item as $item) {
            $addressPayload = [
                'street_number' => $item['trackNumber'],
                'street_name' => $item['trackName'],
                'zip_code' => $item['zipCode'],
                'city' => $item['city'],
                'updated_at' => $item['dateCreate'],
                'created_at' => $item['dateCreate'],
            ];

            $address = Address::create($addressPayload);

            $customerPayload = [
                'firstname' => $item['firstname'],
                'lastname' => $item['lastname'],
                'phone' => $item['phone'],
                'mobile1' => $item['mobile1'],
                'mobile2' => $item['mobile2'],
                'email' => $item['email'],
                'address_id' => $address->id,
                'updated_at' => $item['dateCreate'],
                'created_at' => $item['dateCreate'],
            ];
            $customer = Customer::create($customerPayload);

            $itemPayload = [
                'model' => $item['model'],
                'serial_number' => $item['serialNumber'],
                'defaults' => $item['default'],
                'return_date' => $item['date_return'],
                'comment_state' => $item['commentState'],
                'intervention_date' => $item['date_intervention'],
                'observations' => $item['observation'],
                'reparations' => $item['reparation'],
                'comments' => $item['comment'],
                'communications' => $item['communication'],
                'return_id' => $item['Return_id'],
                'brand_id' => $item['brand_id'],
                'depot_id' => $item['depot_id'],
                'state_id' => $item['state_id'],
                'type_id' => $item['type_id'],
                'intervention_id' => $item['intervention_id'],
                'archived_at' => $item['archived'] ? $item['dateEdit'] : null,
                'updated_at' => $item['dateEdit'],
                'created_at' => $item['dateCreate'],
                'customer_id' => $customer->id
            ];

            $itemEntity = Item::create($itemPayload);

            if ($item['piece1'] || $item['piecePrice1']) {
                Part::create([
                    'name' => $item['piece1'],
                    'price' => $this->formatPartPrice($item['piecePrice1']),
                    'item_id' => $itemEntity->id,
                    'updated_at' => $item['dateCreate'],
                    'created_at' => $item['dateCreate'],
                ]);
            }

            if ($item['piece2'] || $item['piecePrice2']) {
                Part::create([
                    'name' => $item['piece2'],
                    'price' => $this->formatPartPrice($item['piecePrice2']),
                    'item_id' => $itemEntity->id,
                    'updated_at' => $item['dateCreate'],
                    'created_at' => $item['dateCreate'],
                ]);
            }

            if ($item['piece3'] || $item['piecePrice3']) {
                Part::create([
                    'name' => $item['piece3'],
                    'price' => $this->formatPartPrice($item['piecePrice3']),
                    'item_id' => $itemEntity->id,
                    'updated_at' => $item['dateCreate'],
                    'created_at' => $item['dateCreate'],
                ]);
            }

            if ($item['piece4'] || $item['piecePrice4']) {
                Part::create([
                    'name' => $item['piece4'],
                    'price' => $this->formatPartPrice($item['piecePrice4']),
                    'item_id' => $itemEntity->id,
                    'updated_at' => $item['dateCreate'],
                    'created_at' => $item['dateCreate'],
                ]);
            }

            if ($item['piece5'] || $item['piecePrice5']) {
                Part::create([
                    'name' => $item['piece5'],
                    'price' => $this->formatPartPrice($item['piecePrice5']),
                    'item_id' => $itemEntity->id,
                    'updated_at' => $item['dateCreate'],
                    'created_at' => $item['dateCreate'],
                ]);
            }

            $users = collect();
            if ($tech1 = $item['technician1_id']) {
                $users->push($tech1);
            }

            if ($tech2 = $item['technician2_id']) {
                if (!$this->userExist($users, $tech2)) {
                    $users->push($tech2);
                }
            }

            if ($tech3 = $item['technician3_id']) {
                if (!$this->userExist($users, $tech3)) {
                    $users->push($tech3);
                }
            }

            if ($tech4 = $item['technician4_id']) {
                if (!$this->userExist($users, $tech4)) {
                    $users->push($tech4);
                }
            }

            $itemEntity->users()->attach($users);
        }
    }

    private function userExist(Collection $users, int $tech)
    {
        $userFiltered = $users->filter(function ($user) use ($tech) {
            return $user == $tech;
        });

        return $userFiltered->count();
    }

    private function formatPartPrice($price)
    {
        return $price ? str_replace(',', '.', $price) : null;
    }
}
