<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;
    // se indican los campos que se van a poder llenar masivamente
    // en este caso solo sera el nombre
    protected $fillable = ['Serial'];
    protected $fillableP = ['Pais'];
    protected $fillableC = ['Ciudad'];
    protected $fillableI = ['Institucion'];
    protected $fillableT = ['Telefono'];
    protected $fillableD = ['Direccion'];
    protected $fillablePi = ['Piso'];
  
}