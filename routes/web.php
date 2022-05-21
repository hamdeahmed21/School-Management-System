<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AssignStudentController;
use App\Http\Controllers\Admin\AssignSubjectController;
use App\Http\Controllers\Admin\DesignationController;
use App\Http\Controllers\Admin\ExamFeeController;
use App\Http\Controllers\Admin\ExamTypeController;
use App\Http\Controllers\Admin\FeeAmountController;
use App\Http\Controllers\Admin\FeeCategoryController;
use App\Http\Controllers\Admin\MonthlyFeeController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\SchoolSubjectController;
use App\Http\Controllers\Admin\StudentClassController;
use App\Http\Controllers\Admin\StudentGroupController;
use App\Http\Controllers\Admin\StudentRollController;
use App\Http\Controllers\Admin\StudentShiftController;
use App\Http\Controllers\Admin\StudentYearController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\RegistrationFeeController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('auth.login');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.index');
    })->name('dashboard');
});
Route::get('/logout',[AdminController::class, 'index'])->name('admin.logout');

//manage user
Route::prefix('users')->group(function () {

Route::get('/view',[UserController::class, 'index'])->name('user.view');
    Route::get('/add',[UserController::class, 'create'])->name('users.add');
    Route::post('/store',[UserController::class, 'store'])->name('users.store');
    Route::get('/edit/{id}',[UserController::class, 'edit'])->name('users.edit');
    Route::post('/update/{id}',[UserController::class, 'update'])->name('update.user');
    Route::get('/delete/{id}',[UserController::class, 'destroy'])->name('users.delete');
});
//end manage user

//User Profile and Change Password
 Route::prefix('profile')->group(function(){
Route::get('/view', [ProfileController::class, 'index'])->name('profile.view');
Route::get('/edit', [ProfileController::class, 'edit'])->name('profile.edit');
Route::post('/store', [ProfileController::class, 'store'])->name('profile.store');
Route::get('/password/view', [ProfileController::class, 'PasswordView'])->name('password.view');
Route::post('/password/update', [ProfileController::class, 'PasswordUpdate'])->name('password.update');
});
//End User Profile and Change Password
Route::prefix('setups')->group(function() {

// Student Class Routes
    Route::get('student/class/view', [StudentClassController::class, 'index'])->name('student.class.view');
    Route::get('student/class/create', [StudentClassController::class, 'create'])->name('student.class.add');
    Route::post('student/class/store', [StudentClassController::class, 'store'])->name('store.student.class');
    Route::get('student/class/edit/{id}', [StudentClassController::class, 'edit'])->name('student.class.edit');
    Route::post('student/class/update/{id}', [StudentClassController::class, 'update'])->name('update.student.class');
    Route::get('student/class/delete/{id}', [StudentClassController::class, 'destroy'])->name('student.class.delete');
    // Student Year Routes

    Route::get('student/year/view', [StudentYearController::class, 'index'])->name('student.year.view');
    Route::get('student/year/add', [StudentYearController::class, 'create'])->name('student.year.add');
    Route::post('student/year/store', [StudentYearController::class, 'store'])->name('store.student.year');
    Route::get('student/year/edit/{id}', [StudentYearController::class, 'edit'])->name('student.year.edit');
    Route::post('student/year/update/{id}', [StudentYearController::class, 'update'])->name('update.student.year');
    Route::get('student/year/delete/{id}', [StudentYearController::class, 'destroy'])->name('student.year.delete');
    // Student Group Routes

    Route::get('student/group/view', [StudentGroupController::class, 'index'])->name('student.group.view');
    Route::get('student/group/add', [StudentGroupController::class, 'create'])->name('student.group.add');
    Route::post('student/group/store', [StudentGroupController::class, 'store'])->name('store.student.group');
    Route::get('student/group/edit/{id}', [StudentGroupController::class, 'edit'])->name('student.group.edit');
    Route::post('student/group/update/{id}', [StudentGroupController::class, 'update'])->name('update.student.group');
    Route::get('student/group/delete/{id}', [StudentGroupController::class, 'destroy'])->name('student.group.delete');
    // Student Shift Routes

    Route::get('student/shift/view', [StudentShiftController::class, 'index'])->name('student.shift.view');
    Route::get('student/shift/add', [StudentShiftController::class, 'create'])->name('student.shift.add');
    Route::post('student/shift/store', [StudentShiftController::class, 'store'])->name('store.student.shift');
    Route::get('student/shift/edit/{id}', [StudentShiftController::class, 'edit'])->name('student.shift.edit');
    Route::post('student/shift/update/{id}', [StudentShiftController::class, 'update'])->name('update.student.shift');
    Route::get('student/shift/delete/{id}', [StudentShiftController::class, 'destroy'])->name('student.shift.delete');

    // Fee Category Routes

    Route::get('fee/category/view', [FeeCategoryController::class, 'index'])->name('fee.category.view');
    Route::get('fee/category/add', [FeeCategoryController::class, 'create'])->name('fee.category.add');
    Route::post('fee/category/store', [FeeCategoryController::class, 'store'])->name('store.fee.category');
    Route::get('fee/category/edit/{id}', [FeeCategoryController::class, 'edit'])->name('fee.category.edit');
    Route::post('fee/category/update/{id}', [FeeCategoryController::class, 'update'])->name('update.fee.category');
    Route::get('fee/category/delete/{id}', [FeeCategoryController::class, 'destroy'])->name('fee.category.delete');

    // Fee Category Amount Routes

    Route::get('fee/amount/view', [FeeAmountController::class, 'index'])->name('fee.amount.view');
    Route::get('fee/amount/add', [FeeAmountController::class, 'create'])->name('fee.amount.add');

    Route::post('fee/amount/store', [FeeAmountController::class, 'store'])->name('store.fee.amount');

    Route::get('fee/amount/edit/{fee_category_id}', [FeeAmountController::class, 'edit'])->name('fee.amount.edit');

    Route::post('fee/amount/update/{fee_category_id}', [FeeAmountController::class, 'update'])->name('update.fee.amount');

    Route::get('fee/amount/details/{fee_category_id}', [FeeAmountController::class, 'Details'])->name('fee.amount.details');

    // Exam Type Routes

    Route::get('exam/type/view', [ExamTypeController::class, 'index'])->name('exam.type.view');

    Route::get('exam/type/add', [ExamTypeController::class, 'create'])->name('exam.type.add');

    Route::post('exam/type/store', [ExamTypeController::class, 'store'])->name('store.exam.type');

    Route::get('exam/type/edit/{id}', [ExamTypeController::class, 'edit'])->name('exam.type.edit');

    Route::post('exam/type/update/{id}', [ExamTypeController::class, 'update'])->name('update.exam.type');

    Route::get('exam/type/delete/{id}', [ExamTypeController::class, 'destroy'])->name('exam.type.delete');

    // School Subject All Routes

    Route::get('school/subject/view', [SchoolSubjectController::class, 'index'])->name('school.subject.view');

    Route::get('school/subject/add', [SchoolSubjectController::class, 'create'])->name('school.subject.add');

    Route::post('school/subject/store', [SchoolSubjectController::class, 'store'])->name('store.school.subject');

    Route::get('school/subject/edit/{id}', [SchoolSubjectController::class, 'edit'])->name('school.subject.edit');

    Route::post('school/subject/update/{id}', [SchoolSubjectController::class, 'update'])->name('update.school.subject');

    Route::get('school/subject/delete/{id}', [SchoolSubjectController::class, 'destroy'])->name('school.subject.delete');

    // Assign Subject Routes

    Route::get('assign/subject/view', [AssignSubjectController::class, 'index'])->name('assign.subject.view');

    Route::get('assign/subject/add', [AssignSubjectController::class, 'create'])->name('assign.subject.add');

    Route::post('assign/subject/store', [AssignSubjectController::class, 'store'])->name('store.assign.subject');

    Route::get('assign/subject/edit/{class_id}', [AssignSubjectController::class, 'edit'])->name('assign.subject.edit');

    Route::post('assign/subject/update/{class_id}', [AssignSubjectController::class, 'update'])->name('update.assign.subject');

    Route::get('assign/subject/details/{class_id}', [AssignSubjectController::class, 'Details'])->name('assign.subject.details');

    // Designation All Routes

    Route::get('designation/view', [DesignationController::class, 'index'])->name('designation.view');

    Route::get('designation/add', [DesignationController::class, 'create'])->name('designation.add');

    Route::post('designation/store', [DesignationController::class, 'store'])->name('store.designation');

    Route::get('designation/edit/{id}', [DesignationController::class, 'edit'])->name('designation.edit');

    Route::post('designation/update/{id}', [DesignationController::class, 'update'])->name('update.designation');

    Route::get('designation/delete/{id}', [DesignationController::class, 'destroy'])->name('designation.delete');

});
/// Student Registration Routes
Route::prefix('students')->group(function() {

    Route::get('/reg/view', [AssignStudentController::class, 'index'])->name('student.registration.view');

    Route::get('/reg/Add', [AssignStudentController::class, 'create'])->name('student.registration.add');

    Route::post('/reg/store', [AssignStudentController::class, 'store'])->name('store.student.registration');

    Route::get('/year/class/wise', [AssignStudentController::class, 'ClassYearWise'])->name('student.year.class.wise');

    Route::get('/reg/edit/{student_id}', [AssignStudentController::class, 'edit'])->name('student.registration.edit');

    Route::post('/reg/update/{student_id}', [AssignStudentController::class, 'update'])->name('update.student.registration');

    Route::get('/reg/promotion/{student_id}', [AssignStudentController::class, 'RegPromotion'])->name('student.registration.promotion');

    Route::post('/reg/update/promotion/{student_id}', [AssignStudentController::class, 'UpdatePromotion'])->name('promotion.student.registration');

    Route::get('/reg/details/{student_id}', [AssignStudentController::class, 'Details'])->name('student.registration.details');

    // Student Roll Generate Routes
    Route::get('/roll/generate/view', [StudentRollController::class, 'StudentRollView'])->name('roll.generate.view');

    Route::get('/reg/getstudents', [StudentRollController::class, 'GetStudents'])->name('student.registration.getstudents');

    Route::post('/roll/generate/store', [StudentRollController::class, 'StudentRollStore'])->name('roll.generate.store');
// Registration Fee Routes
    Route::get('/reg/fee/view', [RegistrationFeeController::class, 'RegFeeView'])->name('registration.fee.view');

    Route::get('/reg/fee/classwisedata', [RegistrationFeeController::class, 'RegFeeClassData'])->name('student.registration.fee.classwise.get');

    Route::get('/reg/fee/payslip', [RegistrationFeeController::class, 'RegFeePayslip'])->name('student.registration.fee.payslip');
    // Monthly Fee Routes
    Route::get('/monthly/fee/view', [MonthlyFeeController::class, 'MonthlyFeeView'])->name('monthly.fee.view');

    Route::get('/monthly/fee/classwisedata', [MonthlyFeeController::class, 'MonthlyFeeClassData'])->name('student.monthly.fee.classwise.get');

    Route::get('/monthly/fee/payslip', [MonthlyFeeController::class, 'MonthlyFeePayslip'])->name('student.monthly.fee.payslip');

// Exam Fee Routes
    Route::get('/exam/fee/view', [ExamFeeController::class, 'ExamFeeView'])->name('exam.fee.view');

    Route::get('/exam/fee/classwisedata', [ExamFeeController::class, 'ExamFeeClassData'])->name('student.exam.fee.classwise.get');

    Route::get('/exam/fee/payslip', [ExamFeeController::class, 'ExamFeePayslip'])->name('student.exam.fee.payslip');
});