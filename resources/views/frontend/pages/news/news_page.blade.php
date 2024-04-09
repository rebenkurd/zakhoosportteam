
@extends('frontend.index')

@section('content')

<!-- --------------------------------------------------------------------------------------- -->
<div class="header-fixture header-fixture_news_news ">
    <div class="left">
       <h1>News</h1>
       <p>{{ $team->name }}</p>
    </div>
    <div class="right">
       <img class="fornewsss" src="{{ !empty($team->logo) ? asset($team->logo) : 'https://via.placeholder.com'}}" alt="">
    </div>
 </div>

 <div class="all_news_last">
    @foreach ($news as $new )
        @if ($loop->index == 0)
        <div class="news newsone">
            <img src="{{ !empty($new->image) ? asset($new->image) : 'https://via.placeholder.com'}}" alt="">
            <div class="text">
               <div class="h">
                  <h3>{{ $new->title_en }}</h3>
                  <span>{{ $new->posted_time }}</span>
               </div>
               <p>{{ Str::substr($new->description_en, 0, 250) }}...</p>
            </div>
         </div>
        @else
        <div class="news">
           <img src="{{ !empty($new->image) ? asset($new->image) : 'https://via.placeholder.com'}}" alt="">
           <div class="text">
              <div class="h">
                 <h3 title="{{ $new->title_en }}">{{ Str::substr($new->title_en, 0, 50) }}...</h3>
                 <span>{{ $new->posted_time }}</span>
              </div>
              <p>{{ Str::substr($new->description_en, 0, 50) }}...</p>
            </div>
        </div>
        @endif
    @endforeach


 <div class="loadingg">
    <button class="LoadMore">Load More</button>
 </div>
 </div>

 <script>
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
 </script>
@endsection
