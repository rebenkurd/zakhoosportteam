
@extends('frontend.index')

@section('content')


<div class="all-fixture">
    <div class="header-fixture">
       <div class="left">
          <h1>Zakho Club</h1>
          <p>Vote for best player of the month</p>
          <p>2023-2024</p>
       </div>
       <div class="right">
          <img src="{{ asset('frontend/assets/images/logo-azxo.jpeg')}}" alt="">
       </div>
    </div>
    </div>


<section class="radio-section">
    <h1></h1>

{{-- {{route('poll.vote',[$poll])}} --}}
    <form id="pollForm" method="post" action="{{route('store.vote',[$poll])}}">
        @csrf
        <div class="radio-list">
            <h4 class="center">
                {{$poll->title}}
            </h4>
            <h6>
               {{$poll->started_time}}
            </h6>
        @foreach($poll->options as $option)

        <div class="radio-item">
        <img src="{{ !empty($option->player->image)? asset($option->player->image):'' }}" alt="">
        <input type="radio" name="option_id" id="option_{{ $option->id }}" value="{{$option->id}}" @if ($selectedOption == $option->id) checked @endif >
        <label for="option_{{ $option->id }}">
          <span>{{$option->player->full_name}}</span>
        </label>
        </div>
        @endforeach
        <button type="submit" class="submited vote" id="submitButton">Vote it!</button>
    </div>
    <!-- <p id="message">
    </p> -->
  </form>
  </section>


  {{-- activete and diactivate player --}}
<script>
$(document).ready(function() {
  $("#pollForm").submit(function(e) {
    e.preventDefault();

    var url = $(this).attr('action');

    $.ajax({
      type: 'post',
        url: url,
        data:{
            _token = '{{  csrf_token() }}',
            option_id = $('input[name=option_id]:checked').val()
        },
      success: function(response) {
        alert(response);
      },
      error: function(xhr, status, error) {
        console.log(error);
      }
    });
  });
});
</script>


@endsection
