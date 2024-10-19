@extends('layouts.app')

@section('title', 'Estadísticas de Fallecimientos')

@section('content')
    <div class="container">
        <h1 class="text-center mb-5">Estadísticas de Fallecimientos</h1>

        <div class="row mb-5">
            <!-- Gráfico de muertes por mes -->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h3 class="card-title text-center">Muertes por Mes</h3>
                        <canvas id="muertesPorMes"></canvas>
                    </div>
                </div>
            </div>

            <!-- Gráfico de tipos de muerte -->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h3 class="card-title text-center">Tipos de Muerte</h3>
                        <canvas id="tiposDeMuerte"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <!-- Gráfico de edades -->
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h3 class="card-title text-center">Edades de Fallecidos</h3>
                        <canvas id="edadesMuertos"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Incluir Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        // Datos para los gráficos
        const muertesPorMes = @json(array_values($muertesPorMesCompletado));
        const meses = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];

        // Tipos de muerte
        const tiposDeMuerte = @json(array_values($tiposDeMuerteConNombres)); // Usamos los nombres de las causas
        const causas = @json(array_keys($tiposDeMuerteConNombres)); // Los nombres en lugar de IDs

        // Edades
        const edades = @json(array_keys($edades));
        const cantidadEdades = @json(array_values($edades));

        // Gráfico de Muertes por Mes
        const ctxMeses = document.getElementById('muertesPorMes').getContext('2d');
        new Chart(ctxMeses, {
            type: 'bar',
            data: {
                labels: meses,
                datasets: [{
                    label: 'Cantidad de Muertes',
                    data: muertesPorMes,
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        // Gráfico de Tipos de Muerte
        const ctxTipos = document.getElementById('tiposDeMuerte').getContext('2d');
        new Chart(ctxTipos, {
            type: 'pie',
            data: {
                labels: causas, // Mostramos los nombres de las causas
                datasets: [{
                    label: 'Tipos de Muerte',
                    data: tiposDeMuerte,
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)'
                    ],
                    borderWidth: 1
                }]
            }
        });

        // Gráfico de Edades de Fallecidos
        const ctxEdades = document.getElementById('edadesMuertos').getContext('2d');
        new Chart(ctxEdades, {
            type: 'line',
            data: {
                labels: edades,
                datasets: [{
                    label: 'Cantidad de Muertes por Edad',
                    data: cantidadEdades,
                    fill: false,
                    borderColor: 'rgba(75, 192, 192, 1)',
                    tension: 0.1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
@endsection
