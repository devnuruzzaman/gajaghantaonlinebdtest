@extends('layouts.admin')

@section('title', 'Package Details')
@section('breadcrumb', 'Package Details')

@section('content')
<div class="row">
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Package Information</h3>
            </div>
            <div class="card-body">
                <div class="text-center mb-3">
                    <div class="info-box">
                        <span class="info-box-icon bg-info">
                            <i class="fas fa-box"></i>
                        </span>
                        <div class="info-box-content">
                            <span class="info-box-text">{{ $package->name }}</span>
                            <span class="info-box-number">৳{{ number_format($package->price, 2) }}</span>
                        </div>
                    </div>
                </div>
                
                <table class="table table-sm">
                    <tr>
                        <td><strong>Type:</strong></td>
                        <td>{{ $package->type_label }}</td>
                    </tr>
                    <tr>
                        <td><strong>Speed:</strong></td>
                        <td>{{ $package->speed_label }}</td>
                    </tr>
                    <tr>
                        <td><strong>Status:</strong></td>
                        <td>{!! $package->status_badge !!}</td>
                    </tr>
                    <tr>
                        <td><strong>Validity:</strong></td>
                        <td>{{ $package->validity_days }} days</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
    
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Package Details</h3>
                <div class="card-tools">
                    <a href="{{ route('admin.packages.edit', $package) }}" class="btn btn-warning btn-sm">
                        <i class="fas fa-edit"></i> Edit
                    </a>
                    <a href="{{ route('admin.packages.index') }}" class="btn btn-default btn-sm">
                        <i class="fas fa-arrow-left"></i> Back
                    </a>
                </div>
            </div>
            <div class="card-body">
                @if($package->description)
                <div class="form-group">
                    <label><strong>Description:</strong></label>
                    <p>{{ $package->description }}</p>
                </div>
                @endif
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="info-box">
                            <span class="info-box-icon bg-success">
                                <i class="fas fa-users"></i>
                            </span>
                            <div class="info-box-content">
                                <span class="info-box-text">Total Customers</span>
                                <span class="info-box-number">{{ $package->customers_count }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="info-box">
                            <span class="info-box-icon bg-warning">
                                <i class="fas fa-dollar-sign"></i>
                            </span>
                            <div class="info-box-content">
                                <span class="info-box-text">Monthly Revenue</span>
                                <span class="info-box-number">৳{{ number_format($package->price * $package->customers_count, 2) }}</span>
                            </div>
                        </div>
                    </div>
                </div>
                
                @if($package->notes)
                <div class="form-group">
                    <label><strong>Notes:</strong></label>
                    <p>{{ $package->notes }}</p>
                </div>
                @endif
            </div>
        </div>
        
        @if($package->customers->count() > 0)
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Recent Customers</h3>
            </div>
            <div class="card-body">
                <table class="table table-sm">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Phone</th>
                            <th>Status</th>
                            <th>Expiry</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($package->customers->take(5) as $customer)
                        <tr>
                            <td>{{ $customer->name }}</td>
                            <td>{{ $customer->phone }}</td>
                            <td>{!! $customer->status_badge !!}</td>
                            <td>{{ $customer->expiry_date?->format('M d, Y') ?? 'N/A' }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                
                @if($package->customers->count() > 5)
                <div class="text-center">
                    <a href="{{ route('admin.customers.index') }}?package={{ $package->id }}" class="btn btn-sm btn-outline-primary">
                        View All Customers
                    </a>
                </div>
                @endif
            </div>
        </div>
        @endif
    </div>
</div>
@endsection
