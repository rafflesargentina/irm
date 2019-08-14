<?php

namespace Raffles\Modules\Lrm\Database\Seeds;

use Raffles\Modules\Lrm\Models\User;

use Illuminate\Database\Seeder;

class ContactsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->_panamaContacts();
        $this->_paraguayContacts();
        $this->_uruguayContacts();
    }

    private function _panamaContacts()
    {
        $file = module_path('irm', 'Database', 'app').'/contacts_panama.csv';
        $handle = fopen($file, "r");

        if (empty($handle) === false) {
            while (($data = fgetcsv($handle, 1000, ";")) !== FALSE ) {
                $arrResult[] = $data;
            }
            fclose($handle);
        }

        $user = User::firstOrCreate(['email' => 'andrea@mktre.com'], ['first_name' => 'Andrea', 'last_name' => 'Rodriguez', 'email' => 'andrea@mktre.com', 'password' => 'abcd1234']);

        foreach (array_slice($arrResult,1) as $result) {

            $source = $result[0];
            $company = $result[1];
            $name = $result[2];
            $industry = $result[3];
            $position = $result[4];
            $address = $result[5];
            $zip = $result[6];
            $locality = $result[7];
            $state = $result[8];
            $country = $result[9] ?: 'Panamá';
            $phone = $result[10];
            $email = $result[11];
            $website = $result[12];
            $comment = $result[13];

            $company = $user->companies()->firstOrCreate(['name' => $company], ['industry' => $industry, 'name' => $company]);
            $contact = $user->contacts()->create(['comment' => $comment, 'company_id' => $company->id, 'email' => $email, 'first_name' => $name, 'phone' => $phone, 'position' => $position, 'source' => $source, 'website' => $website]);
            $contact->address()->create(['country' => $country, 'locality' => $locality, 'state' => $state, 'street_name' => $address, 'zip' => $zip]);
        }
    }

    private function _paraguayContacts()
    {
        $file = module_path('irm', 'Database', 'app').'/contacts_paraguay.csv';
        $handle = fopen($file, "r");

        if (empty($handle) === false) {
            while (($data = fgetcsv($handle, 1000, ";")) !== FALSE ) {
                $arrResult[] = $data;
            }
            fclose($handle);
        }

        $user = User::firstOrCreate(['email' => 'andrea@mktre.com'], ['first_name' => 'Andrea', 'last_name' => 'Rodriguez', 'email' => 'andrea@mktre.com', 'password' => 'abcd1234']);

        foreach (array_slice($arrResult,1) as $result) {

            $source = $result[0];
            $company = $result[1];
            $name = $result[2];
            $industry = $result[3];
            $position = $result[4];
            $address = $result[5];
            $zip = $result[6];
            $locality = $result[7];
            $state = $result[8];
            $country = $result[9] ?: 'Paraguay';
            $phone = $result[10];
            $email = $result[11];
            $website = $result[12];
            $comment = $result[13];

            $company = $user->companies()->firstOrCreate(['name' => $company], ['industry' => $industry, 'name' => $company]);
            $contact = $user->contacts()->create(['comment' => $comment, 'company_id' => $company->id, 'email' => $email, 'first_name' => $name, 'phone' => $phone, 'position' => $position, 'source' => $source, 'website' => $website]);
            $address = $contact->address()->create(['country' => $country, 'locality' => $locality, 'state' => $state, 'street_name' => $address, 'zip' => $zip]);

            $location = $this->getGeoLocation($address.' '.$locality);
            if ($location) {
                $address->map()->create($location);
            }
        }
    }

    private function _uruguayContacts()
    {
        $file = module_path('irm', 'Database', 'app').'/contacts_uruguay.csv';
        $handle = fopen($file, "r");

        if (empty($handle) === false) {
            while (($data = fgetcsv($handle, 1000, ";")) !== FALSE ) {
                $arrResult[] = $data;
            }
            fclose($handle);
        }

        $user = User::firstOrCreate(['email' => 'andrea@mktre.com'], ['first_name' => 'Andrea', 'last_name' => 'Rodriguez', 'email' => 'andrea@mktre.com', 'password' => 'abcd1234']);

        foreach (array_slice($arrResult,1) as $result) {

            $source = $result[0];
            $company = $result[1];
            $name = $result[2];
            $industry = $result[3];
            $position = $result[4];
            $address = $result[5];
            $zip = $result[6];
            $locality = $result[7];
            $state = $result[8];
            $country = $result[9] ?: 'Uruguay';
            $phone = $result[10];
            $email = $result[11];
            $website = $result[12];
            $comment = $result[13];

            $company = $user->companies()->firstOrCreate(['name' => $company], ['industry' => $industry, 'name' => $company]);
            $contact = $user->contacts()->create(['comment' => $comment, 'company_id' => $company->id, 'email' => $email, 'first_name' => $name, 'phone' => $phone, 'position' => $position, 'source' => $source, 'website' => $website]);
            $address = $contact->address()->create(['country' => $country, 'locality' => $locality, 'state' => $state, 'street_name' => $address, 'zip' => $zip]);

            $location = $this->getGeoLocation($address.' '.$locality);
            if ($location) {
                $contact->map()->create($location);
            }
        }
    }

    function getGeoLocation($addr)
    {
        $cleanAddress = str_replace (" ", "+", $addr);
        $details_url = "https://maps.googleapis.com/maps/api/geocode/json?address=".$cleanAddress."&sensor=false&key=".env("GOOGLE_PLACES_API");
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $details_url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_PROXYPORT, 3128);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        $geoloc = json_decode(curl_exec($ch), true);
        switch ($geoloc['status']) {
        case 'ZERO_RESULTS':
            return 0;
            break;
        case 'OK':
            return $geoloc['results'][0]['geometry']['location'];
            break;
        }
    }
}
