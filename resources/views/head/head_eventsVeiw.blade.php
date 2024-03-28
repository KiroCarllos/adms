@extends("layout.app")


@section("content")
  <div class="main">
    <div class="hnavbar">
        <a class="hactive" href="{{ route('head_allEvents') }}">View Events</a>
        <a href="{{ route('head_events') }}">Create Events</a>
    </div>

    <h4 id="uploadevent">View Events</h4>

    <div class="contents">

        <div class="slideshow-container">
            @foreach ($events as $event)
            <div class="mySlides fade">
                <img src="{{ asset('uploads/' . $event->image) }}" alt="Event Image">
            </div>
            @endforeach
        </div>
        <br>
        <div style="text-align:center">
            <button class="prev" onclick="plusSlides(-1)">&#10094;</button>
            <button class="next" onclick="plusSlides(1)">&#10095;</button>
        </div>
    </div>
   </div>
@endsection
