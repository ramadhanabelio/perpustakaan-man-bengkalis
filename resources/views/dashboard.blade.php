@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <div class="page-inner">
        <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pb-4">
            <div>
                <h3 class="fw-bold mb-3">Dashboard</h3>
                <h6 class="op-7 mb-2">Perpustakaan - MAN 1 Bengkalis</h6>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-6 col-md-3">
                <div class="card card-stats card-round">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-5">
                                <div class="icon-big text-center">
                                    <i class="fas fa-book text-primary"></i>
                                </div>
                            </div>
                            <div class="col-7 col-stats">
                                <div class="numbers">
                                    <p class="card-category">Total Buku</p>
                                    <h4 class="card-title">{{ $totalBooks }}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-6 col-md-3">
                <div class="card card-stats card-round">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-5">
                                <div class="icon-big text-center">
                                    <i class="fas fa-users text-success"></i>
                                </div>
                            </div>
                            <div class="col-7 col-stats">
                                <div class="numbers">
                                    <p class="card-category">Total Anggota</p>
                                    <h4 class="card-title">{{ $totalMembers }}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-6 col-md-3">
                <div class="card card-stats card-round">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-5">
                                <div class="icon-big text-center">
                                    <i class="fas fa-book text-warning"></i>
                                </div>
                            </div>
                            <div class="col-7 col-stats">
                                <div class="numbers">
                                    <p class="card-category">Buku Dipinjam</p>
                                    <h4 class="card-title">{{ $totalBorrowed }}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- GRAFIK --}}
            <div class="row">
                <div class="col-md-6">
                    <div class="card card-round">
                        <div class="card-header">
                            <div class="card-head-row">
                                <div class="card-title">Statistik Peminjaman Mingguan</div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="chart-container" style="min-height: 275px">
                                <canvas id="weeklyChart"></canvas>
                            </div>
                            <div id="myChartLegend"></div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card card-round">
                        <div class="card-header">
                            <div class="card-head-row">
                                <div class="card-title">Statistik Peminjaman Tahunan</div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="chart-container" style="min-height: 275px">
                                <canvas id="yearlyChart"></canvas>
                            </div>
                            <div id="myChartLegend"></div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

        <script>
            // WEEKLY
            const weeklyLabels = {!! json_encode($weekly->pluck('date')) !!};
            const weeklyData = {!! json_encode($weekly->pluck('total')) !!};

            new Chart(document.getElementById('weeklyChart'), {
                type: 'line',
                data: {
                    labels: weeklyLabels,
                    datasets: [{
                        label: 'Peminjaman',
                        data: weeklyData,
                        borderWidth: 2
                    }]
                }
            });

            // YEARLY
            const yearlyLabels = {!! json_encode($yearly->pluck('month')) !!};
            const yearlyData = {!! json_encode($yearly->pluck('total')) !!};

            new Chart(document.getElementById('yearlyChart'), {
                type: 'bar',
                data: {
                    labels: yearlyLabels,
                    datasets: [{
                        label: 'Peminjaman',
                        data: yearlyData,
                        borderWidth: 2
                    }]
                }
            });
        </script>
    </div>
@endsection
