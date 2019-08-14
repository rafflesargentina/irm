<?php

namespace Raffles\Modules\Lrm\Database\Seeds;

use Raffles\Modules\Lrm\Models\SubscriptionList;

use Illuminate\Database\Seeder;

class SubscriptionListsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $subscriptionLists = [
            ['name' => 'MKTRE'],
            ['name' => 'Proptech Latam'],
            ['name' => 'Prensa Real Estate']
        ];

        foreach ($subscriptionLists as $subscriptionList) {
            SubscriptionList::create($subscriptionList);
        }
    }
}
