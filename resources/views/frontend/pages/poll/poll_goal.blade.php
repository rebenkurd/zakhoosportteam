@extends('frontend.index')

@section('content')

<div class="all-fixture">
    <div class="header-fixture">
        <div class="left">
            <h1>Zakho Club</h1>
            <p>Vote For The Goal oF The Month</p>
            <p>2023-2024</p>
        </div>
        <div class="right">
            <img src="{{ asset('frontend/assets/images/logo-azxo.jpeg')}}" alt="">
        </div>
    </div>
</div>
<!--  -->



<section class="radio-section">
    <h1>{{ $poll->category->name }} </h1>
    <div class="for_player">
        @foreach ($poll->options as $option )
        <div class="video_player">
            <iframe width="400" height="400" src="{{ $option->video_url }}"  frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
            <div class="footer">
                <div class=" left">
                    <p> {{ $option->player->full_name }} </p>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    <form id="pollForm" method="post" action="{{route('store.vote',[$poll])}}">
        @csrf
        <div class="radio-list">
            @foreach ($poll->options as $option )
                <div class="radio-item">
                    <input type="radio" name="option_id" id="option_{{ $option->id }}" value="{{$option->id}}" @if ($selectedOption == $option->id) checked @endif >
                    <label for="option_{{ $option->id }}">
                      <span>{{$option->player->full_name}}</span>
                    </label>
                </div>
            @endforeach
            <button type="submit" class="submited" id="submitButton">Submit Vote</button>
        </div>
        <!-- <p id="message">
    </p> -->
    </form>
</section>


{{-- activete and diactivate player --}}
<script>
    $(document).ready(function () {
        $("#pollForm").submit(function (e) {
            e.preventDefault();

            var url = $(this).attr('action');

            $.ajax({
                type: 'post',
                url: url,
                data: {
                    _token = '{{  csrf_token() }}',
                    option_id = $('input[name=option_id]:checked').val()
                },
                success: function (response) {
                    alert(response);
                },
                error: function (xhr, status, error) {
                    console.log(error);
                }
            });
        });
    });

</script>


{{-- <script>
    document.addEventListener("DOMContentLoaded", function () {
        const pollForm = document.getElementById('pollForm');
        const submitButton = document.getElementById('submitButton');
        // const message = document.getElementById('message');
        let hasVoted = false;

        // Load votes from local storage if available
        const votes = JSON.parse(localStorage.getItem('votes')) || {
            player1: 0,
            player2: 0,
            player3: 0
        };
        //updateVotesDisplay();

        pollForm.addEventListener('submit', function (event) {
            event.preventDefault(); // Prevent form submission

            if (!hasVoted) {
                const selectedPlayer = document.querySelector('input[name="player"]:checked');
                if (selectedPlayer) {
                    votes[selectedPlayer.value]++;
                    localStorage.setItem('votes', JSON.stringify(votes));
                    updateVotesDisplay();
                    hasVoted = true;
                    submitButton.textContent = 'Voted!';

                } else {
                    alert('Please select a player before submitting.');
                }
            } else {
                alert('You have already voted.');
            }
        });





        function updateVotesDisplay() {
            const totalVotes = Object.values(votes).reduce((acc, curr) => acc + curr, 0);
            const player1Percentage = calculatePercentage(votes.player1, totalVotes);
            const player2Percentage = calculatePercentage(votes.player2, totalVotes);
            const player3Percentage = calculatePercentage(votes.player3, totalVotes);

            document.querySelectorAll('.percentage').forEach(el => el.remove());

            const player1Label = document.querySelector('input[value="player1"]').parentElement;
            const player2Label = document.querySelector('input[value="player2"]').parentElement;
            const player3Label = document.querySelector('input[value="player3"]').parentElement;

            player1Label.insertAdjacentHTML('beforeend',
                `<span class="percentage">${player1Percentage}%</span>`);
            player2Label.insertAdjacentHTML('beforeend',
                `<span class="percentage">${player2Percentage}%</span>`);
            player3Label.insertAdjacentHTML('beforeend',
                `<span class="percentage">${player3Percentage}%</span>`);
        }

        function calculatePercentage(votes, totalVotes) {
            return totalVotes > 0 ? ((votes / totalVotes) * 100).toFixed(2) : 0;
        }
    });

</script> --}}

@endsection
