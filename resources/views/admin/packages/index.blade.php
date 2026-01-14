@extends('layouts.admin')

@section('title', 'Packages')
@section('breadcrumb', 'Packages')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Packages</h3>
                <div class="card-tools">
                    @can('packages.create')
                    <a href="{{ route('admin.packages.create') }}" class="btn btn-primary btn-sm">
                        <i class="fas fa-plus"></i> Add Package
                    </a>
                    @endcan
                </div>
            </div>
            <div class="card-body">
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        {{ session('success') }}
                    </div>
                @endif
                
                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        {{ session('error') }}
                    </div>
                @endif

                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Speed</th>
                            <th>Price</th>
                            <th>Type</th>
                            <th>Status</th>
                            <th>Customers</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($packages as $package)
                            <tr>
                                <td>{{ $package->name }}</td>
                                <td>{{ $package->speed_label }}</td>
                                <td>৳{{ number_format($package->price, 2) }}</td>
                                <td>{{ $package->type_label }}</td>
                                <td>{!! $package->status_badge !!}</td>
                                <td>{{ $package->customers_count }}</td>
                                <td>
                                    <div class="btn-group">
                                        @can('packages.view')
                                        <a href="{{ route('admin.packages.show', $package) }}" class="btn btn-info btn-sm">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        @endcan
                                        @can('packages.edit')
                                        <a href="{{ route('admin.packages.edit', $package) }}" class="btn btn-warning btn-sm">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        @endcan
                                        @can('packages.delete')
                                        <form action="{{ route('admin.packages.destroy', $package) }}" method="POST" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                        @endcan
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center">No packages found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                
                <div class="d-flex justify-content-center">
                    {{ $packages->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
