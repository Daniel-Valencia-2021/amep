<?php

namespace App\Exports;

use App\Models\Beneficiario;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class BeneficiariosExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        // Retorna todos los beneficiarios
        return Beneficiario::all();
    }

    public function headings(): array
    {
        return [
            'ID', 'Nombres', 'Apellidos', 'Identificación', 'Tipo de identificacion','Dirección', 'Parentesco', 'Fecha de Nacimiento',  'Aportante ID', 'Creado en', 'Actualizado en'
        ];
    }
}
