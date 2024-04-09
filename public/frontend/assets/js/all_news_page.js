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



var swiper = new Swiper(".mySwiper", {

pagination: {
el: ".swiper-pagination",
renderBullet: function (index, className) {
  return '<span class="' + className + '">' + (index + 1) + "</span>";
},
},
});