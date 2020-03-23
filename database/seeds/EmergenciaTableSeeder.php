<?php

use Illuminate\Database\Seeder;

class EmergenciaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('emergencia')->delete();

        $emergencias =
        [
            ['telefono' => '5700721', 'entidad' => 'CUERPO DE BOMBEROS VOLUNTARIOS DE VILLA DEL ROSARIO', 'direccion' => 'CRA 12 N 3-70', 'barrio' => 'SAN MARTIN', 'otro_telefono' => '3165259339'],
            ['telefono' => '5712256-119', 'entidad' => 'CUERPO DE BOMBEROS VOLUNTARIOS DE CUCUTA', 'direccion' => 'AV 6', 'barrio' => 'EL CALLEJON', 'otro_telefono' => '5712255'],
            ['telefono' => '5784886-5870303', 'entidad' => 'BROS AERONAUTICOS CUCUTA', 'direccion' => 'AEROPUERTO CAMILO DAZA', 'barrio' => 'AEROPUERTO'],
            ['telefono' => '(0276) 7710443', 'entidad' => 'BROS AERONAUTICOS SAN ANTONIO', 'direccion' => 'AEROPUERTO SAN ANTONIO (TACHIRA)', 'barrio' => 'CAPRENCO'],
            ['telefono' => '(097) 6223403', 'entidad' => 'BROS DE BARRANCABERMEJA', 'direccion' => 'BARRANCABERMEJA', 'otro_telefono' => '6223336'],
            ['telefono' => '5752650-5865306', 'entidad' => 'BROS DE CHINACOTA', 'direccion' => 'CHINACOTA', 'otro_telefono' => '3158007371'],
            ['telefono' => '5802288', 'entidad' => 'BROS DE LOS PATIOS', 'direccion' => 'AV 10 KL 8', 'barrio' => 'DANIEL JORDAN', 'otro_telefono' => '5755044'],
            ['telefono' => '5611218-5612510', 'entidad' => 'BROS DE OCAÑA', 'direccion' => 'OCAÑA'],
            ['telefono' => '5688096-5682139', 'entidad' => 'BROS DE PAMPLONA', 'direccion' => 'PAMPLONA', 'otro_telefono' => '3159610686'],
            ['telefono' => '5660415-5660243', 'entidad' => 'BROS DE PUERTO SANTANDER', 'direccion' => 'PUERTO SANTANDER', 'otro_telefono' => '5660135'],
            ['telefono' => '(0276) 7620603', 'entidad' => 'BROS DE RUBIO (TACHIRA)', 'direccion' => 'RUBIO'],
            ['telefono' => '(0276)7711800', 'entidad' => 'BROS DE SAN ANTONIO', 'direccion' => 'RICAURTE'],
            ['telefono' => '5663630-5663061', 'entidad' => 'BROS DE TIBÚ', 'direccion' => 'TIBU'],
            ['telefono' => '(0276) 7873699-5170769', 'entidad' => 'BROS DE UREÑA', 'direccion' => 'UREÑA'],
            ['telefono' => '5783011', 'entidad' => 'AMBULANCIA DE CUCUTA', 'direccion' => 'CUCUTA'],
            ['telefono' => '300-252.2247-5767878', 'entidad' => 'AMBULANCIA DEL PEAJE', 'direccion' => 'PEAJE SAN SIMON'],
            ['telefono' => '5730073', 'entidad' => 'CORPONOR', 'direccion' => 'CUCUTA', 'extension' => '64'],
            ['telefono' => '5714156 - 132', 'entidad' => 'CRUZ ROJA', 'direccion' => 'CUCUTA', 'barrio' => 'BLANCO', 'extension'=> '132'],
            ['telefono' => '5730087-5711736', 'entidad' => 'CREPAD', 'direccion' => 'CUCUTA'],
            ['telefono' => '5780504  -  115', 'entidad' => 'CENS', 'direccion' => 'CUCUTA', 'barrio' => 'SEVILLA', 'extension' => '115'],
            ['telefono' => '5781021', 'entidad' => 'DEFENSA CIVIL', 'direccion' => 'CUCUTA'],
            ['telefono' => '310-275.3758', 'entidad' => 'DEFENSA CIVIL PALMITA', 'direccion' => 'V. ROSARIO ', 'barrio' => 'LA PALMITA'],
            ['telefono' => '5703549-5708709', 'entidad' => 'DEFENSA CIVIL PARAMO', 'direccion' => 'V.ROSARIO', 'barrio' => ' EL PARAMO', 'otro_telefono' => '3102686711'],
            ['telefono' => '5728882', 'entidad' => 'EJERCITO NACIONAL', 'direccion' => 'CUCUTA ', 'barrio' => 'EL PORTICO'],
            ['telefono' => '5700479-5700351', 'entidad' => 'FISCALIA DE VILLA DEL ROSARIO', 'direccion' => 'VILLA DEL ROSARIO'],
            ['telefono' => '5720033', 'entidad' => 'GAULA DAS', 'direccion' => 'CUCUTA', 'extension' => '165'],
            ['telefono' => '5748868', 'entidad' => 'HOSPITAL  E.M', 'direccion' => 'CUCUTA '],
            ['telefono' => '5829960', 'entidad' => 'HOSPITAL J.C S', 'direccion' => 'CALLE  5 #  7- 25', 'barrio' => 'CENTRO'],
            ['telefono' => '5860053-5860099', 'entidad' => 'POLICIA DE HERRAN', 'direccion' => 'HERRAN'],
            ['telefono' => '5869055', 'entidad' => 'POLICIA DE RAGONBALIA', 'direccion' => 'RAGONBALI'],
            ['telefono' => '018000916012', 'entidad' => 'CISPROQUIM', 'direccion' => 'CUCUTA'],
            ['telefono' => '5708432-5808048', 'entidad' => 'GAS ROSARIO', 'direccion' => 'CLL 3 KRR 11', 'barrio' => 'SAN MARTIN V. ROSARIO', 'otro_telefono' => '5710518'],
            ['telefono' => '164-5780016', 'entidad' => 'GASES DEL ORIENTE', 'direccion' => 'AV. 0   CALLE  6', 'barrio' => 'LEERAS'],
            ['telefono' => '5705645-3124998305', 'entidad' => 'NORGAS', 'direccion' => 'CUCUTA'],
            ['telefono' => '5703072 - 5704358', 'entidad' => 'POLICIA VILLA DEL ROSARIO', 'direccion' => 'CR 7A AV 4 Y 5 ', 'barrio' => 'PARQUE PRINCIPAL', 'otro_telefono' => '3148364177 '],
            ['telefono' => '5705635', 'entidad' => 'TELEMATICA DC VILLA ROSARIO FM', 'direccion' => 'LA PALMITA', 'barrio' => 'LA PALMITA'],
            ['telefono' => '5869011', 'entidad' => 'CENTRO DE SALUD', 'direccion' => 'RAGONVALIA', 'barrio' => 'RAGONVALIA'],
        ];

        foreach ($emergencias as $emergencia) {
            DB::table('emergencia')->insert($emergencia);
        }
    }
}
