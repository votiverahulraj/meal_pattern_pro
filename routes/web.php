

<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\TermsController;
use App\Http\Controllers\TestAuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\FamilyController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;

Route::get('/prodouct_request', function () {
    return view('pages.products.product_requests.index');
});
Route::get('/myprodouct', function () {
    return view('pages.products.myproduct');
});
Route::get('/', function () {
    return view('auth.login');
});

// route use by atul

Route::get('/custom-register', [AuthController::class,'customregister'])->name('custom.register');
Route::post('/custom-register-process', [AuthController::class,'registerProcess'])->name('custom.register.process');
Route::post('/login-process', [AuthController::class,'Authenticated'])->name('login.process');

Route::middleware('auth')->group(function(){
    Route::get('/district/dashboard', [AuthController::class,'districtDashboard'])->name('district.dashboard');
});

Route::get('/user/list', [UserController::class,'userList'])->name('user.list');
    Route::get('/user/add', [UserController::class,'userAdd'])->name('user.add');
    Route::get('/user/details/{id}', [UserController::class,'userDetails'])->name('user.details');
    Route::post('/user-process', [UserController::class,'userProcess'])->name('user.process');
    Route::post('/user-update/{id}', [UserController::class,'userUpdate'])->name('user.update');
    Route::get('/user/edit/{id}', [UserController::class,'userEdit'])->name('user.edit');
    Route::get('/user/delete/{id}', [UserController::class,'userDelete'])->name('user.delete');




Route::get('/dashboard', function () {
    return view('dashboard.index');
})->middleware('auth')->name('dashboard');


// route meal start ---------------------
    // Authentication Routes
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

// Terms Acceptance Routes
Route::get('/terms', [TermsController::class, 'showTermsForm'])->name('terms.accept');
Route::post('/terms', [TermsController::class, 'acceptTerms'])->name('terms.store');

use App\Http\Controllers\Admin\DashboardController as AdminDashboard;
use App\Http\Controllers\District\DashboardController as DistrictDashboard;

// Admin Routes
// Route::middleware(['auth','role:admin'])->prefix('admin')->group(function(){
//     Route::get('/dashboard', [AdminDashboard::class, 'index'])->name('admin.dashboard');
    
//     // Admin-specific routes for managing products, families, etc.
//     Route::resource('products', ProductController::class);
Route::middleware(['auth','role:admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function(){

    Route::get('/dashboard', [AdminDashboard::class, 'index'])->name('dashboard');
    
    Route::get('products/export', [ProductController::class, 'export'])
            ->name('products.export');
    Route::resource('products', ProductController::class);
    Route::post('products/import', [ProductController::class, 'import'])
            ->name('products.import');
   
      


    Route::resource('families', FamilyController::class)->names([
        'index' => 'admin.families.index',
        'create' => 'admin.families.create',
        'store' => 'admin.families.store',
        'show' => 'admin.families.show',
        'edit' => 'admin.families.edit',
        'update' => 'admin.families.update',
        'destroy' => 'admin.families.destroy',
    ]);
    Route::resource('subscriptions', SubscriptionController::class);
    Route::resource('messages', MessageController::class);
    
    // Additional admin routes
    Route::get('/reports', [ReportController::class, 'index'])->name('admin.reports');
    Route::get('/reports/compliance', [ReportController::class, 'generateComplianceReport'])->name('admin.reports.compliance');
    Route::get('/reports/debt-recovery', [ReportController::class, 'generateDebtRecoveryReport'])->name('admin.reports.debt');
    Route::get('/reports/payments', [ReportController::class, 'generatePaymentReport'])->name('admin.reports.payments');
    Route::get('/reports/product-analytics', [ReportController::class, 'productAnalytics'])->name('admin.reports.product.analytics');
    Route::get('/reports/debt-analytics', [ReportController::class, 'debtRecoveryAnalytics'])->name('admin.reports.debt.analytics');
});

// District Routes
Route::middleware(['auth','role:district'])->prefix('district')->group(function(){
    Route::get('/dashboard', [DistrictDashboard::class, 'index'])->name('district.dashboard');
    
    // District-specific routes
    Route::get('/browse', [ProductController::class, 'browse'])->name('district.products.browse');
    Route::get('/my-products', [ProductController::class, 'index'])->name('district.products.index');
    Route::get('/products/{product}', [ProductController::class, 'show'])->name('district.products.show');
    Route::post('/products/{product}/save', [ProductController::class, 'saveToCollection'])->name('district.products.save');
    Route::post('/products/{product}/upload-file', [ProductController::class, 'uploadFile'])->name('district.products.upload.file');
    
    // Subscription management
    Route::get('/subscription', [SubscriptionController::class, 'manage'])->name('district.subscription.manage');
    Route::get('/subscribe', [SubscriptionController::class, 'subscribe'])->name('district.subscribe');
    Route::post('/subscription/{subscription}/cancel', [SubscriptionController::class, 'cancel'])->name('district.subscription.cancel');
    Route::get('/subscription/capacity', [SubscriptionController::class, 'getCapacity'])->name('district.subscription.capacity');
    
    // Reports
    Route::get('/reports', [ReportController::class, 'index'])->name('district.reports.index');
    Route::get('/reports/compliance', [ReportController::class, 'generateComplianceReport'])->name('district.reports.compliance');
    Route::get('/reports/debt-recovery', [ReportController::class, 'generateDebtRecoveryReport'])->name('district.reports.debt');
    Route::get('/reports/payments', [ReportController::class, 'generatePaymentReport'])->name('district.reports.payments');
    Route::get('/reports/product-analytics', [ReportController::class, 'productAnalytics'])->name('district.reports.product.analytics');
    Route::get('/reports/debt-analytics', [ReportController::class, 'debtRecoveryAnalytics'])->name('district.reports.debt.analytics');
    
    // Families (debt recovery)
    Route::resource('families', FamilyController::class)->names([
        'index' => 'district.families.index',
        'create' => 'district.families.create',
        'store' => 'district.families.store',
        'show' => 'district.families.show',
        'edit' => 'district.families.edit',
        'update' => 'district.families.update',
        'destroy' => 'district.families.destroy',
    ]);
    Route::get('/families-search', [FamilyController::class, 'search'])->name('district.families.search');
    Route::get('/families-export', [FamilyController::class, 'exportCsv'])->name('district.families.export');
    Route::get('/families-capacity', [FamilyController::class, 'getCapacity'])->name('district.families.capacity');
    
    // Messages
    Route::resource('messages', MessageController::class);
    Route::post('/messages/{message}/reply', [MessageController::class, 'reply'])->name('district.messages.reply');
    Route::post('/messages/{message}/mark-read', [MessageController::class, 'markAsRead'])->name('district.messages.mark.read');
    Route::get('/messages-unread-count', [MessageController::class, 'unreadCount'])->name('district.messages.unread.count');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Test route for authentication
Route::get('/test-auth', [TestAuthController::class, 'testApexAuth'])->middleware('auth');

// -----------end




Route::get('/table', function () {
    return view('pages.table');
});

Route::get('/form', function () {
    return view('pages.form');
});


// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

//     //  Route::resource('products', ProductController::class);

// });

require __DIR__.'/auth.php';
