<?php

use App\Http\Controllers\WebController;
use App\Http\Controllers\User\AccountController;
use App\Http\Controllers\User\savedJobController;
use App\Http\Controllers\User\ProfileController;
use App\Http\Controllers\Author\AuthorController;
use App\Http\Controllers\Author\AuthorCompanyController;
use App\Http\Controllers\Author\AuthorJobApplicationController;
use App\Http\Controllers\Author\AuthorPostController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Admin\AdminPostController;
use App\Http\Controllers\Admin\AdminAuthorController;
use App\Http\Controllers\Admin\AdminCompanyCategoryController;
use App\Http\Controllers\Admin\AdminCompanyController;
use App\Http\Controllers\Admin\AdminFaqCategoryController;
use App\Http\Controllers\Admin\AdminFaqController;
use App\Http\Controllers\AuthenticationController;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;



//Public routes
Route::get('/', [WebController::class, 'index'])->name('home.index');
Route::get('/job/{job}', [WebController::class, 'job'])->name('post.show');
Route::get('employer/{employer}', [WebController::class, 'employer'])->name('employer.show');


//Return vue page
Route::get('/search', [WebController::class, 'jobs'])->name('job.index');


// Contact Us
Route::get('/contact', [WebController::class, 'contactForm'])->name('contact');
Route::post('/contact', [WebController::class, 'contactEmail'])->name('contact.submit');


// For FAQ 
Route::get('/faqs', [WebController::class, 'faqs'])->name('home.faqs');
Route::get('/faqs/{slug}', [WebController::class, 'faqsInfo'])->name('home.faqs.info');


// For registration
Route::put('account/update-details', [AccountController::class, 'updateAccountDetails'])->name('account.updateDetails');
Route::post('/register', [AuthenticationController::class, 'register'])->name('register');


// Show forgot password form
Route::get('/forgot-password', [AuthenticationController::class, 'forgotPasswordForm'])->name('password.forgot');


// Submit forgot password form
Route::post('/forgot-password', [AuthenticationController::class, 'forgotPassword'])->name('password.email');


// Show reset password form
Route::get('/reset-password/{token}', [AuthenticationController::class, 'verifyPasswordLink'])->name('verify.password.link');


// Submit reset password form
Route::post('/reset-password', [AuthenticationController::class, 'resetPassword'])->name('password.reset');


// Email verification
Route::get('/email/verify/{token}', [AuthenticationController::class, 'verifyEmailLink'])->name('verify.email.link');


// For Email Verification
Route::get('/email/verify', function () {
  return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');


// Email Verification Handler 
Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
  $request->fulfill();
  return redirect('/home');
})->middleware(['auth', 'signed'])->name('verification.verify');




//Auth routes
Route::middleware('auth')->prefix('account')->group(function () {

  //Every auth routes AccountController
  Route::get('logout', [AccountController::class, 'logout'])->name('account.logout');
  Route::get('overview', [AccountController::class, 'overview'])->name('account.overview');
  Route::get('deactivate', [AccountController::class, 'deactivateView'])->name('account.deactivate');
  Route::delete('delete', [AccountController::class, 'deleteAccount'])->name('account.delete');
  Route::get('change-password', [AccountController::class, 'changePasswordView'])->name('account.changePassword');
  Route::put('change-password', [AccountController::class, 'changePassword'])->name('account.changePassword');

  //User Role routes
  Route::group(['middleware' => ['role:user|author|admin']], function () {

    //SavedJobs
    Route::get('my-saved-jobs', [savedJobController::class, 'index'])->name('account.savedJob.index');
    Route::get('my-saved-jobs/{id}', [savedJobController::class, 'store'])->name('account.savedJob.store');
    Route::delete('my-saved-jobs/{id}', [savedJobController::class, 'destroy'])->name('account.savedJob.destroy');

    //Apply jobs
    Route::get('apply-job', [AccountController::class, 'applyJobView'])->name('account.applyJob');
    Route::post('apply-job', [AccountController::class, 'applyJob'])->name('account.applyJob');
    Route::get('my-applied-jobs', [AccountController::class, 'appliedJob'])->name('account.appliedJob');
    Route::post('application/remove/{id}', [AccountController::class, 'removeApplication'])->name('application.remove');

    //Become employer
    Route::get('become-employer', [AccountController::class, 'becomeEmployerView'])->name('account.becomeEmployer');
    Route::post('become-employer', [AccountController::class, 'becomeEmployer'])->name('account.becomeEmployer');


    // Route to show edit profile form
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update');

    // Route for CV
    Route::get('/upload-cv', [ProfileController::class, 'uploadCvForm'])->name('account.uploadCv');
    Route::post('/upload-cv', [ProfileController::class, 'storeCv'])->name('account.storeCv');
    Route::get('/download-cv/{id}', [ProfileController::class, 'downloadCv'])->name('account.downloadCv');
  });
});


//Author Role Routes
Route::group(['prefix' => 'author', 'middleware' => ['auth', 'role:author|admin']], function () {

  // Author Section
  Route::get('author-section', [AuthorController::class, 'authorSection'])->name('author.authorSection');
  Route::get('/job-list', [AuthorJobApplicationController::class, 'jobList'])->name('author.viewAllJob');
  Route::get('job-application/{id}', [AuthorJobApplicationController::class, 'show'])->name('author.jobApplication.show');
  Route::delete('job-application', [AuthorJobApplicationController::class, 'destroy'])->name('author.jobApplication.destroy');
  Route::get('job-application', [AuthorJobApplicationController::class, 'index'])->name('author.jobApplication.index');

  // for Job Application Status
  Route::get('/author/job-application/{id}', [AuthorJobApplicationController::class, 'showJob'])->name('author.jobApplication.showJob');
  Route::post('/author/job-application/save-status', [AuthorJobApplicationController::class, 'saveStatus'])->name('author.jobApplication.saveStatus');


  // Route for all applications Button status
  Route::get('/author/job/applications', [AuthorJobApplicationController::class, 'index'])->name('author.job.applications.index');

  // Route for pending applications Button status
  Route::get('/author/job/applications/pending', [AuthorJobApplicationController::class, 'pending'])->name('author.job.applications.pending');


  // Route for shortlisted applications Button status
  Route::get('/author/job/applications/shortlisted', [AuthorJobApplicationController::class, 'showShortListed'])->name('author.job.applications.shortlisted');


  // Route for rejected applications status
  Route::get('/author/job/applications/rejected', [AuthorJobApplicationController::class, 'rejected'])->name('author.job.applications.rejected');


  // Route for rejected applications button 
  Route::patch('/author/job/applications/{id}/reject', [AuthorJobApplicationController::class, 'reject'])->name('author.job.applications.reject');


  // for Job (Post) 
  Route::get('post/create', [AuthorPostController::class, 'create'])->name('author.post.create');
  Route::get('/post/{id}', [AuthorPostController::class, 'show'])->name('author.post.show');  /////////////////////////////
  Route::post('/post', [AuthorPostController::class, 'store'])->name('author.post.store');
  Route::get('post/{post}/edit', [AuthorPostController::class, 'edit'])->name('author.post.edit');
  Route::put('post/{post}', [AuthorPostController::class, 'update'])->name('author.post.update');
  Route::delete('post/{post}', [AuthorPostController::class, 'destroy'])->name('author.post.destroy');
  Route::get('view-all-jobs', [AuthorPostController::class, 'viewAllJobs'])->name('author.viewAllJobs');


  // For Company
  Route::get('company/create', [AuthorCompanyController::class, 'create'])->name('author.company.create');
  Route::post('company', [AuthorCompanyController::class, 'store'])->name('author.company.store');
  Route::get('company/edit', [AuthorCompanyController::class, 'edit'])->name('author.company.edit');
  Route::put('company/{id}', [AuthorCompanyController::class, 'update'])->name('author.company.update');
  Route::delete('company', [AuthorCompanyController::class, 'destroy'])->name('author.company.destroy');
});



//Admin Role Routes
Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'role:admin']], function () {

  Route::get('dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');


  // for Users
  Route::get('view-all-users', [AdminController::class, 'viewAllUsers'])->name('admin.user.viewAllUsers');
  Route::post('view-all-users/{id}', [AdminUserController::class, 'destroyUser'])->name('admin.user.destroy');


  // for Applications
  Route::get('view-all-posts', [AdminPostController::class, 'index'])->name('admin.post.viewAll');
  Route::post('view-all-posts/{id}', [AdminPostController::class, 'destroyPost'])->name('admin.post.destroy');
  Route::post('toggle-post-status', [AdminPostController::class, 'toggleStatus'])->name('admin.post.toggleStatus');
  // Route::get('/author/post/{id}', [AuthorPostController::class, 'show'])->name('author.post.show');  /////////////////////////////////


  // For category
  Route::get('category/{category}/edit', [AdminCompanyCategoryController::class, 'edit'])->name('admin.category.edit');
  Route::post('category', [AdminCompanyCategoryController::class, 'store'])->name('admin.category.store');
  Route::put('category/{id}', [AdminCompanyCategoryController::class, 'update'])->name('admin.category.update');
  Route::delete('category/{id}', [AdminCompanyCategoryController::class, 'destroy'])->name('admin.category.destroy');


  // for Authors list by Admin
  Route::get('/authors', [AdminAuthorController::class, 'index'])->name('admin.author.index');
  Route::get('/authors/create', [AdminAuthorController::class, 'create'])->name('admin.author.create');
  Route::post('/authors', [AdminAuthorController::class, 'store'])->name('admin.author.store');
  Route::get('/authors/{id}/edit', [AdminAuthorController::class, 'edit'])->name('admin.author.edit');
  Route::put('/authors/{id}', [AdminAuthorController::class, 'update'])->name('admin.author.update');
  Route::delete('/authors/{id}', [AdminAuthorController::class, 'destroy'])->name('admin.author.delete');
  Route::get('/authors/{id}/manage-company', [AdminAuthorController::class, 'manageCompany'])->name('admin.author.manageCompany');


  // For Company Routes
  Route::get('/authors/{id}/company/create', [AdminCompanyController::class, 'create'])->name('admin.company.create');
  Route::post('/authors/{id}/company', [AdminCompanyController::class, 'store'])->name('admin.company.store');
  Route::get('/authors/{id}/company/edit', [AdminCompanyController::class, 'edit'])->name('admin.company.edit');
  Route::put('/authors/{id}/company', [AdminCompanyController::class, 'update'])->name('admin.company.update');
  Route::delete('/authors/{id}/company', [AdminCompanyController::class, 'destroy'])->name('admin.company.destroy');


  // For FAQ Category
  Route::resource('faqs-categories', AdminFaqCategoryController::class);


  // For Application Selection
  Route::get('view-all-applications', [AdminController::class, 'viewAllApplications'])->name('admin.application.viewAllUsers');
  Route::post('view-all-applications/{id}', [AdminUserController::class, 'destroyUser'])->name('admin.application.destroy');


  // Route for Managing FAQs by category
  Route::get('faqs/{category_id}', [AdminFaqController::class, 'index'])->name('faqs.index');
  Route::get('faqs/create/{categoryId}', [AdminFaqController::class, 'create'])->name('faqs.create');
  Route::post('faqs/store', [AdminFaqController::class, 'store'])->name('faqs.store');
  Route::get('faqs/edit/{id}', [AdminFaqController::class, 'edit'])->name('faqs.edit');
  Route::put('faqs/update/{id}', [AdminFaqController::class, 'update'])->name('faqs.update');
  Route::get('faqs/view/{id}', [AdminFaqController::class, 'show'])->name('faqs.show');
  Route::delete('faqs/destroy/{id}', [AdminFaqController::class, 'destroy'])->name('faqs.destroy');
});
