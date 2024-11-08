<?php

namespace App\Exports;

use App\Models\Aportante;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class AportantesExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        // Retorna todos los aportantes
        return Aportante::all();
    }

    public function headings(): array
    {
        return [
            'ID', 'Nombres', 'Apellidos', 'Cédula', 'Teléfono', 'Dirección', 'Fecha de Nacimiento', 'Afiliacion pagada', 'Creado en', 'Actualizado en'
        ];
    }
}
