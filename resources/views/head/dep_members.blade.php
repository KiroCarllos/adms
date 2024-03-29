@extends("layout.app")


@section("content")
    <!--Here is the code for the content-->
    <div class="main">

        <div class="hnavbar">
            <a class="hactive" href="headDepartmentMembers.html">Members</a>
{{--            <a href="headDepartmentMembersD.html">Decrees</a>--}}
        </div>

        <div class="contents">

            <div>
                <h4 id="contenttxt">Committee Members</h4>
                <select onchange="redirectToSelectedCommittee()" required class="js-example-basic-multiple" name="member_ids" id="CM" >
                    <option disabled selected>--</option>
                    @forelse($membersUsers as $memberUser)
                        <option {{ request()->get("id") ==$memberUser->id ?"selected":""  }} value="{{ $memberUser->id }}">{{ $memberUser->Name }}</option>
                    @empty
                        <option>--</option>
                    @endforelse
                </select>
            </div>

{{--            <div id="selectedBox"></div>--}}
{{--            <div>--}}
{{--                <button onclick="transferSelection()" id="transfercom">&#10132;</button>--}}
{{--            </div>--}}

            <br>
            <div class="containercom">
                @forelse($commits as $commit)
                    <h4 id="contenttxt2">{{ $commit->commit_name }}</h4>
                    <h4 id="contenttxt2">Role : @if(in_array(request()->get("id"),$commit->head_id)) Committee Head @elseif(in_array(request()->get("id"),$commit->member_ids)) Committee Member  @endif </h4>
                    <h4 id="datecom">Start Date: {{ $commit->start_date }}</h4>
                    <h4 id="datecom">End Date: {{ $commit->end_date }}</h4>
                    <hr>
                @empty

                    <h4>
                        Not In any Comitte Yet
                    </h4>
                @endforelse
            </div>

            <h4 id="contenttxt">Upload </h4>

            <div style="width: 300px;height: 76px" class="btn-group">
                @forelse($member->files as $index=>$file)
                    <a style="text-decoration: none" target="_blank" href="{{ asset($file->file) }}"> <button type="button">File {{ $index+1 }}</button></a>
                @empty
                    <p>No Files Uploaded</p>
                @endforelse
            </div>

            <form action="{{ route("saveMemberFiles") }}" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="user_id" value="{{ $member->id }}" >
                @csrf
                <div class="file-upload">
                    <input type="file" name="files[]" multiple id="file1" />
                </div>

                <div class="button">
                    <button class="create">Upload</button>
                </div>

            </form>


        </div>

    </div>
    <script>
        function redirectToSelectedCommittee() {
            var selectElement = document.getElementById("CM");
            var selectedValue = selectElement.value;

            // Redirect to the URL with the selected value appended as a query parameter
            window.location.href = '/dep_members?id=' + selectedValue;
        }
    </script>
@endsection




