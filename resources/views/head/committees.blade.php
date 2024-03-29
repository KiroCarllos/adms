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
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
        <form action="{{ route("updateCommit") }}" method="POST">
            <input type="hidden" name="commit_id" value="{{ $commitObj->id }}">
            @csrf
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
                <span id="committee">Head</span>
                <select class="js-example-basic-multiple selectw"  required name="head_id[]" id="head_id">
                    @forelse(\App\Models\User::all() as $headUser)
                        <option {{ in_array($headUser->id,$commitObj->head_id) ? "selected":"" }} value="{{ $headUser->id }}">{{ $headUser->Name  }}</option>
                    @empty
                        <option>--</option>
                    @endforelse
                </select>
                {{--                <button onclick="enableEditMode('headTextArea')" class="pen-icon">✎</button>--}}
                {{--                <textarea id="headTextArea" class="membersHead-textarea" placeholder="Dr.---- {{ $commitObj->head->Name }}" readonly></textarea>--}}
            </div>
            <br>
            <br>
            <br>
            <div class="membersHead-container">
                <span id="committee">Members</span>
                <select class="js-example-basic-multiple selectw" multiple required name="member_ids[]" id="member_ids">
                    @forelse(\App\Models\User::all() as $headUser)
                        <option {{ in_array($headUser->id,$commitObj->member_ids) ? "selected":"" }} value="{{ $headUser->id }}">{{ $headUser->Name  }}</option>
                    @empty
                        <option>--</option>
                    @endforelse
                </select>
                {{--                <textarea id="membersTextArea" class="membersHead-textarea" placeholder="Dr.----@foreach($commit->member_ids as $index => $member_id){{ \App\Models\User::whereId($member_id)->pluck("Name")->first() }}@if ($index < count($commit->member_ids) - 1) & @endif @endforeach" readonly></textarea>            </div>--}}


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
            </div>
            <br>
            <br>
            <br>
            <button class="create">Update</button>

        </form>


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
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var headSelect = $('#head_id');
            var memberSelect = $('#member_ids');
            var users = <?php echo json_encode($users); ?>; // Assuming $users is an array of user objects

            headSelect.on('change', function() {
                var selectedValues = headSelect.val();
                populateMemberDropdown(selectedValues);
            });

            function populateMemberDropdown(selectedValues) {
                // Filter users based on selected values
                var filteredUsers = users.filter(user => !selectedValues.includes(user.id.toString()));

                // Clear existing options in the member_id select dropdown
                memberSelect.empty();

                // Append options to the member_id select dropdown
                filteredUsers.forEach(function(user) {
                    var option = new Option(user.Name, user.id, false, false);
                    memberSelect.append(option);
                });

                // Trigger change event to update Select2
                memberSelect.trigger('change');
            }

            // Initialize Select2
            headSelect.select2();
            memberSelect.select2();
        });
    </script>
@endsection




