@extends("layout.app")

@section("content")
    <div class="main">


        <div class="contents">
            <form enctype="multipart/form-data" action="{{ route("addProgramRequest") }}" method="POST">
                @csrf
                <div>
                    <h4 id="contenttxt"> Program Name: </h4>
                    <input type="text" name="role" class="form-control"/>
                </div>
                <div>
                    <h4 id="contenttxt">Choose Program Director: </h4>
                    <select  class="js-example-basic-multiple" multiple name="director[]" id="PD">
                        <option disabled>--</option>
                        @foreach($users as $user)
                            <option value="{{ $user->Name }}">{{ $user->Name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="missiongoals-container">
                    <h4 id="contenttxt2">Mission </h4>


                    <textarea name="mission" id="missionTextArea" class="missiongoals-textarea"
                              placeholder="Our mission is to...">{{  $programRequest->mission??""}}</textarea>
                </div>
                <div class="missiongoals-container">
                    <h4 id="contenttxt2">Goals </h4>
                    <textarea name="goal" id="goalsTextArea" class="missiongoals-textarea"
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
