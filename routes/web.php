<?php

use App\Http\Controllers\AdditionalOrderDatatablesController;
use App\Http\Controllers\AdditionalOrderSweetAlertController;
use App\Http\Controllers\FixOrderAjaxController;
use App\Http\Controllers\FixOrderDatatableController;
use App\Http\Controllers\FixOrderSweetAlertController;
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
use App\Http\Livewire\Page\FixOrder\FixOrderPrinciple;
use App\Http\Livewire\Page\Login\LoginIndex;
use App\Http\Livewire\Page\MenuUserGroup\MenuUserGroupIndex;
use App\Http\Livewire\Page\ParentMenu\ParentMenuIndex;
use App\Http\Livewire\Page\Register\RegisterIndex;
use App\Http\Livewire\Page\SubChildMenu\SubChildMenuIndex;
use App\Http\Livewire\Page\SubmitAtpm\SubmitAtpmIndex;
use App\Http\Livewire\Page\SubSubChildMenu\SubSubChildMenuIndex;
use App\Http\Livewire\Page\UserGroup\UserGroupIndex;
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
    session()->flush();

    return redirect()->route('login.index');
})->name('logout');

Route::middleware('user.session')->group(function() {
    Route::get('/home', HomeIndex::class)->name('home.index');
    Route::get('/about', AboutIndex::class)->name('about.index');

    // Additional Order
    Route::get('/sales/dealer/additional-order', AdditionalOrderIndex::class)->name('additional-order.index');
    Route::get('/sales/dealer/additional-order/add', AdditionalOrderAdd::class)->name('additional-order.add');
    Route::get('/sales/dealer/additional-order/edit/{id?}', AdditionalOrderEdit::class)->name('additional-order.edit');

    // Fix Order
    Route::get('/sales/dealer/fix-order', FixOrderIndex::class)->name('fix-order.index');
    Route::get('/sales/dealer/fix-order/add/{idMonth?}', FixOrderAdd::class)->name('fix-order.add');
});

// Approval BM
Route::middleware(['user.session', 'bm.session'])->group(function() {
    Route::get('/sales/dealer/approval-bm', ApprovalBMIndex::class)->name('approval-bm.index');
    Route::get('/sales/dealer/approved-bm', ApprovedBMIndex::class)->name('approved-bm.index');
    Route::get('/sales/dealer/fix-order-bm', FixOrderPrinciple::class)->name('fix-order.principle');
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
    Route::get('FixOrderJsonApprovalBM', [FixOrderDatatableController::class, 'FixOrderJsonApprovalBM']);
    Route::get('detailFixOrderJson/{id}', [FixOrderDatatableController::class, 'detailFixOrderJson']);
    Route::get('subDetailFixOrderJson/{id}', [FixOrderDatatableController::class, 'subDetailFixOrderJson']);
});

// Sweet Alert
Route::middleware('user.session')->prefix('sweetalert')->group(function() {
    Route::post('additionalOrder/sendToApproval', [AdditionalOrderSweetAlertController::class, 'sendToApproval']);
    Route::post('additionalOrder/approvedBM', [AdditionalOrderSweetAlertController::class, 'approvedBM']);
    Route::post('additionalOrder/submitToAtpm', [AdditionalOrderSweetAlertController::class, 'submitToAtpm']);
    Route::post('additionalOrder/reviseBMDealer', [AdditionalOrderSweetAlertController::class, 'reviseBMDealer']);
    Route::post('additionalOrder/cancelBMDealer', [AdditionalOrderSweetAlertController::class, 'cancelBMDealer']);
    Route::post('additionalOrder/submittedAtpm', [AdditionalOrderSweetAlertController::class, 'submittedAtpm']);
    Route::post('additionalOrder/cancelSubmitATPM', [AdditionalOrderSweetAlertController::class, 'cancelSubmitATPM']);
    Route::post('additionalOrder/cancelAllocatedATPM', [AdditionalOrderSweetAlertController::class, 'cancelAllocatedATPM']);

    // Fix Order
    Route::post('fixOrder/sendToApproval', [FixOrderSweetAlertController::class, 'sendToApproval']);
    Route::post('fixOrder/approvalBM', [FixOrderSweetAlertController::class, 'approvalBM']);
    Route::post('fixOrder/planningToAtpm', [FixOrderSweetAlertController::class, 'planningToAtpm']);
    Route::post('fixOrder/reviseBM', [FixOrderSweetAlertController::class, 'reviseBM']);
});

// Ajax
Route::middleware('user.session')->prefix('ajax')->group(function() {
    Route::get('fixOrder/rangeMonthFixOrder', [FixOrderAjaxController::class, 'rangeMonthFixOrder']);
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
