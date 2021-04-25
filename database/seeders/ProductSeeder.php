<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $category = Category::create([
            'name' => 'konyhai eszkozok'
        ]);


        Product::create([
            'name' => 'Kés',
            'price' => 10,
            'description' => 'Ez egy konyhakés',
            'attributes' => ['hossz' => '10 cm', 'fogantyu' => 'fa'],
            'category_id' => $category->getKey()
        ]);
        Product::create([
            'name' => 'Villa',
            'price' => 15,
            'description' => 'Ez egy étekző villa',
            'attributes' => ['hossz' => '12 cm', 'fogantyu' => 'fém'],
            'category_id' => $category->getKey()
        ]);
    }
}
