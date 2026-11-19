<?php

namespace App\Controllers;

use App\Models\Vehiculo;
use Illuminate\Database\Eloquent\Collection;

class VehiculosController
{
    public function all(): Collection
    {
        return Vehiculo::all();
    }
}