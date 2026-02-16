<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Family;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\Pdf; // Assuming we're using barryvdh/laravel-dompdf

class ReportController extends Controller
{
    /**
     * Show the reports index page.
     */
    public function index()
    {
        return view('reports.index');
    }

    /**
     * Generate compliance report for products.
     */
    public function generateComplianceReport(Request $request)
    {
        $user = Auth::user();
        
        $products = Product::where('district_id', $user->district_id)
                         ->with(['files'])
                         ->get();

        $data = [
            'title' => 'Meal Pattern Compliance Report',
            'date' => now()->format('Y-m-d'),
            'district' => $user->district,
            'products' => $products,
        ];

        $pdf = Pdf::loadView('reports.compliance', $data);
        return $pdf->download('compliance-report-' . now()->format('Y-m-d') . '.pdf');
    }

    /**
     * Generate debt recovery report.
     */
    public function generateDebtRecoveryReport(Request $request)
    {
        $user = Auth::user();
        
        $families = Family::where('district_id', $user->district_id)
                        ->select(['primary_contact_name', 'student_names', 'outstanding_balance', 'recovery_status', 'collection_status'])
                        ->get();

        $totalOutstanding = $families->sum('outstanding_balance');
        $activeFamilies = $families->where('recovery_status', 'active')->count();
        $paidFamilies = $families->where('recovery_status', 'paid')->count();

        $data = [
            'title' => 'Debt Recovery Report',
            'date' => now()->format('Y-m-d'),
            'district' => $user->district,
            'families' => $families,
            'total_outstanding' => $totalOutstanding,
            'active_families' => $activeFamilies,
            'paid_families' => $paidFamilies,
        ];

        $pdf = Pdf::loadView('reports.debt-recovery', $data);
        return $pdf->download('debt-recovery-report-' . now()->format('Y-m-d') . '.pdf');
    }

    /**
     * Generate payment report.
     */
    public function generatePaymentReport(Request $request)
    {
        $user = Auth::user();
        
        $startDate = $request->start_date ?? now()->subDays(30)->format('Y-m-d');
        $endDate = $request->end_date ?? now()->format('Y-m-d');

        $payments = Payment::whereHas('family', function($query) use ($user) {
                                $query->where('district_id', $user->district_id);
                            })
                            ->whereBetween('payment_date', [$startDate, $endDate])
                            ->with(['family'])
                            ->get();

        $totalPayments = $payments->sum('amount');

        $data = [
            'title' => 'Payment Report',
            'date' => now()->format('Y-m-d'),
            'district' => $user->district,
            'payments' => $payments,
            'total_payments' => $totalPayments,
            'start_date' => $startDate,
            'end_date' => $endDate,
        ];

        $pdf = Pdf::loadView('reports.payments', $data);
        return $pdf->download('payment-report-' . now()->format('Y-m-d') . '.pdf');
    }

    /**
     * Show product analytics report.
     */
    public function productAnalytics()
    {
        $user = Auth::user();
        
        $products = Product::where('district_id', $user->district_id)
                         ->withCount(['files'])
                         ->get();

        $totalProducts = $products->count();
        $productsWithFiles = $products->filter(function($product) {
            return $product->files_count > 0;
        })->count();

        $data = [
            'title' => 'Product Analytics Report',
            'date' => now()->format('Y-m-d'),
            'district' => $user->district,
            'products' => $products,
            'total_products' => $totalProducts,
            'products_with_files' => $productsWithFiles,
        ];

        return view('reports.product-analytics', $data);
    }

    /**
     * Show debt recovery analytics report.
     */
    public function debtRecoveryAnalytics()
    {
        $user = Auth::user();
        
        $families = Family::where('district_id', $user->district_id)->get();
        $payments = Payment::whereHas('family', function($query) use ($user) {
                                $query->where('district_id', $user->district_id);
                            })
                            ->get();

        $totalOutstanding = $families->sum('outstanding_balance');
        $totalCollected = $payments->sum('amount');
        $recoveryRate = $totalOutstanding > 0 ? ($totalCollected / $totalOutstanding) * 100 : 0;

        $statusCounts = [
            'active' => $families->where('recovery_status', 'active')->count(),
            'payment_plan' => $families->where('recovery_status', 'payment_plan')->count(),
            'paid' => $families->where('recovery_status', 'paid')->count(),
            'inactive' => $families->where('recovery_status', 'inactive')->count(),
        ];

        $data = [
            'title' => 'Debt Recovery Analytics Report',
            'date' => now()->format('Y-m-d'),
            'district' => $user->district,
            'total_outstanding' => $totalOutstanding,
            'total_collected' => $totalCollected,
            'recovery_rate' => $recoveryRate,
            'status_counts' => $statusCounts,
        ];

        return view('reports.debt-analytics', $data);
    }
}
