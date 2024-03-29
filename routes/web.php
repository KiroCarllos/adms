<?php

use App\Http\Controllers\RegisterController;
use App\Models\AcademicAdvisor;
use App\Models\ProgramRequest;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\HeadController;
use \App\Http\Controllers\headEventController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::post('/saveProgramRequest', [HeadController::class,"saveProgramRequests"])->name("saveProgramRequest");
Route::post('/addProgramRequest', [HeadController::class,"addProgramRequest"])->name("addProgramRequest");
Route::post('/saveCommit', [HeadController::class,"saveCommit"])->name("saveCommit");
Route::post('/updateCommit', [HeadController::class,"updateCommit"])->name("updateCommit");
Route::post('/saveMemberFiles', [HeadController::class,"saveMemberFiles"])->name("saveMemberFiles");
Route::post('/storeEvent', [headEventController::class, 'store'])->name('head.storeEvent');
Route::post('/saveAcademicAdvisors', [headEventController::class, 'saveAcademicAdvisors'])->name('head.saveAcademicAdvisors');


Route::get('/roleHead/{director}', function ($director) {
    $users = \App\Models\User::orderBy("points","desc")->get();
    \App\AI\RecommendationModel::getBestRecommended($users);
    $programRequest = ProgramRequest::where("role",$director )->first();

        return view('head.headProgramsA',compact('users','programRequest'));
})->name("roleHead");

Route::get('/create_program', function () {
    $users = \App\Models\User::orderBy("points","desc")->get();
    \App\AI\RecommendationModel::getBestRecommended($users);
    return view('head.create_program',compact('users'));
})->name("create_program");


Route::get('/role', function ($director="master") {

    if(auth()->user()->role == "head"){
        return redirect()->route("roleHead","Bachelor")->with('success', 'Login successful!');
    }
    return view('extra.role');
})->name("role");

Route::get('/loader', function () {
    return view('extra.loader');
});
Route::get('/academic_advisor', function () {
    $users = \App\Models\User::orderBy("points","desc")->get();
    \App\AI\RecommendationModel::getBestRecommended($users);
    $academicAdvisors = AcademicAdvisor::first();

    return view('head.academic_advisor',compact("users","academicAdvisors"));
})->name("academic_advisor");
Route::get('/createCommittee', function () {
    $users = \App\Models\User::orderBy("points","desc")->get();
    \App\AI\RecommendationModel::getBestRecommended($users);
    return view('head.createCommittee',compact("users"));
})->name("createCommittee");
Route::get('/committees/all', function () {

    if(!is_null(request()->get("id"))){
        $commitObj = \App\Models\Committee::find(request()->get("id"));
    }else{
        $commitObj = \App\Models\Committee::first();
    }
//    dd($commit->commit_name);
    $commits = \App\Models\Committee::all();
    $users = \App\Models\User::orderBy("points","desc")->get();
    \App\AI\RecommendationModel::getBestRecommended($users);
    return view('head.committees',compact("commits","commitObj","users"));
})->name("committees");
Route::get('/dep_members', function () {

    $member2_ids = \App\Models\Member::whereIn("Role",["Committee Member","Acedmic Advisor"])->pluck("UserId")->toArray();
    $membersUsers = \App\Models\User::orderBy("points","desc")->get();
//    foreach ($membersUsers as $member){
//        $member->setAttribute("role_name",\App\Models\Member::where("UserID",$member->id)->pluck("Role")->first());
//    }
    if(!is_null(request()->get("id"))){
        $commits = \App\Models\Committee::whereJsonContains("member_ids", request()->get("id"))->orWhereJsonContains("head_id", request()->get("id"))->get();
        $member = \App\Models\User::find(request()->get("id"));
    }else{
        $commits = \App\Models\Committee::whereJsonContains("member_ids", $member2_ids[0])->get();
        $member = $membersUsers->first();
    }
    \App\AI\RecommendationModel::getBestRecommended($membersUsers);
//    dd($commits);
    return view('head.dep_members',compact("membersUsers","commits","member"));
})->name("dep_members");
Route::get('/head_events', function () {

    return view('head.head_events');
})->name("head_events");


Route::get('/head_allEvents', function () {
    $events  = \App\Models\HeadEvent::all();
    return view('head.head_eventsVeiw',compact('events'));
})->name("head_allEvents");

Route::get('/register', [RegisterController::class, 'register'])->name('register');

Route::post('/register', [RegisterController::class, 'store']);

Route::get('/login', [RegisterController::class, 'login'])->name('login');

Route::post('/login', [RegisterController::class, 'loginPost'])->name('login.post');
