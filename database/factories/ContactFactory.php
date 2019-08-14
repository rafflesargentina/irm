<?php

use Raffles\Models\User;

use Faker\Generator as Faker;

$factory->define(Raffles\Models\Contact::class, function (Faker $faker) {
    $email = $faker->unique()->email;
    $slug = str_slug($email);

    return [
        'contactable_id' => '1',
        'contactable_type' => 'Raffles\Models\User',
        'email' => $email,
        'first_name' => $faker->firstName,
        'fax' => $faker->phoneNumber,
        'last_name' => $faker->lastName,
        'mobile' => $faker->phoneNumber,
        'phone' => $faker->phoneNumber,
        'position' => $faker->word,
        'slug' => $slug,
        'user_id' => '1',
        'website' => $faker->domainName,
    ];
});
