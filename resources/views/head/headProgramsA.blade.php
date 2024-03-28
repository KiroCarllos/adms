@extends("layout.app")
<!-- Here is the code for the content -->
@section("content")
    <div class="main">
        <div class="hnavbar">

            <a @if(explode("/",request()->url())[count(explode("/",request()->url()))-1] == "becolar")  class="hactive"
               @endif href="{{ route("roleHead","becolar") }}">Bachelor</a>
            <a @if(explode("/",request()->url())[count(explode("/",request()->url()))-1] == "general_master") class="hactive"
               @endif href="{{ route("roleHead","general_master") }}">General Master</a>
            <a @if(explode("/",request()->url())[count(explode("/",request()->url()))-1] == "phd") class="hactive"
               @endif href="{{ route("roleHead","phd") }}">PHD</a>
            <a @if(explode("/",request()->url())[count(explode("/",request()->url()))-1] == "cymaster") class="hactive"
               @endif href="{{ route("roleHead","cymaster") }}">CY Master</a>
            <a @if(explode("/",request()->url())[count(explode("/",request()->url()))-1] == "master") class="hactive"
               @endif href="{{ route("roleHead","master") }}">AI Master</a>
        </div>

        <div class="contents">
            <form enctype="multipart/form-data" action="{{ route("saveProgramRequest") }}" method="POST">
                @csrf
                <input type="hidden" name="role"
                       value="{{ explode("/",request()->url())[count(explode("/",request()->url()))-1] }}">
                <div>
                    <h4 id="contenttxt">Choose Program Director: </h4>
                    <select name="director" id="PD">
                        <option value="--">--</option>
                        @foreach($users as $user)
                            <option
                                {{ isset($programRequest->director) ? $user->Name == $programRequest->director ? "selected":"":"" }} value="{{ $user->Name }}">{{ $user->Name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="missiongoals-container">
                    <h4 id="contenttxt2">Mission </h4>
                    <button id="missionLastUpdatedText" class="pen-icon">✎</button>
                    <span id="missionLastUpdatedText" class="last-updated-text">Last Update: </span>
                    <textarea name="mission" id="missionTextArea" class="missiongoals-textarea" readonly
                              placeholder="Our mission is to...">{{  $programRequest->mission??""}}</textarea>
                </div>
                <div class="missiongoals-container">
                    <h4 id="contenttxt2">Goals </h4>
                    <button id="goalsLastUpdatedText" class="pen-icon">✎</button>
                    <span id="goalsLastUpdatedText" class="last-updated-text">Last Update: </span>
                    <textarea name="goal" id="goalsTextArea" class="missiongoals-textarea" readonly
                              placeholder="Our goals are...">{{  $programRequest->goals??""}}</textarea>
                </div>
                <br>
                <br>
                <div class="missiongoals-container">
                    <input type="file" name="files[]" multiple>
                </div>
                <div class="missiongoals-container">
                    <div style="width: 300px;height: 76px" class="btn-group">
                        @forelse($programRequest->files??[] as $index=>$file)
                            <a style="text-decoration: none" target="_blank" href="{{ asset($file->file) }}"> <button type="button">File {{ $index+1 }}</button></a>
                        @empty
                            <p>No Files Uploaded</p>
                        @endforelse
                    </div>

                </div>
                <br>
                <br>
                <button class="create">Save</button>
            </form>

            {{--            <h4 id="contenttxt2">Decrees </h4>--}}
            {{--            <h4 id="contenttxt">Upload </h4>--}}

            {{--            <div class="btn-group">--}}
            {{--                <button>File 1</button>--}}
            {{--                <button>File 2</button>--}}
            {{--                <button>File 3</button>--}}
            {{--            </div>--}}

            {{--            <div class="file-upload">--}}
            {{--                <input type="file" id="file1" />--}}
            {{--            </div>--}}
        </div>
    </div>
@endsection
