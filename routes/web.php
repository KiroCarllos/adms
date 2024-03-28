<?php

use App\Http\Controllers\RegisterController;
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
Route::post('/saveCommit', [HeadController::class,"saveCommit"])->name("saveCommit");
Route::post('/saveMemberFiles', [HeadController::class,"saveMemberFiles"])->name("saveMemberFiles");
Route::post('/storeEvent', [headEventController::class, 'store'])->name('head.storeEvent');


Route::get('/roleHead/{director}', function ($director="master") {
        $member_ids = \App\Models\Member::where("Role","Program Director")->pluck("UserId")->toArray();
        $users = \App\Models\User::all();
       $programRequest = ProgramRequest::where("role",$director ?? "master")->first();

        return view('head.headProgramsA',compact('users','programRequest'));
})->name("roleHead");

Route::get('/role', function ($director="master") {
    if(auth()->user()->role == "head"){
        return redirect()->route("roleHead","becolar")->with('success', 'Login successful!');
    }
    return view('extra.role');
})->name("role");

Route::get('/loader', function () {
    return view('extra.loader');
});
Route::get('/createCommittee', function () {
    $member_ids = \App\Models\Member::whereIn("Role",["Program Director","Committee Head","Acedmic Advisor"])->pluck("UserId")->toArray();
    $headUsers = \App\Models\User::whereIn("id",$member_ids)->get();
    foreach ($headUsers as $headUser){
        $headUser->setAttribute("role_name",\App\Models\Member::where("UserID",$headUser->id)->pluck("Role")->first());
    }
    $member2_ids = \App\Models\Member::whereIn("Role",["Committee Member","Acedmic Advisor"])->pluck("UserId")->toArray();
    $membersUsers = \App\Models\User::whereIn("id",$member2_ids)->get();
    foreach ($membersUsers as $member){
        $member->setAttribute("role_name",\App\Models\Member::where("UserID",$member->id)->pluck("Role")->first());
    }
    return view('head.createCommittee',compact("headUsers",'membersUsers'));
})->name("createCommittee");
Route::get('/committees/all', function () {
    if(!is_null(request()->get("id"))){
        $commitObj = \App\Models\Committee::find(request()->get("id"));
    }else{
        $commitObj = \App\Models\Committee::first();
    }
//    dd($commit->commit_name);
    $commits = \App\Models\Committee::all();

    return view('head.committees',compact("commits","commitObj"));
})->name("committees");
Route::get('/dep_members', function () {
    $member2_ids = \App\Models\Member::whereIn("Role",["Committee Member","Acedmic Advisor"])->pluck("UserId")->toArray();
    $membersUsers = \App\Models\User::whereIn("id",$member2_ids)->get();
    foreach ($membersUsers as $member){
        $member->setAttribute("role_name",\App\Models\Member::where("UserID",$member->id)->pluck("Role")->first());
    }
    if(!is_null(request()->get("id"))){
        $commits = \App\Models\Committee::whereJsonContains("member_ids", request()->get("id"))->get();
        $member = \App\Models\User::find(request()->get("id"));
    }else{
        $commits = \App\Models\Committee::whereJsonContains("member_ids", $member2_ids[0])->get();
        $member = $membersUsers->first();
    }
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
