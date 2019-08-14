<?php

namespace Raffles\Modules\Lrm\Imports;

use Raffles\Models\{ Address, Company };
use Raffles\Modules\Lrm\Models\Contact;

use Maatwebsite\Excel\Concerns\ToModel;

class ContactsImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $address = ['street_name' => $row['street_name'] ?? $row['address'] ?? $row['direccion'] ?? null, 'street_number' => $row['street_number'] ?? $row['numero_calle'] ?? null, 'locality' => $row['locality'] ?? $row['city'] ?? $row['ciudad'] ?? null, 'sublocality' => $row['sublocality'] ?? $row['town'] ?? $row['barrio'] ?? $row['pueblo'] ?? null, 'zip' => $row['zip'] ?? $row['cod_postal'] ?? $row['codigo_postal'] ?? null, 'country' => $row['country'] ?? $row['pais'] ?? null, 'state' => $row['state'] ?? $row['provincia'] ?? $row['estado'] ?? null];

        $company = ['name' => $row['company'] ?? $row['compañía'] ?? $row['compañia'] ?? $row['compania'] ?? null ];

        /**
         * Debe saltear la importación de usuario cuando el campo e-mail está repetido.
         */

        return new Contact([
            'address' => Address::create($address),
            'map' => Map::create([]),
            'company' => Company::firstOrCreate($company, $company);
            'email' => $row['email'] ?? $row['e-mail'] ?? $row['mail'] ?? null,
            'fax' => $row['fax'] ?? null,
            'first_name' => $row['first_name'] ?? $row['name'] ?? $row['nombre'] ?? null,
            'last_name' => $row['last_name'] ?? $row['apellido'] ?? null,
            'mobile' => $row['mobile'] ?? $row['cellphone'] ?? $row['cell_phone'] ?? $row['celular'] ?? null,
            'phone' => $row['phone'] ?? $row['telefono'] ?? null,
            'position' => $row['position'] ?? $row['cargo'] ?? null,
            'website' => $row['website'] ?? $row['web'] ?? $row['sitio_web'] ?? null,
        ]);
    }
}
