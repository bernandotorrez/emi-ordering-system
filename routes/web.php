<?php

use App\Http\Controllers\AdditionalOrderDatatablesController;
use App\Http\Controllers\DatatablesController;
use App\Http\Controllers\FixOrderDatatableController;
use App\Http\Controllers\SweetAlertController;
use Illuminate\Support\Facades\Route;
use App\Http\Livewire\Page\Home\HomeIndex;
use App\Http\Livewire\Page\About\AboutIndex;
use App\Http\Livewire\Page\AdditionalOrder\AdditionalOrderAdd;
use App\Http\Livewire\Page\AdditionalOrder\AdditionalOrderEdit;
use App\Http\Livewire\Page\AdditionalOrder\AdditionalOrderIndex;
use App\Http\Livewire\Page\FixOrder\FixOrderAdd;
use App\Http\Livewire\Page\AllocatedAtpm\AllocatedAtpmIndex;
use App\Http\Livewire\Page\ApprovalBM\ApprovalBMIndex;
use App\Http\Livewire\Page\ApprovedBM\ApprovedBMIndex;
use App\Http\Livewire\Page\ChildMenu\ChildMenuIndex;
use App\Http\Livewire\Page\FixOrder\FixOrderIndex;
use App\Http\Livewire\Page\Login\LoginIndex;
use App\Http\Livewire\Page\MenuUserGroup\MenuUserGroupIndex;
use App\Http\Livewire\Page\ParentMenu\ParentMenuIndex;
use App\Http\Livewire\Page\Register\RegisterIndex;
use App\Http\Livewire\Page\SubChildMenu\SubChildMenuIndex;
use App\Http\Livewire\Page\SubmitAtpm\SubmitAtpmIndex;
use App\Http\Livewire\Page\SubSubChildMenu\SubSubChildMenuIndex;
use App\Http\Livewire\Page\UserGroup\UserGroupIndex;
use App\Http\Livewire\Page\TestDetail\TestDetailIndex;
use App\Http\Livewire\Page\User\UserIndex;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function() {
    return redirect(route('login.index'));
});

Route::get('/login', LoginIndex::class)->middleware('guest')->name('login.index');
Route::get('/register', RegisterIndex::class)->name('register.index');
Route::get('/logout', function() {
    session()->forget(['user', 'level_access']);

    return redirect()->route('login.index');
})->name('logout');

Route::middleware('user.session')->group(function() {
    Route::get('/home', HomeIndex::class)->name('home.index');
    Route::get('/about', AboutIndex::class)->name('about.index');

    //Route::get('/car-model', CarModelIndex::class)->name('car-model.index');

    Route::get('/test-detail', TestDetailIndex::class)->name('test-detail.index');

    //Contoh Menu privilege
    Route::get('/parent-menu', ParentMenuIndex::class)->name('parent-menu.index');

    // Additional Order
    Route::get('/sales/dealer/additional-order', AdditionalOrderIndex::class)->name('additional-order.index');
    Route::get('/sales/dealer/additional-order/add', AdditionalOrderAdd::class)->name('additional-order.add');
    Route::get('/sales/dealer/additional-order/edit/{id?}', AdditionalOrderEdit::class)->name('additional-order.edit');

    // Fix Order
    Route::get('/sales/dealer/fix-order', FixOrderIndex::class)->name('fix-order.index');
    Route::get('/sales/dealer/fix-order/add', FixOrderAdd::class)->name('fix-order.add');
});

// Approval BM
Route::middleware(['user.session', 'bm.session'])->group(function() {
    Route::get('/sales/dealer/approval-bm', ApprovalBMIndex::class)->name('approval-bm.index');
    Route::get('/sales/dealer/approved-bm', ApprovedBMIndex::class)->name('approved-bm.index');
});

// APproval ATPM
Route::middleware(['user.session', 'atpm.session'])->group(function() {
    Route::get('/sales/atpm/submit-atpm', SubmitAtpmIndex::class)->name('submit-atpm.index');
    Route::get('/sales/atpm/allocated-atpm', AllocatedAtpmIndex::class)->name('allocated-atpm.index');
});

// Datatable Json
Route::middleware('user.session')->prefix('datatable')->group(function() {
    // Additional Order
    Route::get('additionalOrderJsonDraft', [AdditionalOrderDatatablesController::class, 'additionalOrderJsonDraft']);
    Route::get('additionalOrderJsonWaitingApprovalDealerPrinciple', [AdditionalOrderDatatablesController::class, 'additionalOrderJsonWaitingApprovalDealerPrinciple']);
    Route::get('additionalOrderJsonApprovalDealerPrinciple', [AdditionalOrderDatatablesController::class, 'additionalOrderJsonApprovalDealerPrinciple']);
    Route::get('additionalOrderJsonSubmittedATPM', [AdditionalOrderDatatablesController::class, 'additionalOrderJsonSubmittedATPM']);
    Route::get('additionalOrderJsonATPMAllocation', [AdditionalOrderDatatablesController::class, 'additionalOrderJsonATPMAllocation']);
    Route::get('additionalOrderJsonCanceled/{idCancel?}', [AdditionalOrderDatatablesController::class, 'additionalOrderJsonCanceled']);
    Route::get('detailAdditionalOrderJson/{id}', [AdditionalOrderDatatablesController::class, 'detailAdditionalOrderJson']);

    // Fix Order
    Route::get('fixOrderJson', [FixOrderDatatableController::class, 'fixOrderJson']);
});

// Sweet Alert
Route::middleware('user.session')->prefix('sweetalert')->group(function() {
    Route::post('additionalOrder/sendToApproval', [SweetAlertController::class, 'sendToApproval']);
    Route::post('additionalOrder/approvedBM', [SweetAlertController::class, 'approvedBM']);
    Route::post('additionalOrder/submitToAtpm', [SweetAlertController::class, 'submitToAtpm']);
    Route::post('additionalOrder/reviseBMDealer', [SweetAlertController::class, 'reviseBMDealer']);
    Route::post('additionalOrder/cancelBMDealer', [SweetAlertController::class, 'cancelBMDealer']);
    Route::post('additionalOrder/submittedAtpm', [SweetAlertController::class, 'submittedAtpm']);
    Route::post('additionalOrder/cancelSubmitATPM', [SweetAlertController::class, 'cancelSubmitATPM']);
    Route::post('additionalOrder/cancelAllocatedATPM', [SweetAlertController::class, 'cancelAllocatedATPM']);
});

Route::middleware('admin.session')->prefix('admin')->group(function() {
    Route::get('/user', UserIndex::class)->name('user.index');
    Route::get('/user-group', UserGroupIndex::class)->name('user-group.index');
    Route::get('/parent-menu', ParentMenuIndex::class)->name('parent-menu.index');
    Route::get('/child-menu', ChildMenuIndex::class)->name('child-menu.index');
    Route::get('/sub-child-menu', SubChildMenuIndex::class)->name('sub-child-menu.index');
    Route::get('/sub-sub-child-menu', SubSubChildMenuIndex::class)->name('sub-sub-child-menu.index');
    Route::get('/menu-user-group', MenuUserGroupIndex::class)->name('menu-user-group.index');
});
