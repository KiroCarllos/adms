@extends("layout.app")
<!-- Here is the code for the content -->
@section("content")

    <div class="main">

        <div class="contents">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form enctype="multipart/form-data" action="{{ route("head.saveAcademicAdvisors") }}" method="POST">
                @csrf
                <input type="hidden" name="role" value="{{ explode("/",request()->url())[count(explode("/",request()->url()))-1] }}">
                <div>
                    <h4 id="contenttxt">Choose Academic Advisors: </h4>
                    <select  class="js-example-basic-multiple"   name="director[]" id="PD">
                        <option value="--">--</option>
                        @foreach($users as $user)
                            <option {{ !is_null($academicAdvisors) ? in_array($user->Name,$academicAdvisors->users)  ? "selected":""  : "" }} value="{{ $user->Name }}">{{ $user->Name }}</option>
                        @endforeach
                    </select>
                </div>
{{--                {{ in_array($user->Name,$programRequest->director)  ? "selected":"" }}--}}
                <br>
                <br>
                <button class="create">Assign</button>
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
