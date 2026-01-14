@extends('layouts.admin')

@section('title', 'Dashboard')
@section('breadcrumb', 'Dashboard')

@section('content')
<style>
    .dashboard-tiles .small-box {
        margin-bottom: 10px;
        min-height: 96px;
    }

    .dashboard-tiles .small-box > .inner {
        padding: 10px 12px;
    }

    .dashboard-tiles .small-box h3 {
        font-size: 26px;
        margin: 0 0 4px 0;
        line-height: 1.1;
    }

    .dashboard-tiles .small-box p {
        font-size: 13px;
        margin: 0;
    }

    .dashboard-tiles .small-box .icon {
        top: 8px;
    }

    .dashboard-tiles .small-box .icon > i {
        font-size: 48px;
    }

    .dashboard-tiles .small-box-footer {
        padding: 4px 0;
        font-size: 12px;
    }
</style>

<div class="dashboard-tiles">
<div class="row">
    <div class="col-lg-3 col-6">
        <div class="small-box bg-info">
            <div class="inner">
                <h3>{{ number_format($stats['total_clients'] ?? 0) }}</h3>
                <p>Total Client</p>
            </div>
            <div class="icon">
                <i class="fas fa-users"></i>
            </div>
            <a href="#" class="small-box-footer">View <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <div class="col-lg-3 col-6">
        <div class="small-box bg-success">
            <div class="inner">
                <h3>{{ number_format($stats['running_clients'] ?? 0) }}</h3>
                <p>Running Clients</p>
            </div>
            <div class="icon">
                <i class="fas fa-wifi"></i>
            </div>
            <a href="#" class="small-box-footer">View <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <div class="col-lg-3 col-6">
        <div class="small-box bg-warning">
            <div class="inner">
                <h3>{{ number_format($stats['inactive_clients'] ?? 0) }}</h3>
                <p>Inactive Clients</p>
            </div>
            <div class="icon">
                <i class="fas fa-user-slash"></i>
            </div>
            <a href="#" class="small-box-footer">View <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <div class="col-lg-3 col-6">
        <div class="small-box bg-secondary">
            <div class="inner">
                <h3>{{ number_format($stats['waiver_clients'] ?? 0) }}</h3>
                <p>Waiver Clients</p>
            </div>
            <div class="icon">
                <i class="fas fa-hand-holding-usd"></i>
            </div>
            <a href="#" class="small-box-footer">View <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-3 col-6">
        <div class="small-box bg-info">
            <div class="inner">
                <h3>{{ number_format($stats['new_clients_month'] ?? 0) }}</h3>
                <p>New Client</p>
            </div>
            <div class="icon">
                <i class="fas fa-user-plus"></i>
            </div>
            <a href="#" class="small-box-footer">View <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <div class="col-lg-3 col-6">
        <div class="small-box bg-success">
            <div class="inner">
                <h3>{{ number_format($stats['renewed_clients_month'] ?? 0) }}</h3>
                <p>Renewed Clients</p>
            </div>
            <div class="icon">
                <i class="fas fa-sync"></i>
            </div>
            <a href="#" class="small-box-footer">View <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <div class="col-lg-3 col-6">
        <div class="small-box bg-warning">
            <div class="inner">
                <h3>{{ number_format($stats['deactivated_clients_month'] ?? 0) }}</h3>
                <p>Deactivated Clients</p>
            </div>
            <div class="icon">
                <i class="fas fa-user-times"></i>
            </div>
            <a href="#" class="small-box-footer">View <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <div class="col-lg-3 col-6">
        <div class="small-box bg-secondary">
            <div class="inner">
                <h3>{{ number_format($stats['left_clients'] ?? 0) }}</h3>
                <p>Left Clients</p>
            </div>
            <div class="icon">
                <i class="fas fa-sign-out-alt"></i>
            </div>
            <a href="#" class="small-box-footer">View <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-3 col-6">
        <div class="small-box bg-info">
            <div class="inner">
                <h3>{{ number_format($stats['billing_clients_month'] ?? 0) }}</h3>
                <p>Billing Clients</p>
            </div>
            <div class="icon">
                <i class="fas fa-file-invoice-dollar"></i>
            </div>
            <a href="#" class="small-box-footer">View <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <div class="col-lg-3 col-6">
        <div class="small-box bg-success">
            <div class="inner">
                <h3>{{ number_format($stats['paid_clients_month'] ?? 0) }}</h3>
                <p>Paid Clients</p>
            </div>
            <div class="icon">
                <i class="fas fa-check-circle"></i>
            </div>
            <a href="#" class="small-box-footer">View <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <div class="col-lg-3 col-6">
        <div class="small-box bg-warning">
            <div class="inner">
                <h3>{{ number_format($stats['partial_paid_clients_month'] ?? 0) }}</h3>
                <p>Partially Paid</p>
            </div>
            <div class="icon">
                <i class="fas fa-hand-holding"></i>
            </div>
            <a href="#" class="small-box-footer">View <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <div class="col-lg-3 col-6">
        <div class="small-box bg-secondary">
            <div class="inner">
                <h3>{{ number_format($stats['unpaid_clients_month'] ?? 0) }}</h3>
                <p>Unpaid Clients</p>
            </div>
            <div class="icon">
                <i class="fas fa-exclamation-circle"></i>
            </div>
            <a href="#" class="small-box-footer">View <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-3 col-6">
        <div class="small-box bg-info">
            <div class="inner">
                <h3>{{ number_format($stats['online_clients'] ?? 0) }}</h3>
                <p>Online Clients</p>
            </div>
            <div class="icon">
                <i class="fas fa-signal"></i>
            </div>
            <a href="#" class="small-box-footer">View <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <div class="col-lg-3 col-6">
        <div class="small-box bg-success">
            <div class="inner">
                <h3>{{ number_format($stats['blocked_clients'] ?? 0) }}</h3>
                <p>Blocked Clients</p>
            </div>
            <div class="icon">
                <i class="fas fa-ban"></i>
            </div>
            <a href="#" class="small-box-footer">View <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <div class="col-lg-3 col-6">
        <div class="small-box bg-warning">
            <div class="inner">
                <h3>{{ number_format($stats['bill_date_expire'] ?? 0) }}</h3>
                <p>Bill Date Expire</p>
            </div>
            <div class="icon">
                <i class="fas fa-calendar-times"></i>
            </div>
            <a href="#" class="small-box-footer">View <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <div class="col-lg-3 col-6">
        <div class="small-box bg-secondary">
            <div class="inner">
                <h3>{{ number_format($stats['unpaid_extension'] ?? 0) }}</h3>
                <p>Unpaid Extension</p>
            </div>
            <div class="icon">
                <i class="fas fa-clock"></i>
            </div>
            <a href="#" class="small-box-footer">View <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-3 col-6">
        <div class="small-box bg-info">
            <div class="inner">
                <h3>{{ number_format($stats['total_pop'] ?? 0) }}</h3>
                <p>Total Pop</p>
            </div>
            <div class="icon">
                <i class="fas fa-sitemap"></i>
            </div>
            <a href="#" class="small-box-footer">View <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <div class="col-lg-3 col-6">
        <div class="small-box bg-success">
            <div class="inner">
                <h3>{{ number_format($stats['total_pop_clients'] ?? 0) }}</h3>
                <p>Total Pop Clients</p>
            </div>
            <div class="icon">
                <i class="fas fa-network-wired"></i>
            </div>
            <a href="#" class="small-box-footer">View <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <div class="col-lg-3 col-6">
        <div class="small-box bg-warning">
            <div class="inner">
                <h3>{{ number_format($stats['enabled_pop_clients'] ?? 0) }}</h3>
                <p>Enabled Pop Clients</p>
            </div>
            <div class="icon">
                <i class="fas fa-toggle-on"></i>
            </div>
            <a href="#" class="small-box-footer">View <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <div class="col-lg-3 col-6">
        <div class="small-box bg-secondary">
            <div class="inner">
                <h3>{{ number_format($stats['disabled_pop_clients'] ?? 0) }}</h3>
                <p>Disabled Pop Clients</p>
            </div>
            <div class="icon">
                <i class="fas fa-toggle-off"></i>
            </div>
            <a href="#" class="small-box-footer">View <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-3">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Zone Wise Problem Occurrence</h3>
            </div>
            <div class="card-body">
                <canvas id="zoneWiseChart" height="210"></canvas>
            </div>
        </div>
    </div>
    <div class="col-lg-3">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Sub-Zone Wise Problem Occurrence</h3>
            </div>
            <div class="card-body">
                <canvas id="subZoneWiseChart" height="210"></canvas>
            </div>
        </div>
    </div>
    <div class="col-lg-3">
        <div class="small-box bg-danger" style="margin-bottom: 10px;">
            <div class="inner">
                <h3>{{ number_format($pendingTickets ?? 0) }}</h3>
                <p>Pending Tickets</p>
            </div>
            <div class="icon">
                <i class="fas fa-ticket-alt"></i>
            </div>
        </div>
        <div class="small-box bg-warning" style="margin-bottom: 10px;">
            <div class="inner">
                <h3>{{ number_format($processingTickets ?? 0) }}</h3>
                <p>Processing Tickets</p>
            </div>
            <div class="icon">
                <i class="fas fa-sync"></i>
            </div>
        </div>
        <div class="small-box bg-danger" style="margin-bottom: 10px;">
            <div class="inner">
                <h3>{{ number_format($pendingTasks ?? 0) }}</h3>
                <p>Pending Task</p>
            </div>
            <div class="icon">
                <i class="fas fa-tasks"></i>
            </div>
        </div>
        <div class="small-box bg-warning" style="margin-bottom: 0;">
            <div class="inner">
                <h3>{{ number_format($processingTasks ?? 0) }}</h3>
                <p>Processing Task</p>
            </div>
            <div class="icon">
                <i class="fas fa-cogs"></i>
            </div>
        </div>
    </div>
    <div class="col-lg-3">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Monthly Problem Occurrence</h3>
            </div>
            <div class="card-body">
                <canvas id="monthlyProblemChart" height="210"></canvas>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-6">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Top Packages (Customer Count)</h3>
            </div>
            <div class="card-body">
                <canvas id="problemSolverChart" height="230"></canvas>
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Monthly New Client</h3>
            </div>
            <div class="card-body">
                <canvas id="monthlyClientChart" height="230"></canvas>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-7">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Company Performance (Active Client)</h3>
            </div>
            <div class="card-body">
                <canvas id="companyPerformanceChart" height="230"></canvas>
            </div>
        </div>
    </div>
    <div class="col-lg-5">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Top 20 Unpaid Client</h3>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive" style="max-height: 260px;">
                    <table class="table table-striped table-hover mb-0">
                        <thead class="thead-light">
                            <tr>
                                <th>User Name</th>
                                <th>Mobile</th>
                                <th class="text-right">Bill Amount</th>
                                <th class="text-right">Due Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($topUnpaid as $r)
                                <tr>
                                    <td>{{ $r->customer->name ?? 'N/A' }}</td>
                                    <td>{{ $r->customer->phone ?? 'N/A' }}</td>
                                    <td class="text-right">{{ number_format((float) $r->bill_amount, 2) }}</td>
                                    <td class="text-right">{{ number_format((float) $r->due_amount, 2) }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center text-muted p-3">No data found</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-3 col-6">
        <div class="small-box bg-info">
            <div class="inner">
                <h3>{{ number_format((float) ($billing['monthly_bill'] ?? 0), 2) }}</h3>
                <p>Monthly Bill</p>
            </div>
            <div class="icon">
                <i class="fas fa-calendar-alt"></i>
            </div>
            <a href="#" class="small-box-footer">View <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <div class="col-lg-3 col-6">
        <div class="small-box bg-success">
            <div class="inner">
                <h3>{{ number_format((float) ($billing['collected_bill'] ?? 0), 2) }}</h3>
                <p>Collected Bill</p>
            </div>
            <div class="icon">
                <i class="fas fa-hand-holding-usd"></i>
            </div>
            <a href="#" class="small-box-footer">View <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <div class="col-lg-3 col-6">
        <div class="small-box bg-warning">
            <div class="inner">
                <h3>{{ number_format((float) ($billing['discount'] ?? 0), 2) }}</h3>
                <p>Discount</p>
            </div>
            <div class="icon">
                <i class="fas fa-percentage"></i>
            </div>
            <a href="#" class="small-box-footer">View <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <div class="col-lg-3 col-6">
        <div class="small-box bg-secondary">
            <div class="inner">
                <h3>{{ number_format((float) ($billing['total_due'] ?? 0), 2) }}</h3>
                <p>Total Due</p>
            </div>
            <div class="icon">
                <i class="fas fa-money-bill-wave"></i>
            </div>
            <a href="#" class="small-box-footer">View <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
</div>

<div class="row mb-2">
    <div class="col-12">
        <h5 class="mb-0">Finance Summary</h5>
    </div>
</div>

<div class="row">
    <div class="col-lg-3 col-6">
        <div class="small-box bg-info">
            <div class="inner">
                <h3>{{ number_format((float) ($finance['service_sales_invoice'] ?? 0), 2) }}</h3>
                <p>Service Sales Invoice</p>
            </div>
            <div class="icon">
                <i class="fas fa-receipt"></i>
            </div>
            <a href="#" class="small-box-footer">View <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <div class="col-lg-3 col-6">
        <div class="small-box bg-success">
            <div class="inner">
                <h3>{{ number_format((float) ($finance['product_sales_invoice'] ?? 0), 2) }}</h3>
                <p>Product Sales Invoice</p>
            </div>
            <div class="icon">
                <i class="fas fa-box"></i>
            </div>
            <a href="#" class="small-box-footer">View <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <div class="col-lg-3 col-6">
        <div class="small-box bg-warning">
            <div class="inner">
                <h3>{{ number_format((float) ($finance['income'] ?? 0), 2) }}</h3>
                <p>Income</p>
            </div>
            <div class="icon">
                <i class="fas fa-chart-line"></i>
            </div>
            <a href="#" class="small-box-footer">View <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <div class="col-lg-3 col-6">
        <div class="small-box bg-secondary">
            <div class="inner">
                <h3>{{ number_format((float) ($finance['expense'] ?? 0), 2) }}</h3>
                <p>Expense</p>
            </div>
            <div class="icon">
                <i class="fas fa-chart-pie"></i>
            </div>
            <a href="#" class="small-box-footer">View <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-3 col-6">
        <div class="small-box bg-info">
            <div class="inner">
                <h3>{{ number_format((float) ($finance['credited_amount'] ?? 0), 2) }}</h3>
                <p>Credited Amount</p>
            </div>
            <div class="icon">
                <i class="fas fa-money-check-alt"></i>
            </div>
            <a href="#" class="small-box-footer">View <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <div class="col-lg-3 col-6">
        <div class="small-box bg-success">
            <div class="inner">
                <h3>{{ number_format((float) ($finance['pop_fund'] ?? 0), 2) }}</h3>
                <p>POP Fund</p>
            </div>
            <div class="icon">
                <i class="fas fa-wallet"></i>
            </div>
            <a href="#" class="small-box-footer">View <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <div class="col-lg-3 col-6">
        <div class="small-box bg-warning">
            <div class="inner">
                <h3>{{ number_format((float) ($finance['pop_bill'] ?? 0), 2) }}</h3>
                <p>POP Bill</p>
            </div>
            <div class="icon">
                <i class="fas fa-file-invoice"></i>
            </div>
            <a href="#" class="small-box-footer">View <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <div class="col-lg-3 col-6">
        <div class="small-box bg-secondary">
            <div class="inner">
                <h3>{{ number_format((float) ($finance['receivable_amount'] ?? 0), 2) }}</h3>
                <p>Receivable Amount</p>
            </div>
            <div class="icon">
                <i class="fas fa-hand-holding-usd"></i>
            </div>
            <a href="#" class="small-box-footer">View <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-3 col-6">
        <div class="small-box bg-info">
            <div class="inner">
                <h3>{{ number_format((float) ($finance['bandwidth_provider_bill'] ?? 0), 2) }}</h3>
                <p>B.Width Provider Bill</p>
            </div>
            <div class="icon">
                <i class="fas fa-server"></i>
            </div>
            <a href="#" class="small-box-footer">View <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <div class="col-lg-3 col-6">
        <div class="small-box bg-success">
            <div class="inner">
                <h3>{{ number_format((float) ($finance['bandwidth_provider_due'] ?? 0), 2) }}</h3>
                <p>B.Width Provider Due</p>
            </div>
            <div class="icon">
                <i class="fas fa-exclamation-circle"></i>
            </div>
            <a href="#" class="small-box-footer">View <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <div class="col-lg-3 col-6">
        <div class="small-box bg-warning">
            <div class="inner">
                <h3>{{ number_format((float) ($finance['bandwidth_pop_bill'] ?? 0), 2) }}</h3>
                <p>B.Width POP Bill</p>
            </div>
            <div class="icon">
                <i class="fas fa-network-wired"></i>
            </div>
            <a href="#" class="small-box-footer">View <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <div class="col-lg-3 col-6">
        <div class="small-box bg-secondary">
            <div class="inner">
                <h3>{{ number_format((float) ($finance['paid_salary'] ?? 0), 2) }}</h3>
                <p>Paid Salary</p>
            </div>
            <div class="icon">
                <i class="fas fa-money-bill"></i>
            </div>
            <a href="#" class="small-box-footer">View <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-3 col-6">
        <div class="small-box bg-info">
            <div class="inner">
                <h3>{{ number_format((float) ($finance['sms_balance'] ?? 0), 2) }}</h3>
                <p>SMS Balance</p>
            </div>
            <div class="icon">
                <i class="fas fa-sms"></i>
            </div>
            <a href="#" class="small-box-footer">View <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <div class="col-lg-3 col-6">
        <div class="small-box bg-success">
            <div class="inner">
                <h3>{{ number_format((float) ($finance['purchase_payable_due'] ?? 0), 2) }}</h3>
                <p>Purchase Payable Due</p>
            </div>
            <div class="icon">
                <i class="fas fa-shopping-cart"></i>
            </div>
            <a href="#" class="small-box-footer">View <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <div class="col-lg-3 col-6">
        <div class="small-box bg-warning">
            <div class="inner">
                <h3>{{ number_format((float) ($finance['purchase_paid_amount'] ?? 0), 2) }}</h3>
                <p>Purchase Paid Amount</p>
            </div>
            <div class="icon">
                <i class="fas fa-cash-register"></i>
            </div>
            <a href="#" class="small-box-footer">View <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <div class="col-lg-3 col-6">
        <div class="small-box bg-secondary">
            <div class="inner">
                <h3>{{ number_format((float) ($finance['cash_on_hand'] ?? 0), 2) }}</h3>
                <p>Cash On Hand</p>
            </div>
            <div class="icon">
                <i class="fas fa-wallet"></i>
            </div>
            <a href="#" class="small-box-footer">View <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
</div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js"></script>
<script>
(function () {
  if (!window.Chart) return;

  const labels12 = @json(($charts['month_labels'] ?? collect())->values());
  const monthlyNew = @json(($charts['monthly_new_clients'] ?? collect())->values());
  const monthlyActive = @json(($charts['monthly_active_clients'] ?? collect())->values());
  const monthlyInactive = @json(($charts['monthly_inactive_clients'] ?? collect())->values());
  const monthlyExpired = @json(($charts['monthly_expired_clients'] ?? collect())->values());
  const statusLabels = @json(($charts['status_labels'] ?? collect())->values());
  const statusValues = @json(($charts['status_values'] ?? collect())->values());
  const invoiceStatusLabels = @json(($charts['invoice_status_labels'] ?? collect())->values());
  const invoiceStatusValues = @json(($charts['invoice_status_values'] ?? collect())->values());
  const topPackagesLabels = @json(($charts['top_packages_labels'] ?? collect())->values());
  const topPackagesValues = @json(($charts['top_packages_values'] ?? collect())->values());
  const problemZoneLabels = @json(($charts['problem_zone_labels'] ?? collect())->values());
  const problemZoneValues = @json(($charts['problem_zone_values'] ?? collect())->values());
  const problemSubZoneLabels = @json(($charts['problem_sub_zone_labels'] ?? collect())->values());
  const problemSubZoneValues = @json(($charts['problem_sub_zone_values'] ?? collect())->values());
  const problemTypeLabels = @json(($charts['problem_type_labels'] ?? collect())->values());
  const problemTypeValues = @json(($charts['problem_type_values'] ?? collect())->values());

  const doughnutOptions = {
    responsive: true,
    plugins: { legend: { position: 'right' } },
    cutout: '70%'
  };

  const zone = document.getElementById('zoneWiseChart');
  if (zone) {
    new Chart(zone, {
      type: 'doughnut',
      data: {
        labels: problemZoneLabels,
        datasets: [{ data: problemZoneValues, backgroundColor: ['#17a2b8', '#28a745', '#ffc107', '#dc3545', '#6f42c1', '#6c757d'], borderWidth: 0 }]
      },
      options: doughnutOptions
    });
  }

  const subZone = document.getElementById('subZoneWiseChart');
  if (subZone) {
    new Chart(subZone, {
      type: 'doughnut',
      data: {
        labels: problemSubZoneLabels,
        datasets: [{ data: problemSubZoneValues, backgroundColor: ['#007bff', '#6f42c1', '#17a2b8', '#6c757d', '#28a745', '#ffc107'], borderWidth: 0 }]
      },
      options: doughnutOptions
    });
  }

  const monthlyProblem = document.getElementById('monthlyProblemChart');
  if (monthlyProblem) {
    new Chart(monthlyProblem, {
      type: 'pie',
      data: {
        labels: problemTypeLabels,
        datasets: [{ data: problemTypeValues, backgroundColor: ['#17a2b8', '#28a745', '#ffc107', '#dc3545', '#6f42c1', '#6c757d', '#20c997', '#fd7e14'], borderWidth: 0 }]
      },
      options: { responsive: true, plugins: { legend: { position: 'right' } } }
    });
  }

  const solver = document.getElementById('problemSolverChart');
  if (solver) {
    new Chart(solver, {
      type: 'bar',
      data: {
        labels: topPackagesLabels,
        datasets: [{ label: 'Customers', data: topPackagesValues, backgroundColor: ['#6f42c1', '#17a2b8', '#28a745', '#ffc107', '#6c757d'] }]
      },
      options: { responsive: true, plugins: { legend: { display: false } } }
    });
  }

  const monthlyClient = document.getElementById('monthlyClientChart');
  if (monthlyClient) {
    const last6Labels = labels12.slice(-6);
    const last6New = monthlyNew.slice(-6);
    new Chart(monthlyClient, {
      type: 'bar',
      data: {
        labels: last6Labels,
        datasets: [{ label: 'New Client', data: last6New, backgroundColor: '#007bff' }]
      },
      options: { responsive: true, plugins: { legend: { display: false } } }
    });
  }

  const perf = document.getElementById('companyPerformanceChart');
  if (perf) {
    new Chart(perf, {
      type: 'bar',
      data: {
        labels: labels12,
        datasets: [
          { label: 'Active', data: monthlyActive, backgroundColor: '#17a2b8' },
          { label: 'Inactive', data: monthlyInactive, backgroundColor: '#6f42c1' }
        ]
      },
      options: { responsive: true }
    });
  }
})();
</script>
@endsection
