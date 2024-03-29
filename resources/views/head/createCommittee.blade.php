@extends("layout.app")
@section("css")
    <style>
        .taskname {
            width: 35% !important;

            height: 200px !important;
        }
    </style>

@endsection

@section("content")
    <!--Here is the code for the content-->
    <div class="main">
        <form action="{{ route("saveCommit") }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="contents">
                <div>
                    <h4 id="contenttxt">Committee Name: </h4>
                    <textarea required  class="committeename" name="commit_name"  placeholder="Write committee name..." rows="1"></textarea>
                </div>
                <h4 id="contenttxt">Committee Head</h4>
                <select class="js-example-basic-multiple selectw" required name="head_id[]" id="head_id">
                    @forelse($users as $headUser)
                        <option value="{{ $headUser->id }}">{{ $headUser->Name  }}</option>
                    @empty
                        <option>--</option>
                    @endforelse
                </select>
                <div>
                    <h4 id="contenttxt">Committee Members</h4>
                    <select class="js-example-basic-multiple selectw" multiple required name="member_ids[]" id="member_id">

                    </select>
                </div>
                <h4 id="contenttxt">Tasks</h4>
                <div class="container" style="   padding-bottom: 0;">
                    <div>
                        <textarea required name="task_name" class="taskname" placeholder="Write task Details..." rows="3"></textarea>
                    </div>
                    <div>
                        <h4 id="contenttxtt"> Start Date</h4>
                        <input style="margin-left: 46px;"  name="start_date" type="date">
                        <span id="date-error" style="display: none; color: red;">Please write a date in the format DD/MM/YYYY</span>
                    </div>
                    <div>
                        <h4 id="contenttxtt"> End Date</h4>
                        <input style="margin-left: 46px;"  name="end_date" type="date">
                        <span id="date-error" style="display: none; color: red;">Please write a date in the format DD/MM/YYYY</span>
{{--                        <button id="button-plus">+</button>--}}
                    </div>
                </div>
                <input type="hidden" name="decrees" id="decrees">
{{--                <div id="copiedTasks"></div>--}}
                <h4 id="contenttxt22" style="margin-top: 0px;">Decrees </h4>
                <div class="file-upload">
                    <input name="file" type="file" />
                </div>
                <h4 id="contenttxt">Upload </h4>
                <div class="file-upload">
                    <input name="files[]" multiple type="file" />
                </div>

                <div class="button">
                    <button type="submit" class="create">Create</button>
                </div>

            </div>
        </form>

        <script>
            document.getElementById("button-plus").addEventListener("click", function(event) {
                event.preventDefault(); // Prevents the default behavior of the button
                copyTask();
            });

        </script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                var headSelect = $('#head_id');
                var memberSelect = $('#member_id');
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









    </div>

@endsection




