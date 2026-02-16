@extends('layouts.app')

@section('title', 'Dashboard')

@section('styles')
<link rel="stylesheet" href="{{ asset('assets/vendors/chartjs/Chart.min.css') }}">
@endsection

@section('content')

<div class="main-content container-fluid">

    <div class="page-title">
        <h3>Dashboard</h3>
        <p class="text-subtitle text-muted">
            A good dashboard to display your statistics
        </p>
    </div>

    <section class="section">

        <div class="row mb-2">

            {{-- Balance --}}
            <div class="col-12 col-md-3">
                <div class="card card-statistic">
                    <div class="card-body p-0">

                        <div class="d-flex flex-column">

                            <div class="px-3 py-3 d-flex justify-content-between">

                                <h3 class="card-title">BALANCE</h3>

                                <div>$50</div>

                            </div>

                            <div class="chart-wrapper">
                                <canvas id="canvas1" style="height:100px"></canvas>
                            </div>

                        </div>

                    </div>
                </div>
            </div>

            {{-- Revenue --}}
            <div class="col-12 col-md-3">
                <div class="card card-statistic">

                    <div class="card-body p-0">

                        <div class="d-flex flex-column">

                            <div class="px-3 py-3 d-flex justify-content-between">

                                <h3 class="card-title">Revenue</h3>

                                <div>$532,2</div>

                            </div>

                            <div class="chart-wrapper">
                                <canvas id="canvas2" style="height:100px"></canvas>
                            </div>

                        </div>

                    </div>

                </div>
            </div>

            {{-- Orders --}}
            <div class="col-12 col-md-3">
                <div class="card card-statistic">

                    <div class="card-body p-0">

                        <div class="d-flex flex-column">

                            <div class="px-3 py-3 d-flex justify-content-between">

                                <h3 class="card-title">ORDERS</h3>

                                <div>1,544</div>

                            </div>

                            <div class="chart-wrapper">
                                <canvas id="canvas3"></canvas>
                            </div>

                        </div>

                    </div>

                </div>
            </div>

            {{-- Sales --}}
            <div class="col-12 col-md-3">
                <div class="card card-statistic">

                    <div class="card-body p-0">

                        <div class="d-flex flex-column">

                            <div class="px-3 py-3 d-flex justify-content-between">

                                <h3 class="card-title">Sales Today</h3>

                                <div>423</div>

                            </div>

                            <div class="chart-wrapper">
                                <canvas id="canvas4"></canvas>
                            </div>

                        </div>

                    </div>

                </div>
            </div>

        </div>


        {{-- Table --}}
        <div class="card">

            <div class="card-header">
                <h4>Orders Today</h4>
            </div>

            <div class="card-body">

                <table class="table">

                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>City</th>
                            <th>Status</th>
                        </tr>
                    </thead>

                    <tbody>

                        <tr>
                            <td>Kuldeep</td>
                            <td>kuldeep@gmail.com</td>
                            <td>Delhi</td>
                            <td>
                                <span class="badge bg-success">
                                    Active
                                </span>
                            </td>
                        </tr>

                    </tbody>

                </table>

            </div>

        </div>


    </section>

</div>

@endsection


@section('js')

<script src="{{ asset('assets/vendors/chartjs/Chart.min.js') }}"></script>

<script src="{{ asset('assets/vendors/apexcharts/apexcharts.min.js') }}"></script>

<script src="{{ asset('assets/js/pages/dashboard.js') }}"></script>

@endsection
