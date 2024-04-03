<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('head/styles.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    @yield("css")
    <title>Programs</title>
    <style>
        .alert {
            padding: 1rem 1.25rem;
            margin-bottom: 1rem;
            border: 1px solid transparent;
            border-radius: 0.25rem;
            margin-left: 123px;
        }
        .alert-success{
            color: #155724;
            background-color: #d4edda;
            border-color: #c3e6cb;
        }
        .alert-danger {
            color: #721c24;
            background-color: #f8d7da;
            border-color: #f5c6cb;
        }
        .create {
            align-items: center;
            color: #0C552D;
            background-color: #ffffff;
            font-size: larger;
            font-family: 'Times New Roman', serif;
            padding: 20px;
            border-color: #648884;
            border-radius: 20px;
        }
        .select2{
            margin-left: 158px !important;
        }
    </style>
</head>
<body style="background: #f0f4f7;">
<div class="header">
    <img id="admslogoC" src="{{ asset('head/ADMSheadlogo.png') }}">
    <img id="profilePic" src="{{ asset('head/profilePic.PNG') }}">
</div>


<div class="navbar">
    <a @if(strpos(request()->getRequestUri(), "create_program") !== false) class="active" @endif href="{{ route("create_program") }}">Create Program</a>
    <a @if(strpos(request()->getRequestUri(), "roleHead") !== false) class="active" @endif href="{{ route("roleHead",\App\Models\ProgramRequest::query()->orderBy("order_number")->pluck("role")->first()) }}">Programs</a>
    <a @if(strpos(request()->getRequestUri(), "createCommittee") !== false) class="active" @endif  href="{{ route("createCommittee") }}">Create Committee</a>
    <a  @if(strpos(request()->getRequestUri(), "committees") !== false) class="active" @endif href="{{ route("committees") }}">Committees</a>
    <a @if(strpos(request()->getRequestUri(), "dep_members") !== false) class="active" @endif href="{{ route("dep_members") }}">Department Members</a>
    <a @if(strpos(request()->getRequestUri(), "academic_advisor") !== false) class="active" @endif href="{{ route("academic_advisor") }}">Academic Advisor</a>
    <a @if(strpos(request()->getRequestUri(), "head_events") !== false) class="active" @endif href="{{ route("head_allEvents") }}">Events</a>
</div>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    @yield("content")


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<script>
    $(document).ready(function() {
        $('.js-example-basic-multiple').select2();
    });
</script>

<script>
    document.getElementById("goalsLastUpdatedText").onclick = ((event) => {
        event.preventDefault();

        var currentDate = new Date();
        var formattedDate = currentDate.getFullYear() + "-" + (currentDate.getMonth() + 1) + "-" + currentDate.getDate();

        goalsLastUpdatedDate = formattedDate;
        goalsLastUpdatedContent = goalsTextArea.value;
        localStorage.setItem("goalsLastUpdatedDate", goalsLastUpdatedDate);
        localStorage.setItem("goalsLastUpdatedContent", goalsLastUpdatedContent);
        goalsLastUpdatedText.innerHTML = "Last Update:<br>" + goalsLastUpdatedDate;
        goalsTextArea.removeAttribute("readonly");
    })

    document.getElementById("missionLastUpdatedText").onclick = ((event) => {
        event.preventDefault();

        var currentDate = new Date();
        var formattedDate = currentDate.getFullYear() + "-" + (currentDate.getMonth() + 1) + "-" + currentDate.getDate();

        missionLastUpdatedDate = formattedDate;
        missionLastUpdatedContent = missionTextArea.value;
        localStorage.setItem("missionLastUpdatedDate", missionLastUpdatedDate);
        localStorage.setItem("missionLastUpdatedContent", missionLastUpdatedContent);
        missionLastUpdatedText.innerHTML = "Last Update:<br>" + missionLastUpdatedDate;
        missionTextArea.removeAttribute("readonly");
    })
</script>

<script src="{{asset("slides.js")}}" defer></script>
<script src="{{asset("transfer.js")}}" defer></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script src="{{ asset("lastUpdateHeadMembers.js") }}" defer></script>
<script src="lastUpdate.js" defer></script>
<script src="{{ asset("task.js") }}" defer></script>
</body>
</html>
