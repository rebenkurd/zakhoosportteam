
var swiper = new Swiper(".bg-slider-thumbs", {
    loop: true,
    spaceBetween: 10,
    slidesPerView: 1,
    freeMode: true,
    navigation: {
      nextEl: ".swiper-button-next",
      prevEl: ".swiper-button-prev",
    },
    watchSlidesProgress: true,
  });
  var swiper2 = new Swiper(".bg-slider", {
    loop: true,
    spaceBetween:10,
    navigation: {
      nextEl: ".swiper-button-prev",
      prevEl: ".swiper-button-next",
    },
    effect:"coverflow",
    speed:1000,
    thumbs: {
      swiper: swiper,
    },
  });



  //navbar
//navbar
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


  //------------------------- end news and navbar-------------------------------//


let btn_news=document.querySelectorAll(".button_home");
let s_news=document.querySelector(".show-news");
let close_news=document.querySelector(".close");

btn_news.forEach(i=>{
  i.addEventListener("click",function(){
    console.log("hello");
s_news.classList.toggle("active");
  })
})
close_news.addEventListener("click",function(){
  s_news.classList.remove("active");
})


// ---------------
let filter=document.querySelector("#filter");
let modal_fixture=document.querySelector(".modal_fixture");
filter.addEventListener("click",function(){
modal_fixture.classList.toggle("act");
});
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
  ////////////////////////// ----- end Fixture



var swiper = new Swiper(".show-news .mySwiper", {
  slidesPerView: 1,
  spaceBetween: 0,
  autoplay: {
    delay: 2500,
    disableOnInteraction: false,
  },
  pagination: {
    el: ".swiper-pagination",
    clickable: true,
  },
  breakpoints:{
    0:{
      slidesPerView:1,
      spaceBetween: 0,
    }
    ,900:{
      slidesPerView:1,
      spaceBetween: 0,

    },
    1200:{
      slidesPerView:1,
    },
        }
});


var swiper = new Swiper(".show-news .mySwiper", {

  pagination: {
    el: ".swiper-pagination",

    renderBullet: function (index, className) {
      return '<span class="' + className + '">' + (index + 1) + "</span>";
    },
  },
});



let btn_newss=document.querySelectorAll(".btnbtn");
let s_newss=document.querySelector(".show-news");
let close_newss=document.querySelector(".close");

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

// ------------------------------ end Old News


var TrandingSlider = new Swiper('.tranding-slider', {
  effect: 'coverflow',
  grabCursor: true,
  centeredSlides:true,
  loop: true,

  slidesPerView: 'auto',
  spaceBetween:1400,

  coverflowEffect: {
    rotate: 0,
    stretch: 0,
    depth: 100,
    modifier: 2.5,
  },
  navigation: {
    nextEl: '.swiper-button-next',
    prevEl: '.swiper-button-prev',
  }
});
/////////////////////-------end players

