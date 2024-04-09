
document.addEventListener("DOMContentLoaded", function() {
    const pollForm = document.getElementById('pollForm');
    const submitButton = document.getElementById('submitButton');
   // const message = document.getElementById('message');
    let hasVoted = false;
  
    // Load votes from local storage if available
    const votes = JSON.parse(localStorage.getItem('votes')) || {player1: 0, player2: 0, player3: 0};
    //updateVotesDisplay();
  
    pollForm.addEventListener('submit', function(event) {
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
  
    player1Label.insertAdjacentHTML('beforeend', `<span class="percentage">${player1Percentage}%</span>`);
    player2Label.insertAdjacentHTML('beforeend', `<span class="percentage">${player2Percentage}%</span>`);
    player3Label.insertAdjacentHTML('beforeend', `<span class="percentage">${player3Percentage}%</span>`);
    }
  
    function calculatePercentage(votes, totalVotes) {
      return totalVotes > 0 ? ((votes / totalVotes) * 100).toFixed(2) : 0;
    }
  });
  
  
  
  
  
  
  
  
  