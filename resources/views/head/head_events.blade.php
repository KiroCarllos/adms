@extends("layout.app")


@section("content")
    <!--Here is the code for the content-->
    <div class="main">
        <div class="hnavbar">
            <a href="{{ route('head_events') }}">Create Events</a>
            <a class="hactive" href="{{ route('head_allEvents') }}">View Events</a>
        </div>

        <h4 id="uploadevent">Create Events</h4>


        <div class="contents">
            <form method="POST" action="{{ route('head.storeEvent') }}" enctype="multipart/form-data">
                @csrf

                <h4 id="uploadfile">Title:</h4>
                <textarea name="filetitle" id="filetitle" placeholder="Enter Title"></textarea>

                <div class="file-upload">
                    <input type="file" name="file1" id="file1" />
                </div>

                <h4 id="uploadfile">Write Comment:</h4>
                <textarea name="filecontent" id="filecontent" placeholder="Type Here"></textarea>

                <div class="button">
                    <button type="submit" class="create">Create</button>
                </div>
            </form>
        </div>


    </div>

@endsection




