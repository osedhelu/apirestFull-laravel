<?php
use App\Category;
use App\User;
use App\Product;
use App\Seller;
use App\Transaction;
$factory->define(User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
        'verified' => $verificador = $faker->randomElement([User::disable, User::enable]),
        'verification_token' => $verificador == User::enable ? null : User::generateToken(),
        'role' => $faker->randomElement([User::userAdmin, User::userRegular]),
    ];
});
$factory->define(Category::class, function (Faker\Generator $faker) {

    return [
        'name' => $faker->word,
        'description' => $faker->paragraph(1),
    ];
});

$factory->define(Product::class, function (Faker\Generator $faker) {

    return [
        'name' => $faker->word,
        'description' => $faker->paragraph(1),
        'quantify' => $faker->numberBetween(1, 10),
        'status' => $faker->randomElement(Product::enable, Product::disable),
        'image' => $faker->randomElement(['1.png', '2.jpg', '3.jpg']),
        'seller_id' => User::all()->random()->id,
    ];
});

$factory->define(Transaction::class, function (Faker\Generator $faker) {
    $vendedor = Seller::has('products')->get()->random();
    $comprador = User::all()->except($vendedor->id)->random();
    return [
        'quantify' => $faker->numberBetween(1, 10),
        'buyer_id' => $comprador->id,
        'seller_id' => $vendedor->products->random()->id,
    ];
});

