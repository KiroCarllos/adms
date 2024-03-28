@extends("layout.app")


@section("content")
    <!--Here is the code for the content-->
    <div class="main">

        <div class="hnavbar">
            @forelse($commits as $commit)
                @if($loop->first&& is_null(request()->get("id")))
                    <a  class="hactive"  href="{{ route("committees",["id"=>$commit->id]) }}">{{ $commit->commit_name }}</a>
                @else
                    <a @if(request()->get("id") == $commit->id) class="hactive" @endif href="{{ route("committees",["id"=>$commit->id]) }}">{{ $commit->commit_name }}</a>
                @endif
            @empty
                Sorry No Committe Yet!
            @endforelse

        </div>


        <div class="contents">
            <div>
                <h4 id="contenttxt2">{{ $commitObj->commit_name }}</h4>
                <ul>
                    <a style="text-decoration: none" href="{{ asset($commitObj->decrees) }}" id="contenttxt">
                        Decree: <button class="btn"><i class="fa fa-download"></i> </button>
                    </a>
                </ul>
                <div id="startend">
                    <h4 id="contenttxt2">Start Date: {{ $commitObj->start_date }} </h4>
                    <h4 id="contenttxt2">End Date: {{ $commitObj->end_date }} </h4>
                </div>
            </div>


            <div class="membersHead-container">
                <h4 id="committee">Head</h4>
{{--                <button onclick="enableEditMode('headTextArea')" class="pen-icon">✎</button>--}}
                <textarea id="headTextArea" class="membersHead-textarea" placeholder="Dr.---- {{ $commitObj->head->Name }}" readonly></textarea>
            </div>

            <div class="membersHead-container">
                <h4 id="committee">Members</h4>
{{--                <button onclick="enableEditMode('membersTextArea')" class="pen-icon">✎</button>--}}
                <textarea id="membersTextArea" class="membersHead-textarea" placeholder="Dr.----@foreach($commit->member_ids as $index => $member_id){{ \App\Models\User::whereId($member_id)->pluck("Name")->first() }}@if ($index < count($commit->member_ids) - 1) & @endif @endforeach" readonly></textarea>            </div>


            <div class="missiongoals-container">
                <h4 id="contenttxt2">  </h4>
                <h4 id="contenttxt">Documents </h4>
                <div style="width: 300px;height: 76px" class="btn-group">
                    @forelse($commit->files as $index=>$file)
                        <a style="text-decoration: none" target="_blank" href="{{ asset($file->file) }}"> <button type="button">File {{ $index+1 }}</button></a>
                    @empty
                        <p>No Files Uploaded</p>
                    @endforelse
                </div>

            </div>

            <div class="file-upload">
                <input type="file" id="file1" />
            </div>
            <br>
            <hr>


            <h4 id="sendRequest">Send a Request </h4>

            <textarea id="request"  placeholder="Enter text here" ></textarea>


            <div class="btn-group">
                <button>File 1</button>
                <button>File 2</button>
                <button>File 3</button>

            </div>

            <div class="file-upload">
                <input type="file" id="file1" />
            </div>






        </div>

    </div>

@endsection




