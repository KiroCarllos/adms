<?php

namespace App\Http\Controllers;

use App\Models\AcademicAdvisor;
use Dflydev\DotAccessData\Data;
use Illuminate\Http\Request;
use App\Models\HeadEvent;

class headEventController extends Controller
{
    public function viewEvents()
    {
        $events = Events::all();

        return view('head.head_eventsVeiw', compact('events'));
    }


    public function index()
    {
        $events = Events::all();
        return view('head.head_events', compact('events'));
    }

    public function create()
    {
        return view('head.head_events');
    }

    public function saveAcademicAdvisors(Request $request)
    {
        $academicAdvisors = AcademicAdvisor::first();
        if (is_null($academicAdvisors)){
            $academicAdvisors = AcademicAdvisor::create([
               "users"=>$request->director
            ]);
        }else{
            $academicAdvisors->update(["users"=> $request->director]);
        }
        return back()->with('success', 'Academic Advisor assigned successfully!');

    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'filetitle' => 'required',
            'file1' => 'required|image',
            'filecontent' => 'required',
        ]);

        $file = $request->file1;
        $extension = $file->getClientOriginalExtension(); // Get the original extension of the uploaded file

        $imageData = file_get_contents($file->getPathname()); // Get the binary data of the uploaded file

        $event = HeadEvent::create([
            "title" => $validatedData['filetitle'],
            "image" => $imageData,
            "comment" => $validatedData['filecontent']
        ]);


        // Rename the saved file with the correct extension
        $filename = $event->id . '.' . $extension;
        $event->image = $filename;
        $event->save();

        $file->move(public_path('uploads'), $filename); // Save the file with the correct extension

        return back()->with('success', 'Event created successfully!');
    }
}
