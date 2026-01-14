<?php
use App\Models\Setting;
?>

@extends('layouts.admin')

@section('title', 'Settings')
@section('breadcrumb', 'Settings')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">General Settings</h3>
                <div class="card-tools">
                    <a href="{{ route('admin.dashboard') }}" class="btn btn-default btn-sm">
                        <i class="fas fa-arrow-left"></i> Back to Dashboard
                    </a>
                </div>
            </div>
            <div class="card-body">
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        {{ session('success') }}
                    </div>
                @endif

                @if($errors->any())
                    <div class="alert alert-danger alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <ul class="mb-0">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    
                    <div class="row">
                        <div class="col-md-6">
                            <h4>Basic Information</h4>
                            <div class="form-group">
                                <label for="site_name">Site Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="site_name" name="site_name" 
                                       value="{{ old('site_name', $settings->get('site_name', 'ISP Management System')) }}" required>
                            </div>
                            
                            <div class="form-group">
                                <label for="site_description">Site Description</label>
                                <textarea class="form-control" id="site_description" name="site_description" rows="3">{{ old('site_description', $settings->get('site_description')) }}</textarea>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <h4>Branding</h4>
                            
                            <div class="form-group">
                                <label for="logo">Logo</label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="logo" name="logo" accept="image/*">
                                    <label class="custom-file-label" for="logo">Choose logo file...</label>
                                </div>
                                <small class="form-text text-muted">Allowed: JPEG, PNG, JPG, GIF (Max: 2MB)</small>
                                @if($settings->get('logo'))
                                    <div class="mt-2">
                                        <img src="{{ asset($settings->get('logo')) }}" alt="Current Logo" style="max-height: 60px;" class="img-thumbnail">
                                        <br>
                                        <small class="text-muted">Current logo</small>
                                    </div>
                                @endif
                            </div>
                            
                            <div class="form-group">
                                <label for="favicon">Favicon</label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="favicon" name="favicon" accept="image/*">
                                    <label class="custom-file-label" for="favicon">Choose favicon file...</label>
                                </div>
                                <small class="form-text text-muted">Allowed: ICO, PNG (Max: 1MB)</small>
                                @if($settings->get('favicon'))
                                    <div class="mt-2">
                                        <img src="{{ asset($settings->get('favicon')) }}" alt="Current Favicon" style="max-height: 32px;" class="img-thumbnail">
                                        <br>
                                        <small class="text-muted">Current favicon</small>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Save Settings
                        </button>
                        <a href="{{ route('admin.dashboard') }}" class="btn btn-default">
                            <i class="fas fa-times"></i> Cancel
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Update file input label when file is selected
    document.querySelectorAll('.custom-file-input').forEach(input => {
        input.addEventListener('change', function(e) {
            const fileName = e.target.files[0]?.name || 'Choose file...';
            const label = e.target.nextElementSibling;
            label.textContent = fileName;
        });
    });
</script>
@endpush
