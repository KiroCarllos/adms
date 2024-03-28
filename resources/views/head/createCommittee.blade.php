@extends("layout.app")


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
                <select required name="head_id" id="CH">
                    @forelse($headUsers as $headUser)
                        <option value="{{ $headUser->id }}">{{ $headUser->Name ."  [".$headUser->role_name."]" }}</option>
                    @empty
                        <option>--</option>
                    @endforelse
                </select>
                <div>
                    <h4 id="contenttxt">Committee Members</h4>
                    <select required class="js-example-basic-multiple" multiple name="member_ids[]" id="CM" >
                        @forelse($membersUsers as $memberUser)
                            <option value="{{ $memberUser->id }}">{{ $memberUser->Name ."  [".$memberUser->role_name."]" }}</option>
                        @empty
                            <option>--</option>
                        @endforelse
                    </select>
                </div>
                <h4 id="contenttxt">Tasks</h4>
                <div class="container">
                    <div>
                        <h4 id="contenttxttt">Task Name</h4>
                        <textarea required name="task_name" class="taskname" placeholder="Write task name..." rows="1"></textarea>
                    </div>
                    <div>
                        <h4 id="contenttxtt">Task Start Date</h4>
                        <textarea required name="start_date" class="taskdate" placeholder="DD/MM/YYYY" rows="1" oninput="validateDate(this)"></textarea>
                        <span id="date-error" style="display: none; color: red;">Please write a date in the format DD/MM/YYYY</span>
                    </div>
                    <div>
                        <h4 id="contenttxtt">Task End Date</h4>
                        <textarea required name="end_date" class="taskdate" placeholder="DD/MM/YYYY" rows="1" oninput="validateDate(this)"></textarea>
                        <span id="date-error" style="display: none; color: red;">Please write a date in the format DD/MM/YYYY</span>
                        <button id="button-plus">+</button>
                    </div>
                </div>
                <input type="hidden" name="decrees" id="decrees">
                <div id="copiedTasks"></div>
                <h4 id="contenttxt22">Decrees </h4>
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

    </div>

@endsection




