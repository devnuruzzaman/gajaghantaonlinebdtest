@extends('layouts.admin')

@section('title', 'Client Dashboard')
@section('breadcrumb', 'Dashboard')

@section('content')
<div class="row">
    <div class="col-lg-4">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">My Account</h3>
            </div>
            <div class="card-body">
                <div class="text-center mb-3">
                    <img src="{{ Auth::user()->profile_photo_url }}" class="img-circle" alt="Profile" style="width: 100px; height: 100px;">
                </div>
                <h5 class="text-center">{{ Auth::user()->name }}</h5>
                <p class="text-center text-muted">{{ Auth::user()->email }}</p>
                
                <table class="table table-sm">
                    <tr>
                        <td><strong>Package:</strong></td>
                        <td>Standard 10Mbps</td>
                    </tr>
                    <tr>
                        <td><strong>Status:</strong></td>
                        <td><span class="badge badge-success">Active</span></td>
                    </tr>
                    <tr>
                        <td><strong>Expiry:</strong></td>
                        <td>2024-02-15</td>
                    </tr>
                    <tr>
                        <td><strong>Monthly Fee:</strong></td>
                        <td>৳1,000</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
    
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Usage Statistics</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="info-box">
                            <span class="info-box-icon bg-info">
                                <i class="fas fa-download"></i>
                            </span>
                            <div class="info-box-content">
                                <span class="info-box-text">Download</span>
                                <span class="info-box-number">45.2 GB</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="info-box">
                            <span class="info-box-icon bg-success">
                                <i class="fas fa-upload"></i>
                            </span>
                            <div class="info-box-content">
                                <span class="info-box-text">Upload</span>
                                <span class="info-box-number">12.8 GB</span>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="row mt-3">
                    <div class="col-md-6">
                        <div class="info-box">
                            <span class="info-box-icon bg-warning">
                                <i class="fas fa-clock"></i>
                            </span>
                            <div class="info-box-content">
                                <span class="info-box-text">Online Time</span>
                                <span class="info-box-number">156 hrs</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="info-box">
                            <span class="info-box-icon bg-danger">
                                <i class="fas fa-calendar"></i>
                            </span>
                            <div class="info-box-content">
                                <span class="info-box-text">Days Left</span>
                                <span class="info-box-number">23 days</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Quick Actions</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <a href="#" class="btn btn-primary btn-block mb-2">
                            <i class="fas fa-dollar-sign"></i> Pay Bill
                        </a>
                    </div>
                    <div class="col-md-6">
                        <a href="#" class="btn btn-success btn-block mb-2">
                            <i class="fas fa-sync"></i> Renew Package
                        </a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <a href="#" class="btn btn-info btn-block mb-2">
                            <i class="fas fa-file-invoice"></i> View Invoices
                        </a>
                    </div>
                    <div class="col-md-6">
                        <a href="#" class="btn btn-warning btn-block">
                            <i class="fas fa-cog"></i> Account Settings
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
