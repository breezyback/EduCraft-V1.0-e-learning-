@extends('layouts.hello')

@section('content')
<section class="all">
    <section class="fullheight">
        <div class="grid-container2 container">
            <div class="grid-item2">
                <h1 class="item2-1">For every student, every classroom.</br>Real results.</h1>
                <p class="item2-2">We’re a nonprofit with the mission to provide a free, world-class education for anyone, anywhere.</p>
            </div>
            <div class="grid-item3">
                <img class="item3-1" src="{{ asset('img/undraw_studying_s3l7.svg') }}" alt="">
            </div>
            <div class="grid-item4">
                <a class="btn bttc item2-3" href="{{ route('register') }}" style="background-color: #0E153A;">JOIN</a>
            </div>
        </div>
    </section>
    <hr>
    <section class="fullheight">
        <div class="grid-container2 container">
            <div class="grid-item-img">
                <img class="item3-1" src="{{ asset('img/undraw_teaching_f1cm.svg') }}" alt="">
            </div>
            <div class="grid-it">
                <h1 class="item2-1">Help every student succeed with personalized practice.</br>100% free.</h1>
                <p class="item2-2">
                <ul class="item2-2" style="left: 10px;">
                    <li>Find standards-aligned content</li>
                    <li>Assign practice exercises, videos and articles</li>
                    <li>Track student progress</li>
                    <li>Join millions of teachers and students</li>
                </ul>
                </p>
            </div>
        </div>
    </section>
    <hr>
    <section class="fullheight">
        <div class="grid-container2 container">
            <div class="grid-item2">
                <h1 class="item2-1">You can learn anything.</h1>
                <p class="item2-2">Build a deep, solid understanding in math, science, and more.</p>
            </div>
            <div class="grid-item3">
                <img class="item3-1" src="{{ asset('img/undraw_youtube_tutorial_2gn3.svg') }}" alt="">
            </div>
        </div>
    </section>
</section>
@endsection