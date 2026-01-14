@extends('layouts.admin')

@section('title', 'Routers')
@section('breadcrumb', 'Routers')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Routers</h3>
                <div class="card-tools">
                    @can('routers.create')
                    <a href="{{ route('admin.routers.create') }}" class="btn btn-primary btn-sm">
                        <i class="fas fa-plus"></i> Add Router
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
                            <th>IP Address</th>
                            <th>Type</th>
                            <th>Status</th>
                            <th>Customers</th>
                            <th>Last Seen</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($routers as $router)
                            <tr>
                                <td>{{ $router->name }}</td>
                                <td>{{ $router->connection_url }}</td>
                                <td>{{ $router->type_label }}</td>
                                <td>{!! $router->status_badge !!}</td>
                                <td>{{ $router->customers_count }}</td>
                                <td>
                                    @if($router->last_seen)
                                        {{ $router->last_seen->diffForHumans() }}
                                    @else
                                        <span class="text-muted">Never</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="btn-group">
                                        @can('routers.view')
                                        <a href="{{ route('admin.routers.show', $router) }}" class="btn btn-info btn-sm">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        @endcan
                                        @can('routers.edit')
                                        <a href="{{ route('admin.routers.edit', $router) }}" class="btn btn-warning btn-sm">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        @endcan
                                        @can('routers.delete')
                                        <form action="{{ route('admin.routers.destroy', $router) }}" method="POST" style="display: inline;">
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
                                <td colspan="7" class="text-center">No routers found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                
                <div class="d-flex justify-content-center">
                    {{ $routers->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
