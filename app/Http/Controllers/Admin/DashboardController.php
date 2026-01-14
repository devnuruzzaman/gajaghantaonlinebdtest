<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\FinanceEntry;
use App\Models\Invoice;
use App\Models\Payment;
use App\Models\Pop;
use App\Models\Problem;
use App\Models\Task;
use App\Models\Ticket;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $now = now();
        $today = $now->toDateString();
        $monthStart = $now->copy()->startOfMonth();
        $monthEnd = $now->copy()->endOfMonth();

        $hasCustomersDashboardColumns = Schema::hasColumn('customers', 'is_waiver')
            && Schema::hasColumn('customers', 'is_blocked')
            && Schema::hasColumn('customers', 'is_online')
            && Schema::hasColumn('customers', 'billing_due_date')
            && Schema::hasColumn('customers', 'is_extended')
            && Schema::hasColumn('customers', 'pop_id');

        $stats = [
            // Row 1
            'total_clients' => Customer::count(),
            'running_clients' => Customer::where('status', 'active')->count(),
            'inactive_clients' => Customer::where('status', 'inactive')->count(),
            'waiver_clients' => $hasCustomersDashboardColumns
                ? Customer::where('is_waiver', true)->count()
                : 0,

            // Row 2 (month based)
            'new_clients_month' => Customer::whereBetween('created_at', [$monthStart, $monthEnd])->count(),
            'renewed_clients_month' => Schema::hasTable('invoices')
                ? Invoice::whereBetween('billing_month', [$monthStart->toDateString(), $monthEnd->toDateString()])
                    ->where('status', 'paid')
                    ->distinct('customer_id')
                    ->count('customer_id')
                : 0,
            'deactivated_clients_month' => Customer::whereBetween('updated_at', [$monthStart, $monthEnd])
                ->whereIn('status', ['inactive', 'suspended', 'expired'])
                ->count(),
            'left_clients' => 0,

            // Row 3 (billing based)
            'billing_clients_month' => Schema::hasTable('invoices')
                ? Invoice::whereBetween('billing_month', [$monthStart->toDateString(), $monthEnd->toDateString()])
                    ->distinct('customer_id')
                    ->count('customer_id')
                : 0,
            'paid_clients_month' => Schema::hasTable('invoices')
                ? Invoice::whereBetween('billing_month', [$monthStart->toDateString(), $monthEnd->toDateString()])
                    ->where('status', 'paid')
                    ->distinct('customer_id')
                    ->count('customer_id')
                : 0,
            'partial_paid_clients_month' => Schema::hasTable('invoices')
                ? Invoice::whereBetween('billing_month', [$monthStart->toDateString(), $monthEnd->toDateString()])
                    ->where('status', 'partial')
                    ->distinct('customer_id')
                    ->count('customer_id')
                : 0,
            'unpaid_clients_month' => Schema::hasTable('invoices')
                ? Invoice::whereBetween('billing_month', [$monthStart->toDateString(), $monthEnd->toDateString()])
                    ->where('status', 'unpaid')
                    ->distinct('customer_id')
                    ->count('customer_id')
                : 0,

            // Row 4
            'online_clients' => $hasCustomersDashboardColumns
                ? Customer::where('is_online', true)->count()
                : 0,
            'blocked_clients' => $hasCustomersDashboardColumns
                ? Customer::where('is_blocked', true)->count()
                : 0,
            'bill_date_expire' => $hasCustomersDashboardColumns
                ? Customer::whereNotNull('billing_due_date')->whereDate('billing_due_date', '<', $today)->count()
                : 0,
            'unpaid_extension' => $hasCustomersDashboardColumns
                ? Customer::where('is_extended', true)->count()
                : 0,

            // Pop
            'total_pop' => Schema::hasTable('pops') ? Pop::count() : 0,
            'total_pop_clients' => ($hasCustomersDashboardColumns && Schema::hasTable('pops'))
                ? Customer::whereNotNull('pop_id')->count()
                : 0,
            'enabled_pop_clients' => ($hasCustomersDashboardColumns && Schema::hasTable('pops'))
                ? Customer::join('pops', 'customers.pop_id', '=', 'pops.id')
                    ->where('pops.status', 'enabled')
                    ->count('customers.id')
                : 0,
            'disabled_pop_clients' => ($hasCustomersDashboardColumns && Schema::hasTable('pops'))
                ? Customer::join('pops', 'customers.pop_id', '=', 'pops.id')
                    ->where('pops.status', 'disabled')
                    ->count('customers.id')
                : 0,
        ];

        $billing = [
            'monthly_bill' => Schema::hasTable('invoices')
                ? (float) Invoice::whereBetween('billing_month', [$monthStart->toDateString(), $monthEnd->toDateString()])->sum('amount')
                : 0.0,
            'collected_bill' => Schema::hasTable('payments')
                ? (float) Payment::whereBetween('created_at', [$monthStart, $monthEnd])->sum('amount')
                : 0.0,
            'discount' => Schema::hasTable('invoices')
                ? (float) Invoice::whereBetween('billing_month', [$monthStart->toDateString(), $monthEnd->toDateString()])->sum('discount')
                : 0.0,
            'total_due' => Schema::hasTable('invoices')
                ? (float) Invoice::where('status', '!=', 'paid')->sum('due_amount')
                : 0.0,
        ];

        $topUnpaid = Schema::hasTable('invoices')
            ? Invoice::query()
                ->selectRaw('customer_id, SUM(amount) as bill_amount, SUM(due_amount) as due_amount')
                ->where('status', '!=', 'paid')
                ->groupBy('customer_id')
                ->orderByDesc('due_amount')
                ->with(['customer:id,name,phone'])
                ->limit(20)
                ->get()
            : collect();

        $finance = [];
        if (Schema::hasTable('finance_entries')) {
            $monthly = FinanceEntry::whereBetween('entry_date', [$monthStart->toDateString(), $monthEnd->toDateString()]);
            $all = FinanceEntry::query();

            $finance = [
                // Monthly tiles
                'service_sales_invoice' => (float) (clone $monthly)->where('type', 'service_sales_invoice')->sum('amount'),
                'product_sales_invoice' => (float) (clone $monthly)->where('type', 'product_sales_invoice')->sum('amount'),
                'income' => (float) (clone $monthly)->where('type', 'income')->sum('amount'),
                'expense' => (float) (clone $monthly)->where('type', 'expense')->sum('amount'),
                'credited_amount' => (float) (clone $monthly)->where('type', 'credited_amount')->sum('amount'),
                'pop_fund' => (float) (clone $monthly)->where('type', 'pop_fund')->sum('amount'),
                'pop_bill' => (float) (clone $monthly)->where('type', 'pop_bill')->sum('amount'),
                'receivable_amount' => (float) (clone $monthly)->where('type', 'receivable_amount')->sum('amount'),
                'bandwidth_provider_bill' => (float) (clone $monthly)->where('type', 'bandwidth_provider_bill')->sum('amount'),
                'bandwidth_provider_due' => (float) (clone $monthly)->where('type', 'bandwidth_provider_due')->sum('amount'),
                'bandwidth_pop_bill' => (float) (clone $monthly)->where('type', 'bandwidth_pop_bill')->sum('amount'),
                'paid_salary' => (float) (clone $monthly)->where('type', 'paid_salary')->sum('amount'),
                'purchase_payable_due' => (float) (clone $monthly)->where('type', 'purchase_payable_due')->sum('amount'),
                'purchase_paid_amount' => (float) (clone $monthly)->where('type', 'purchase_paid_amount')->sum('amount'),
                'cash_on_hand' => (float) (clone $monthly)->where('type', 'cash_on_hand')->sum('amount'),

                // All-time
                'sms_balance' => (float) $all->where('type', 'sms_balance')->orderByDesc('entry_date')->value('amount'),
            ];
        }

        $monthLabels = collect(range(0, 11))
            ->map(fn ($i) => $now->copy()->subMonths(11 - $i)->format('M'))
            ->values();

        $monthStarts = collect(range(0, 11))
            ->map(fn ($i) => $now->copy()->subMonths(11 - $i)->startOfMonth())
            ->values();

        $monthlyNewClients = $monthStarts->map(function ($start) {
            $end = $start->copy()->endOfMonth();
            return Customer::whereBetween('created_at', [$start, $end])->count();
        });

        $monthlyActiveClients = $monthStarts->map(function ($start) {
            $end = $start->copy()->endOfMonth();
            return Customer::where('status', 'active')
                ->whereBetween('created_at', [$start, $end])
                ->count();
        });

        $monthlyInactiveClients = $monthStarts->map(function ($start) {
            $end = $start->copy()->endOfMonth();
            return Customer::whereIn('status', ['inactive', 'suspended', 'expired'])
                ->whereBetween('created_at', [$start, $end])
                ->count();
        });

        $monthlyExpiredClients = $monthStarts->map(function ($start) {
            $end = $start->copy()->endOfMonth();
            return Customer::where('status', 'expired')
                ->whereBetween('created_at', [$start, $end])
                ->count();
        });

        $topPackages = Schema::hasTable('packages')
            ? Customer::join('packages', 'customers.package_id', '=', 'packages.id')
                ->select('packages.name', DB::raw('count(customers.id) as total'))
                ->groupBy('packages.name')
                ->orderByDesc('total')
                ->limit(5)
                ->get()
            : collect();

        $statusDistribution = Customer::select('status', DB::raw('count(*) as total'))
            ->groupBy('status')
            ->pluck('total', 'status');

        $invoiceStatusDistribution = Schema::hasTable('invoices')
            ? Invoice::select('status', DB::raw('count(*) as total'))
                ->whereBetween('billing_month', [$monthStart->toDateString(), $monthEnd->toDateString()])
                ->groupBy('status')
                ->pluck('total', 'status')
            : collect();

        $charts = [
            'month_labels' => $monthLabels,
            'monthly_new_clients' => $monthlyNewClients,
            'monthly_active_clients' => $monthlyActiveClients,
            'monthly_inactive_clients' => $monthlyInactiveClients,
            'monthly_expired_clients' => $monthlyExpiredClients,
            'status_labels' => $statusDistribution->keys()->values(),
            'status_values' => $statusDistribution->values(),
            'invoice_status_labels' => $invoiceStatusDistribution->keys()->values(),
            'invoice_status_values' => $invoiceStatusDistribution->values(),
            'top_packages_labels' => $topPackages->pluck('name')->values(),
            'top_packages_values' => $topPackages->pluck('total')->values(),
        ];

        $pendingTickets = Schema::hasTable('tickets') ? Ticket::where('status', 'pending')->count() : 0;
        $processingTickets = Schema::hasTable('tickets') ? Ticket::where('status', 'processing')->count() : 0;
        $pendingTasks = Schema::hasTable('tasks') ? Task::where('status', 'pending')->count() : 0;
        $processingTasks = Schema::hasTable('tasks') ? Task::where('status', 'processing')->count() : 0;

        $problemZones = Schema::hasTable('problems')
            ? Problem::select('zone', DB::raw('count(*) as total'))
                ->whereNotNull('zone')
                ->groupBy('zone')
                ->orderByDesc('total')
                ->limit(6)
                ->get()
            : collect();

        $problemSubZones = Schema::hasTable('problems')
            ? Problem::select('sub_zone', DB::raw('count(*) as total'))
                ->whereNotNull('sub_zone')
                ->groupBy('sub_zone')
                ->orderByDesc('total')
                ->limit(6)
                ->get()
            : collect();

        $problemTypes = Schema::hasTable('problems')
            ? Problem::select('problem_type', DB::raw('count(*) as total'))
                ->whereNotNull('problem_type')
                ->groupBy('problem_type')
                ->orderByDesc('total')
                ->limit(8)
                ->get()
            : collect();

        $charts['problem_zone_labels'] = $problemZones->pluck('zone')->values();
        $charts['problem_zone_values'] = $problemZones->pluck('total')->values();
        $charts['problem_sub_zone_labels'] = $problemSubZones->pluck('sub_zone')->values();
        $charts['problem_sub_zone_values'] = $problemSubZones->pluck('total')->values();
        $charts['problem_type_labels'] = $problemTypes->pluck('problem_type')->values();
        $charts['problem_type_values'] = $problemTypes->pluck('total')->values();

        return view('admin.dashboard', compact('stats', 'billing', 'topUnpaid', 'charts', 'finance', 'pendingTickets', 'processingTickets', 'pendingTasks', 'processingTasks'));
    }
}
