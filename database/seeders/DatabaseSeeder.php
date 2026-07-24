<?php

namespace Database\Seeders;

use App\Models\Mascota;
use App\Models\Turno;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $encargado = User::create([
            'name' => 'Roberto Fernandez',
            'email' => 'encargado@veterinaria.com',
            'password' => Hash::make('password'),
            'rol' => 'encargado',
            'telefono' => '11 4567-8900',
        ]);

        $secretaria = User::create([
            'name' => 'Carla Medina',
            'email' => 'secretaria@veterinaria.com',
            'password' => Hash::make('password'),
            'rol' => 'secretario',
            'telefono' => '11 4567-8901',
        ]);

        $vet1 = User::create([
            'name' => 'Dra. Sanchez',
            'email' => 'sanchez@veterinaria.com',
            'password' => Hash::make('password'),
            'rol' => 'veterinario',
            'telefono' => '11 4567-8902',
        ]);

        $vet2 = User::create([
            'name' => 'Dr. Lopez',
            'email' => 'lopez@veterinaria.com',
            'password' => Hash::make('password'),
            'rol' => 'veterinario',
            'telefono' => '11 4567-8903',
        ]);

        $cliente1 = User::create([
            'name' => 'Maria Gomez',
            'email' => 'cliente@veterinaria.com',
            'password' => Hash::make('password'),
            'rol' => 'cliente',
            'telefono' => '11 5555-1234',
        ]);

        $cliente2 = User::create([
            'name' => 'Juan Perez',
            'email' => 'juanperez@veterinaria.com',
            'password' => Hash::make('password'),
            'rol' => 'cliente',
            'telefono' => '11 5555-5678',
        ]);

        $luna = Mascota::create([
            'user_id' => $cliente1->id,
            'nombre' => 'Luna',
            'tipo' => 'Gato',
            'raza' => 'Comun europeo',
            'edad' => 3,
            'observaciones' => 'Paciente sin complicaciones recientes.',
        ]);

        $rocky = Mascota::create([
            'user_id' => $cliente2->id,
            'nombre' => 'Rocky',
            'tipo' => 'Perro',
            'raza' => 'Labrador',
            'edad' => 5,
            'observaciones' => 'Control general y vacunacion.',
        ]);

        $milo = Mascota::create([
            'user_id' => $cliente2->id,
            'nombre' => 'Milo',
            'tipo' => 'Perro',
            'raza' => 'Mestizo',
            'edad' => 2,
            'observaciones' => null,
        ]);

        Turno::create([
            'mascota_id' => $luna->id,
            'veterinario_id' => $vet1->id,
            'fecha' => now()->addDay()->toDateString(),
            'hora' => '09:00',
            'motivo' => 'Control general',
            'estado' => 'confirmado',
        ]);

        Turno::create([
            'mascota_id' => $rocky->id,
            'veterinario_id' => $vet2->id,
            'fecha' => now()->addDay()->toDateString(),
            'hora' => '10:30',
            'motivo' => 'Vacunacion',
            'estado' => 'pendiente',
        ]);

        Turno::create([
            'mascota_id' => $milo->id,
            'veterinario_id' => $vet1->id,
            'fecha' => now()->addDays(2)->toDateString(),
            'hora' => '12:00',
            'motivo' => 'Consulta',
            'estado' => 'confirmado',
        ]);
    }
}
