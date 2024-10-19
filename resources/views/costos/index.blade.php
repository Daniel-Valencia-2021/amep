@extends('layouts.app')

@section('title', 'Configurar Costos')

@section('content')

    <style>
        /* Cambiar el color de los botones */
        .btn-custom {
            background-color: #7D7D7D;
            color: white;
            border-color: #7D7D7D;
        }

        .btn-custom:hover {
            background-color: #6B6B6B;
            /* Color un poco más oscuro para el hover */
            border-color: #6B6B6B;
        }

        /* Estilo para los campos del formulario */
        .form-control {
            border-radius: 0;
            background-color: #f8f9fa;
        }

        /* Caja para formulario */
        .costos-box {
            color: white;
            background-color: #1E1E1E;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        }

        /* Estilo para el título */
        .costos-box h1 {
            text-align: center;
            margin-bottom: 20px;
        }
    </style>

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <div class="d-flex justify-content-center">
        <div class="costos-box w-50">
            <h1>Configurar Costos</h1>

            <form action="{{ route('costos.update') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="valor_afiliacion" class="form-label">Valor de Afiliación</label>
                    <input type="number" class="form-control" id="valor_afiliacion" name="valor_afiliacion" 
                           value="{{ $costos ? $costos->valor_afiliacion : 0 }}" step="0.01" required>
                </div>

                <div class="mb-3">
                    <label for="valor_muerto" class="form-label">Valor por Fallecido</label>
                    <input type="number" class="form-control" id="valor_muerto" name="valor_muerto" 
                           value="{{ $costos ? $costos->valor_muerto : 0 }}" step="0.01" required>
                </div>

                <div class="mb-3">
                    <label for="valor_desembolso" class="form-label">Valor de Desembolso</label>
                    <input type="number" class="form-control" id="valor_desembolso" name="valor_desembolso" 
                           value="{{ $costos ? $costos->valor_desembolso : 0 }}" step="0.01" required>
                </div>

                <div class="text-center">
                    <button type="submit" class="btn btn-custom">Guardar Costos</button>
                </div>
            </form>

            @if(session('success'))
                <div class="alert alert-success mt-3">
                    {{ session('success') }}
                </div>
            @endif
        </div>
    </div>

@endsection
