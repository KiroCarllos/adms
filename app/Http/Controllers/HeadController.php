<?php

namespace App\Http\Controllers;

use App\Models\Committee;
use App\Models\CommitteeFile;
use App\Models\MemberFile;
use App\Models\ProgramRequest;
use App\Models\ProgramRequestFile;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;

class HeadController extends Controller
{
    public function saveProgramRequests(Request $request)
    {
        $programRequest = ProgramRequest::where("role", $request->role)->first();
        $programRequest->update([
            "director" => $request->director,
            "mission" => $request->mission,
            "goals" => $request->goal,
            "role" => $request->role,
        ]);
        $types = [];
        $paths = [];
        if (isset($request["files"]) && count($request["files"]) > 0) {
            foreach ($request["files"] as $file) {
                $uploadResult = $this->uploadFile($file);
                $program_request_file = ProgramRequestFile::create([
                    "program_request_id" => $programRequest->id,
                    "type" => $uploadResult["type"],
                    "file" => $uploadResult["path"],
                ]);
            }
        }
        return redirect()->back();
    }
    public function saveCommit(Request $request)
    {
        $commit = Committee::query()->firstOrCreate([
            "commit_name" => $request->commit_name,
            "head_id" => $request->head_id,
            "task_name" => $request->task_name,
        ],[
            "decrees" =>  $this->uploadFile($request->file,"committees/decrees")["path"],
            "member_ids" => $request->member_ids ,
            "start_date" => Carbon::parse(str_replace("/","-",$request->start_date))->toDateString() ,
            "end_date" =>Carbon::parse(str_replace("/","-", $request->end_date))->toDateString() ,
        ]);
        if (isset($request["files"]) && count($request["files"]) > 0) {
            foreach ($request["files"] as $file) {
                $uploadResult = $this->uploadFile($file,"committees");
                $program_request_file = CommitteeFile::create([
                    "committee_id" => $commit->id,
                    "type" => $uploadResult["type"],
                    "file" => $uploadResult["path"],
                ]);
            }
        }
        return redirect()->back();
    }
    public function saveMemberFiles(Request $request)
    {
        if (isset($request["files"]) && count($request["files"]) > 0) {
            foreach ($request["files"] as $file) {
                $uploadResult = $this->uploadFile($file,"members/files");
                $program_request_file = MemberFile::create([
                    "user_id" => $request->user_id,
                    "type" => $uploadResult["type"],
                    "file" => $uploadResult["path"],
                ]);
            }
        }
        return redirect()->back();
    }

    public function uploadFile(UploadedFile $file, string $folder = 'program_files'): array
    {
        // Generate a unique filename
        $filename = uniqid() . '.' . $file->getClientOriginalExtension();

        // Move the file to the public directory
        $s = $file->move(public_path($folder), $filename);
        // Get the file path
        $filePath = $folder . '/' . $filename;

        // Determine the file type
        $fileType = $file->getClientMimeType();

        // Return an array containing file type and path
        return [
            'type' => $fileType,
            'path' => $filePath,
        ];
    }

}
