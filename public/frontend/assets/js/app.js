//------------------------- START NAVBAR  -----------------
const showMenu = (toggleId, navId)=>{
    const toggle = document.getElementById(toggleId),
          nav = document.getElementById(navId);
 
    toggle.addEventListener('click', () =>{
        nav.classList.toggle('show-menu');
 
        toggle.classList.toggle('show-icon');
    });
 };
 showMenu('nav-toggle','nav-menu');
//------------------------------------------------------------//
 //drop down menu
    let drop =document.querySelectorAll(".dropdown__item");
    let menu=document.querySelectorAll(".dropdown__menu");
    let arrow=document.querySelectorAll(".dropdown__arrow");
    drop.forEach((i,index)=>{
        i.addEventListener("click",function(){
             menu[index].classList.toggle("show");
             arrow[index].classList.toggle("show");
        });
    });
 
 
//--------------------------





//------------------------------------------------------------------------------
// ---------------------------- END NAVBAR--------------------------------------
//------------------------------------------------------------------------------


//------------------------------------------------------------------------------
// ---------------------------- START NEW NEWS--------------------------------------
//------------------------------------------------------------------------------

// var swiper = new Swiper(".bg-slider-thumbs", {
//     loop: true,
//     spaceBetween: 10,
//     slidesPerView: 1,
//     freeMode: true,
//     navigation: {
//       nextEl: ".swiper-button-next",
//       prevEl: ".swiper-button-prev",
//     },
//     watchSlidesProgress: true,
//   });
//   var swiper2 = new Swiper(".bg-slider", {
//     loop: true,
//     spaceBetween:10,
//     navigation: {
//       nextEl: ".swiper-button-prev",
//       prevEl: ".swiper-button-next",
//     },
//     effect:"coverflow",
//     speed:1000,
//     thumbs: {
//       swiper: swiper,
//     },
//   });


let News_home=document.querySelectorAll(".button_home");
let N_HOme=document.querySelector(".show-news");
let Close_Home=document.querySelector(".close");

News_home.forEach(i=>{
  i.addEventListener("click",function(){
    console.log("hello");
N_HOme.classList.toggle("active");
  })
})
Close_Home.addEventListener("click",function(){
  s_news.classList.remove("active");
})

//------------------------------------------------------------------------------
// ---------------------------- END NEW NEWS--------------------------------------
//------------------------------------------------------------------------------

//------------------------------------------------------------------------------
// ---------------------------- START FIXTURE --------------------------------------
//------------------------------------------------------------------------------
var swiper = new Swiper(".all_card .mySwiper", {
    slidesPerView: 3,
    spaceBetween: -180,
    pagination: {
      el: ".swiper-pagination",
      clickable: true,
    },
    breakpoints:{
  0:{
    slidesPerView:1.04,
    spaceBetween: 0,
  }

  ,600:{
    slidesPerView:1,
  },
  1000:{
slidesPerView:2,
  },
  1200:{
    slidesPerView:3,
  },
      }
  });

  //------------------------------------------------------------------------------
// ---------------------------- END FIXTURE --------------------------------------
//------------------------------------------------------------------------------

  //------------------------------------------------------------------------------
// ---------------------------- START FIXTURE ALL MATCH  --------------------------------------
//------------------------------------------------------------------------------


const tabsBox = document.querySelector(".tabs-box"),
allTabs = tabsBox.querySelectorAll(".tab"),
arrowIcons = document.querySelectorAll(".icon i");

let isDragging = false;

const handleIcons = (scrollVal) => {
    let maxScrollableWidth = tabsBox.scrollWidth - tabsBox.clientWidth;
    arrowIcons[0].parentElement.style.display = scrollVal <= 0 ? "none" : "flex";
    arrowIcons[1].parentElement.style.display = maxScrollableWidth - scrollVal <= 1 ? "none" : "flex";
}

arrowIcons.forEach(icon => {
    icon.addEventListener("click", () => {
        // if clicked icon is left, reduce 350 from tabsBox scrollLeft else add
        let scrollWidth = tabsBox.scrollLeft += icon.id === "left" ? -140 : 140;
        handleIcons(scrollWidth);
    });
});

allTabs.forEach(tab => {
    tab.addEventListener("click", () => {
        tabsBox.querySelector(".active").classList.remove("active");
        tab.classList.add("active");
    });
});

const dragging = (e) => {
    if(!isDragging) return;
    tabsBox.classList.add("dragging");
    tabsBox.scrollLeft -= e.movementX;
    handleIcons(tabsBox.scrollLeft)
}

const dragStop = () => {
    isDragging = false;
    tabsBox.classList.remove("dragging");
}

tabsBox.addEventListener("mousedown", () => isDragging = true);
tabsBox.addEventListener("mousemove", dragging);
document.addEventListener("mouseup", dragStop);



//-------------------
let filter=document.querySelector("#filter");
let modal_fixture=document.querySelector(".modal_fixture");
filter.addEventListener("click",function(){
modal_fixture.classList.toggle("act");
});

  //------------------------------------------------------------------------------
// ---------------------------- END FIXTURE ALL MATCH  --------------------------------------
//------------------------------------------------------------------------------


  //------------------------------------------------------------------------------
// ---------------------------- START ALL NEWS PAGE  --------------------------------------
//------------------------------------------------------------------------------
let all_news=document.querySelectorAll(".news");
let LoadMore=document.querySelector(".LoadMore");

   let  currentitem=3;
   LoadMore.addEventListener("click",function(){
      for (let i = currentitem; i<currentitem +3; i++) {
      all_news[i].classList.add("actnews");
   }
   currentitem+=3;
   if(currentitem >=  all_news.length){
LoadMore.classList.add("act");
   }
});

let btn_news=document.querySelectorAll(".news");
let s_news=document.querySelector(".show-news");
let close_news=document.querySelector(".close");

console.log(btn_news);
btn_news.forEach(i=>{
i.addEventListener("click",function(){
 console.log("hello");
s_news.classList.toggle("active");
})
})
//close
close_news.addEventListener("click",function(){
s_news.classList.remove("active");
})



var swiper = new Swiper(".all_news_last .mySwiper", {

pagination: {
el: ".swiper-pagination",
renderBullet: function (index, className) {
  return '<span class="' + className + '">' + (index + 1) + "</span>";
},
},
});

  //------------------------------------------------------------------------------
// ---------------------------- END ALL NEWS PAGE  --------------------------------------
//------------------------------------------------------------------------------


  //------------------------------------------------------------------------------
// ---------------------------- START OLD NEWS HOME  --------------------------------------
//------------------------------------------------------------------------------



var swiper = new Swiper(".show-news .mySwiper", {
    slidesPerView: 4,
    spaceBetween: -200,
    pagination: {
      el: ".swiper-pagination",
      clickable: true,
    },
    breakpoints:{
      0:{
        slidesPerView:1.1,
        spaceBetween: 0,
      }
      ,900:{
        slidesPerView:2,
        spaceBetween: 0,
  
      },
      1200:{
        slidesPerView:3,
      },
          }
  });
  
  
  var swiper = new Swiper(".mySwiper", {
   
    pagination: {
      el: ".swiper-pagination",
      
      renderBullet: function (index, className) {
        return '<span class="' + className + '">' + (index + 1) + "</span>";
      },
    },
  });
  
  
  
  let btn_newss=document.querySelectorAll(".btn");
  let s_newss=document.querySelector(".show-news");
  let close_newss=document.querySelector(".close");
  
  console.log(btn_newss);
  btn_newss.forEach(i=>{
    i.addEventListener("click",function(){
      console.log("hello");
  s_newss.classList.toggle("active");
    })
  })
  close_newss.addEventListener("click",function(){
    s_newss.classList.remove("active");
  })
  
  
  
  var swiper = new Swiper(".for_old_news .mySwiper", {
    slidesPerView: 3,
    spaceBetween: -180,
    pagination: {
      el: ".swiper-pagination",
      clickable: true,
    },
    breakpoints:{
  0:{
    slidesPerView:1.1,
    spaceBetween: 0,
  }
  
  ,700:{
    slidesPerView:1.4,
  },
  1000:{
  slidesPerView:2,
  },
  1200:{
    slidesPerView:3,
  },
      }
  });

    //------------------------------------------------------------------------------
// ---------------------------- END OLD NEWS HOME  --------------------------------------
//------------------------------------------------------------------------------

    //------------------------------------------------------------------------------
// ---------------------------- END OLD NEWS HOME  --------------------------------------
//------------------------------------------------------------------------------

    //------------------------------------------------------------------------------
// ---------------------------- START PLAYERS HOME--------------------------------------
//------------------------------------------------------------------------------


var TrandingSlider = new Swiper('.tranding-slider', {
    effect: 'coverflow',
    grabCursor: true,
    centeredSlides:true,
    loop: true,
    
    slidesPerView: 'auto',
    spaceBetween:999.5,
    
    coverflowEffect: {
      rotate: 0,
      stretch: 0,
      depth: 100,
      modifier: 2.5,
    },
    // pagination: {
    //   el: '.swiper-pagination',
    //   clickable: true,
    // },
    navigation: {
      nextEl: '.swiper-button-next',
      prevEl: '.swiper-button-prev',
    }
  });

//------------------------------------------------------------------------------
// ---------------------------- END PLAYERS HOME  --------------------------------------
//------------------------------------------------------------------------------


//------------------------------------------------------------------------------
// ---------------------------- START VOTE FOR BEST PLAYER  --------------------------------------
//------------------------------------------------------------------------------





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
  
  
  
//   //------------------------------------------------------------------------------
// // ---------------------------- END VOTE FOR BEST PLAYER  --------------------------------------
// //------------------------------------------------------------------------------


// //------------------------------------------------------------------------------
// // ---------------------------- START VOTE FOR  GOALS  --------------------------------------
// //------------------------------------------------------------------------------

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
  
  
  
  
  
  
  
  
  







// //------------------------------------------------------------------------------
// // ---------------------------- END VOTE FOR  GOALS  --------------------------------------
// //------------------------------------------------------------------------------

  
  
  