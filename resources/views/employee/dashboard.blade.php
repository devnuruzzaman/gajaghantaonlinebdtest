@extends('layouts.admin')

@section('title', 'Employee Dashboard')
@section('breadcrumb', 'Dashboard')

@section('content')
<div class="row">
    <div class="col-lg-3 col-6">
        <div class="small-box bg-info">
            <div class="inner">
                <h3>150</h3>
                <p>My Customers</p>
            </div>
            <div class="icon">
                <i class="fas fa-users"></i>
            </div>
            <a href="#" class="small-box-footer">
                More info <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-6">
        <div class="small-box bg-success">
            <div class="inner">
                <h3>53<sup style="font-size: 20px">%</sup></h3>
                <p>Active Connections</p>
            </div>
            <div class="icon">
                <i class="fas fa-wifi"></i>
            </div>
            <a href="#" class="small-box-footer">
                More info <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-6">
        <div class="small-box bg-warning">
            <div class="inner">
                <h3>44</h3>
                <p>Pending Tasks</p>
            </div>
            <div class="icon">
                <i class="fas fa-tasks"></i>
            </div>
            <a href="#" class="small-box-footer">
                More info <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-6">
        <div class="small-box bg-danger">
            <div class="inner">
                <h3>65</h3>
                <p>Expired Today</p>
            </div>
            <div class="icon">
                <i class="fas fa-exclamation-triangle"></i>
            </div>
            <a href="#" class="small-box-footer">
                More info <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Recent Activities</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                </div>
            </div>
            <div class="card-body">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">
                        <strong>John Doe</strong> - New customer added
                        <span class="float-right text-muted">2 mins ago</span>
                    </li>
                    <li class="list-group-item">
                        <strong>Jane Smith</strong> - Payment received
                        <span class="float-right text-muted">1 hour ago</span>
                    </li>
                    <li class="list-group-item">
                        <strong>Router 1</strong> - Connection restored
                        <span class="float-right text-muted">3 hours ago</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Quick Actions</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-6 text-center">
                        <a href="#" class="btn btn-primary btn-lg">
                            <i class="fas fa-user-plus fa-2x"></i><br>
                            Add Customer
                        </a>
                    </div>
                    <div class="col-6 text-center">
                        <a href="#" class="btn btn-success btn-lg">
                            <i class="fas fa-dollar-sign fa-2x"></i><br>
                            Receive Payment
                        </a>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-6 text-center">
                        <a href="#" class="btn btn-warning btn-lg">
                            <i class="fas fa-file-invoice fa-2x"></i><br>
                            Generate Invoice
                        </a>
                    </div>
                    <div class="col-6 text-center">
                        <a href="#" class="btn btn-info btn-lg">
                            <i class="fas fa-chart-bar fa-2x"></i><br>
                            View Reports
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
