@extends('layouts.admin')

@section('title', 'Router Details')
@section('breadcrumb', 'Router Details')

@section('content')
<div class="row">
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Router Information</h3>
            </div>
            <div class="card-body">
                <div class="text-center mb-3">
                    <div class="info-box">
                        <span class="info-box-icon @if($router->isOnline()) bg-success @else bg-danger @endif">
                            <i class="fas fa-wifi"></i>
                        </span>
                        <div class="info-box-content">
                            <span class="info-box-text">{{ $router->name }}</span>
                            <span class="info-box-number">{{ $router->ip_address }}</span>
                        </div>
                    </div>
                </div>
                
                <table class="table table-sm">
                    <tr>
                        <td><strong>Type:</strong></td>
                        <td>{{ $router->type_label }}</td>
                    </tr>
                    <tr>
                        <td><strong>Status:</strong></td>
                        <td>{!! $router->status_badge !!}</td>
                    </tr>
                    <tr>
                        <td><strong>Port:</strong></td>
                        <td>{{ $router->port }}</td>
                    </tr>
                    <tr>
                        <td><strong>Username:</strong></td>
                        <td>{{ $router->username }}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
    
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Router Details</h3>
                <div class="card-tools">
                    <a href="{{ route('admin.routers.edit', $router) }}" class="btn btn-warning btn-sm">
                        <i class="fas fa-edit"></i> Edit
                    </a>
                    <a href="{{ route('admin.routers.index') }}" class="btn btn-default btn-sm">
                        <i class="fas fa-arrow-left"></i> Back
                    </a>
                </div>
            </div>
            <div class="card-body">
                @if($router->description)
                <div class="form-group">
                    <label><strong>Description:</strong></label>
                    <p>{{ $router->description }}</p>
                </div>
                @endif
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="info-box">
                            <span class="info-box-icon bg-info">
                                <i class="fas fa-users"></i>
                            </span>
                            <div class="info-box-content">
                                <span class="info-box-text">Connected Customers</span>
                                <span class="info-box-number">{{ $router->customers_count }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="info-box">
                            <span class="info-box-icon bg-warning">
                                <i class="fas fa-clock"></i>
                            </span>
                            <div class="info-box-content">
                                <span class="info-box-text">Last Seen</span>
                                <span class="info-box-number">
                                    @if($router->last_seen)
                                        {{ $router->last_seen->diffForHumans() }}
                                    @else
                                        Never
                                    @endif
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                
                @if($router->notes)
                <div class="form-group">
                    <label><strong>Notes:</strong></label>
                    <p>{{ $router->notes }}</p>
                </div>
                @endif
            </div>
        </div>
        
        @if($router->customers->count() > 0)
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Connected Customers</h3>
            </div>
            <div class="card-body">
                <table class="table table-sm">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Phone</th>
                            <th>Package</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($router->customers->take(5) as $customer)
                        <tr>
                            <td>{{ $customer->name }}</td>
                            <td>{{ $customer->phone }}</td>
                            <td>{{ $customer->package?->name ?? 'N/A' }}</td>
                            <td>{!! $customer->status_badge !!}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                
                @if($router->customers->count() > 5)
                <div class="text-center">
                    <a href="{{ route('admin.customers.index') }}?router={{ $router->id }}" class="btn btn-sm btn-outline-primary">
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
