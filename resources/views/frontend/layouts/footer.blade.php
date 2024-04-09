@php
    $team = App\Models\Team::where('status','active')->first();
@endphp


<div class="footer">
    <div class="one">
    <div class="left">
       <div class="head">
        <h1>{{ $team->name }}</h1>
        <a href="https://maps.app.goo.gl/zxmQGCjkf1QyqTNB9">Stadium Location : {{ $team->stadium }}</a>
        <a>Phone Number : {{ $team->phone }}</a>
       </div>
       <div class="foot">
        <div class="wrapper">
            <a href="{{ $team->facebook }}" target="_blank" class="icon facebook">
                <div class="tooltip">Facebook</div>
                <span><i class="fa-brands fa-facebook-f"></i></span>
            </a>
            <a href="{{ $team->instagram }}" target="_blank" class="icon instagram">
                <div class="tooltip">Instagram</div>
                <span><i class="fa-brands fa-instagram"></i></span>
            </a>
            <a href="{{ $team->github }}" target="_blank" class="icon github">
                <div class="tooltip">Telegram</div>
                <span><i class="fa-brands fa-telegram"></i></span>
            </a>
           <a href="{{ $team->youtube }}" target="_blank" class="icon youtube">
                <div class="tooltip">YouTube</div>
                <span><i class="fa-brands fa-youtube"></i></span>
            </a>
          </div>
       </div>
    </div>
<div class="center">
<a href="#">Home</a>
<a href="#">Fixture</a>
<a href="#">News</a>
<a href="#">Players & Staff</a>
<a href="#">Our History</a>
</div>

<div class="right">
    @if (!empty($polls))
    @foreach ($polls as $poll )
        @if ($poll->category->slug == 'best-player')
            <a href="{{ route('vote.player',[$poll]) }}" class="footerbutton"> Vote now For Best Player <img src="./assets/images/soccer-player2.png" alt=""></a>
        @elseif ($poll->category->slug == 'best-goal')
            <a href="{{ route('vote.goal',[$poll]) }}" class="footerbutton"> Vote now For Best Goal <img src="./assets/images/soccer-player2.png" alt=""></a>
        @endif
    @endforeach
    @endif
</div>


</div>
<!-- <div class="two">@2024 sprint</div> -->
</div>
