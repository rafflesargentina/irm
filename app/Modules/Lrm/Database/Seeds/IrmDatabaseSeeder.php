<?php

namespace Raffles\Modules\Lrm\Database\Seeds;

use Illuminate\Database\Seeder;

class LrmDatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(ContactsTableSeeder::class);
        $this->call(SubscriptionListsTableSeeder::class);
    }
}
