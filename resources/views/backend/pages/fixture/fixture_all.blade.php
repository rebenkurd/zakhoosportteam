<!DOCTYPE html>
   <html lang="en">
   <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">

      <!--=============== REMIXICONS ===============-->
      <link href="https://cdn.jsdelivr.net/npm/remixicon@3.2.0/fonts/remixicon.css" rel="stylesheet">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
      <!--=============== CSS ===============-->
      <style>
                                /*=============== GOOGLE FONTS ===============*/
                        @import url("https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600&display=swap");

                        /*=============== VARIABLES CSS ===============*/
                        :root {
                        --header-height: 3.5rem;
                        /*========== Colors ==========*/
                        /*Color mode HSL(hue, saturation, lightness)*/
                        --black-color: hsl(0, 0%, 100%);
                        --black-color-light: hsl(0, 0%, 98%);
                        --black-color-lighten: hsl(220, 20%, 18%);
                        --white-color: rgb(0, 0, 0);
                        --body-color: hsl(220, 100%, 97%);

                        /*========== Font and typography ==========*/
                        /*.5rem = 8px | 1rem = 16px ...*/
                        --body-font: "Montserrat", sans-serif;
                        --normal-font-size: .938rem;

                        /*========== Font weight ==========*/
                        --font-regular: 400;
                        --font-semi-bold: 600;

                        /*========== z index ==========*/
                        --z-tooltip: 10;
                        --z-fixed: 100;
                        }

                        /*========== Responsive typography ==========*/
                        @media screen and (min-width: 1024px) {
                        :root {
                            --normal-font-size: 1rem;
                        }
                        }

                        /*=============== BASE ===============*/
                        * {
                        box-sizing: border-box;
                        padding: 0;
                        margin: 0;
                        }

                        body {
                        font-family: var(--body-font);
                        font-size: var(--normal-font-size);
                        height: 200vh;
                        }

                        ul {
                        list-style: none;
                        /* Color highlighting when pressed on mobile devices */
                        /*-webkit-tap-highlight-color: transparent;*/
                        }

                        a {
                        text-decoration: none;
                        }

                        /*=============== REUSABLE CSS CLASSES ===============*/
                        .container {
                        max-width: 1300px;
                        margin-inline: 1.5rem;
                        }
                        /*=============== HEADER ===============*/
                        .header {
                        position: fixed;
                        top: 0;
                        left: 0;
                        width: 100%;
                        z-index: var(--z-fixed);
                        background-color: white;
                        }
                        .addheader{
                        background-color: var(--black-color);
                        box-shadow: 0 2px 16px hsla(220, 32%, 8%, .3);
                        }


                        /*=============== NAV ===============*/
                        .nav {
                        height: var(--header-height);
                        }

                        .nav__logo,
                        .fa-bars-staggered,
                        .nav__close {
                        color: var(--white-color);
                        }

                        .nav__data {
                        height: 100%;
                        display: flex;
                        justify-content: space-between;
                        align-items: center;
                        }
                        .nav__logo {
                        display: inline-flex;
                        align-items: center;
                        column-gap: .25rem;
                        color:rgb(0, 0, 0);
                        font-weight: var(--font-semi-bold);
                        /* Color highlighting when pressed on mobile devices */
                        /*-webkit-tap-highlight-color: transparent;*/
                        }
                        .nav__data img{
                        width: 60px;
                        }
                        /*---------------------------------------------------------------------- */

                        .nav__link  img{
                        width: 35px;
                        }
                        .dropdown__link img{
                        width: 35px;
                        }
                        .language{
                        display: inline-flex;
                        align-items: center;
                        column-gap: .25rem;
                        }
                        /*----------------------------------------------------------------------*/
                        .nav__logo i {
                        font-weight: initial;
                        font-size: 1.25rem;
                        }

                        .nav__toggle {
                        position: relative;
                        width: 32px;
                        height: 32px;
                        }

                        .fa-bars-staggered,
                        .nav__close {
                        position: absolute;
                        width: max-content;
                        height: max-content;
                        inset: 0;
                        margin: auto;
                        font-size: 1.25rem;
                        cursor: pointer;
                        transition: opacity .1s, transform .4s;
                        }

                        .nav__close {
                        opacity: 0;
                        }
                        .nav .social{
                        display: none;
                        }

                        /* Navigation for mobile devices */
                        @media screen and (max-width: 1118px) {
                        .nav__menu {
                            position: absolute;
                            left: 0;
                            padding-top: 20px;
                            top: 3.5rem;
                            width: 100%;
                            height: calc(100vh - 3.5rem);
                            overflow: auto;
                            pointer-events: none;
                            opacity: 0;
                            transition: top .4s, opacity .3s;
                        }
                        .header{
                            padding: 10px 0;
                        }
                        .nav__menu::-webkit-scrollbar {
                            width: 0;
                        }
                        .nav__list {
                            background-color: var(--black-color);
                            padding-top: 1rem;
                            height: 100%;
                        }
                        .dropdown__item:hover .show.dropdown__menu {
                            max-height: 1000px;
                            transition: max-height .4s ease-in;
                        }

                        /* Rotate dropdown icon */
                        .dropdown__item:hover .show.dropdown__arrow {
                            transform: rotate(180deg);
                        }

                        .nav .social{
                            display: flex;
                            width: 100%;
                            justify-content: space-evenly;
                        align-items: end;
                        padding: 15px 0;
                        padding-top: 140px;
                        }
                        .nav .social i{
                            font-size: 2rem;
                        }
                        .nav .social .fa-square-instagram{
                            border-radius: 10px;
                            color: transparent;
                            background: -webkit-radial-gradient(30% 107%, circle, #fdf497 0%, #fdf497 5%, #fd5949 45%, #d6249f 60%, #285AEB 90%);
                            background: -o-radial-gradient(30% 107%, circle, #fdf497 0%, #fdf497 5%, #fd5949 45%, #d6249f 60%, #285AEB 90%);
                            background: radial-gradient(circle at 30% 107%, #fdf497 0%, #fdf497 5%, #fd5949 45%, #d6249f 60%, #285AEB 90%);
                            background: -webkit-radial-gradient(circle at 30% 107%, #fdf497 0%, #fdf497 5%, #fd5949 45%, #d6249f 60%, #285AEB 90%);
                            background-clip: text;
                            -webkit-background-clip: text;
                        }
                        }

                        .nav__link {
                        color: var(--white-color);
                        background-color: var(--black-color);
                        font-weight: var(--font-semi-bold);
                        padding: 1.25rem 1.5rem;
                        display: flex;
                        justify-content: space-between;
                        align-items: center;
                        transition: background-color .3s;
                        }

                        .nav__link:hover {
                        background-color: var(--black-color-light);
                        }

                        /* Show menu */
                        .show-menu {
                        opacity: 1;
                        top: 3.5rem;
                        pointer-events: initial;
                        }

                        /* Show icon */
                        .show-icon .fa-bars-staggered {
                        opacity: 0;
                        transform: rotate(90deg);
                        }
                        .show-icon .nav__close {
                        opacity: 1;
                        transform: rotate(90deg);
                        }

                        /*=============== DROPDOWN ===============*/
                        .dropdown__item {
                        cursor: pointer;
                        }

                        .dropdown__arrow {
                        font-size: 1.25rem;
                        font-weight: initial;
                        transition: transform .4s;
                        }

                        .dropdown__link,
                        .dropdown__sublink {
                        padding: 1.25rem 1.25rem 1.25rem 2.5rem;
                        color: var(--white-color);
                        background-color: var(--black-color-light);
                        display: flex;
                        align-items: center;
                        column-gap: .5rem;
                        font-weight: var(--font-semi-bold);
                        transition: background-color .3s;
                        }

                        .dropdown__link i,
                        .dropdown__sublink i {
                        font-size: 1.25rem;
                        font-weight: initial;
                        }

                        .dropdown__link:hover,
                        .dropdown__sublink:hover {
                        background-color: var(--black-color);
                        }

                        .dropdown__menu,
                        .dropdown__submenu {
                        max-height: 0;
                        overflow: hidden;
                        transition: max-height .4s ease-out;
                        }


                        /*=============== DROPDOWN SUBMENU ===============*/
                        .dropdown__add {
                        margin-left: auto;
                        }

                        .dropdown__sublink {
                        background-color: var(--black-color-lighten);
                        }

                        /*=============== BREAKPOINTS ===============*/
                        /* For small devices */
                        @media screen and (max-width: 340px) {
                        .container {
                            margin-inline: 1rem;
                        }

                        .nav__link {
                            padding-inline: 1rem;
                        }
                        }

                        /* For large devices */
                        @media screen and (min-width: 1118px) {
                        .container {
                            margin-inline: auto;
                        }

                        .nav {
                            height: calc(var(--header-height) + 2rem);
                            display: flex;
                            justify-content: space-between;
                        }
                        .nav__toggle {
                            display: none;
                        }
                        .nav__list {
                            height: 100%;
                            display: flex;
                            column-gap: 3rem;
                        }
                        .nav__link {
                            height: 100%;
                            padding: 0;
                            justify-content: initial;
                            column-gap: .25rem;
                        }
                        .nav__link:hover {
                            background-color: transparent;
                        }


                        .dropdown__item,
                        .dropdown__subitem {
                            position: relative;
                        }

                        .dropdown__menu,
                        .dropdown__submenu {
                            max-height: initial;
                            overflow: initial;
                            position: absolute;
                            left: 0;
                            top: 6rem;
                            opacity: 0;
                            pointer-events: none;
                            transition: opacity .3s, top .3s;
                        }

                        .dropdown__link,
                        .dropdown__sublink {
                            padding-inline: 1rem 3.5rem;
                        }

                        .dropdown__subitem .dropdown__link {
                            padding-inline: 1rem;
                        }

                        .dropdown__submenu {
                            position: absolute;
                            left: 100%;
                            top: .5rem;
                        }

                        /* Show dropdown menu */
                        .dropdown__item:hover .dropdown__menu {
                            opacity: 1;
                            top: 5.5rem;
                            pointer-events: initial;
                            transition: top .3s;
                        }

                        /* Show dropdown menu & submenu */
                        .dropdown__item:hover .dropdown__menu {
                        max-height: 1000px;
                        transition: max-height .4s ease-in;
                        }

                        /* Rotate dropdown icon */
                        .dropdown__item:hover .dropdown__arrow {
                        transform: rotate(180deg);
                        }


                        }

                        /* ------------------------------------------------------------------------------ */
                        .header-fixture{
                        width: 100%;
                        padding: 0 50px;
                        margin-top: 85px;
                        background: url("./photo_2023-12-05_21-30-32.jpeg");
                        background-size: cover;
                        height: 426px;
                        display: flex;
                        align-items: center;
                        margin-top: 60px;
                        justify-content: space-between;
                        }
                        .header-fixture .left {
                        color:  white;
                        }
                        .header-fixture .left h1{
                        font-family: Noto Sans;
                        font-size: 50px;
                        font-weight: 700;
                        line-height: 52px;
                        letter-spacing: 0em;
                        text-align: left;
                        }
                        .header-fixture .left p{
                        font-family: Noto Sans;
                        font-size: 32px;
                        font-weight: 700;
                        line-height: 52px;
                        letter-spacing: 0em;
                        text-align: left;
                        opacity: .8;
                        }


                        .header-fixture .right img{
                        width: 218px;
                        height: 218px;

                        border-radius: 199px;

                        }

                        /*----*/
                        .months{
                        width: 100%;
                        display: flex;
                        flex-direction: column;
                        align-items: center;
                        }
                        .months .match{
                        width: 90%;
                        box-shadow: rgba(149, 157, 165, 0.2) 0px 8px 24px;
                        border-radius: 10px;
                        display: flex;
                        flex-direction: column;
                        align-items: center;
                        justify-content: space-evenly;
                        height: 298px;
                        margin: 30px 0;
                        background-color: white;
                        }
                        .months .header-month{
                        margin-left: 80px;
                        margin:  30px 0px 10px 80px;
                        align-self: flex-start;
                        }
                        .months .header-month h1{
                        color:#E22028;
                        margin-bottom: 5px;
                        }
                        .months .match .main{
                        display: flex;
                        }
                        .months  .match .button_match{
                        background: #E22028;
                        color: white;
                        display: flex;
                        justify-content: center;
                        align-items: center;
                        width: 400px;
                        border-radius: 15px;
                        border: 0;
                        outline: 0;
                        height: 50px;
                        width: 65%;
                        height: 48px;
                        padding: 14px, 0px, 14px, 0px;
                        border-radius: 8px;
                        }
                        .months  .match .button_match .icon{
                        width: 30px;
                        margin: 0px 10px;
                        color:white;
                        }
                        .months .match .header-match{

                        text-align: center;
                        }
                        .months .match .header-match .op{
                        margin: 4px 0;
                        opacity: .7;
                        }
                        .months .match img{
                        width: 65px;
                        border: 1px solid rgb(224, 222, 222);
                        border-radius: 50%;
                        object-fit: cover;
                        display: flex;
                        justify-content: center;
                        align-items: center;
                        padding: 5px;
                        }
                        .months .main .result{
                        display: flex;
                        }
                        .months .main .result h2{
                        background-color: #E22028;
                        width: 60px;
                        height: 60px;
                        border-radius: 50%;
                        display: flex;
                        justify-content: center;
                        align-items: center;
                        color: white;
                        margin: 7px 20px;
                        }
                        @media screen and (max-width:550px){
                        .header-fixture{
                            width: 100%;
                            padding: 0 0px;
                        }
                        .months .header-month{
                        width: 90%;
                        margin: 0;
                        margin-top: 20px ;
                        align-self: center;
                        }
                        .months .header-month p{

                        font-size: 14px;
                        }
                        .header-fixture{
                        flex-direction: column-reverse;
                        justify-content: center;
                        align-items: center;
                        text-align: center;
                        }
                        .header-fixture .left h1 {
                        font-size: 24px;
                        }
                        .header-fixture .left p {
                        font-size: 16px;
                        text-align: center;
                        }
                        .months .main .result h2{
                        margin-top: 10px;
                        background-color: #E22028;
                        width: 50px;
                        height: 50px;
                        }
                        }


                        .match_status{
                            animation:match 1s infinite;
                            color: green
                        }

                        @keyframes match{
                            0%{
                                opacity: .5;
                            }
                            50%{
                                opacity: 1;
                            }
                            100%{
                                opacity: 0.5;
                            }
                        }
      </style>

      <title>Responsive dropdown menu - Bedimcode</title>
   </head>
   <body>
      <!--=============== HEADER ===============-->
      <header class="header">
         <nav class="nav container">
            <div class="nav__data">
               <a href="#" class="nav__logo">
                  <img src="./logo.png" alt=""> ZaKho Sport Club
               </a>

               <div class="nav__toggle" id="nav-toggle">
                  <i class="fa-solid fa-bars-staggered"></i>
                  <i class="ri-close-line nav__close"></i>
               </div>
            </div>
            <!--=============== NAV MENU ===============-->
            <div class="nav__menu" id="nav-menu">
               <ul class="nav__list">
                  <li><a href="#" class="nav__link">Home</a></li>
                  <li><a href="#" class="nav__link">News</a></li>
                  <!--=============== DROPDOWN 1 ===============-->
                  <li class="dropdown__item">
                     <div class="nav__link">
                        Fixtures <i class="ri-arrow-down-s-line dropdown__arrow"></i>
                     </div>

                     <ul class="dropdown__menu">
                        <li>
                           <a href="#" class="dropdown__link">
                              <i class="ri-pie-chart-line"></i> Fixtures
                           </a>
                        </li>

                        <li>
                           <a href="#" class="dropdown__link">
                              <i class="ri-arrow-up-down-line"></i> Results
                           </a>
                        </li>

                        <!--=============== DROPDOWN SUBMENU ===============-->
                        <li>
                           <a href="#" class="dropdown__link">
                              <i class="ri-bar-chart-line"></i> Tables
                           </a>
                        </li>
                     </ul>
                  </li>

                  <li><a href="#" class="nav__link">Player & staff</a></li>

                  <li><a href="#" class="nav__link">ZakhoKit</a></li>

                  <!--=============== DROPDOWN 2 ===============-->
                  <li class="dropdown__item">
                     <div class="nav__link">
                        Users <i class="ri-arrow-down-s-line dropdown__arrow"></i>
                     </div>

                     <ul class="dropdown__menu">
                        <li>
                           <a href="#" class="dropdown__link">
                              <i class="ri-user-line"></i> Profiles
                           </a>
                        </li>

                        <li>
                           <a href="#" class="dropdown__link">
                              <i class="ri-lock-line"></i> Accounts
                           </a>
                        </li>


                        <li>
                           <a href="#" class="dropdown__link">
                              <i class="ri-message-3-line"></i> Messages
                           </a>
                        </li>
                     </ul>
                  </li>

                  <li><a href="#" class="nav__link">Our history</a></li>

                <!--=============== DROPDOWN 3 ===============-->
                <li class="dropdown__item">
                    <div class="nav__link">
                        <div class="language"><img src="./flag.png" alt=""> <span>ENG</span></div>
                        <i class="ri-arrow-down-s-line dropdown__arrow"></i>
                         </div>

                    <ul class="dropdown__menu">
                     <li>
                        <a href="#" class="dropdown__link">
                          <div class="language"><img src="./flag-krd.png" alt=""> <span>Kurdish</span></div>
                      </a>
                     </li>
                       <li>
                          <a href="#" class="dropdown__link">
                            <div class="language"><img src="./flag.png" alt=""> <span>English</span></div>
                        </a>
                       </li>

                       <li>
                          <a href="#" class="dropdown__link">
                            <div class="language"><img src="./flag-iraq.png" alt=""> <span>Arabic</span></div>
                        </a>
                       </li>



                    </ul>
                 </li>
                </li>
                <div class="social">
<a href="#"><i class="fa-brands fa-facebook" style="color: #024dcf;"></i></a>
<a href="#"><i class="fa-brands fa-square-instagram"></i></a>
<a href="#"><i class="fa-brands fa-x-twitter" style="color: #000000;"></i></a>
<a href="#"><i class="fa-brands fa-youtube" style="color: #f00000;"></i></a>
               </div>
               </ul>
            </div>

         </nav>
      </header>
<!-- --------------------------------------------------------------------------------------- -->
<div class="all-fixture">
<div class="header-fixture">
   <div class="left">
      <h1>Fixtures & Results</h1>
      <p>Zakho Team</p>
   </div>
   <div class="right">
      <img src="./logo-azxo.jpeg" alt="">
   </div>
</div>
 <div class="months">
   <div class="header-month">
      <h1>November</h1>
      <p>Dates/Times are shown in UK time and are subject to change</p>
   </div>



   @foreach ($fixtures['data']['fixtures'] as $fixture)
        <div class="match">
        <div class="header-match">
            <h3>{{ isset($fixture['date']) && $fixture['date'] ? $fixture['date']:''}} - {{ isset($fixture['time']) && $fixture['time'] ? $fixture['time']:''}}</h3>
            <h3 class="op">{{ isset($fixture['league_name']) && $fixture['league_name'] ? $fixture['league_name']:''}}</h3>
            <h3 class="match_status">{{ isset($fixture['match_status']) && $fixture['match_status'] ? $fixture['match_status']:''}}</h3>
        </div>
        <div class="main">
            <div class="one">
            <img src="{{ isset($fixture['home_name']) && $fixture['home_name'] ? $fixture['home_name']:''}}" alt="">
            <h4>{{ isset($fixture['home_name']) && $fixture['home_name'] ? $fixture['home_name']:'match_hometeam_name'}}</h4>
            </div>
            <div class="result">
            <h2>{{ isset($fixture['match_hometeam_score']) && $fixture['match_hometeam_score'] ? $fixture['match_hometeam_score']:'0'}}</h2>
            <h2>{{ isset($fixture['match_awayteam_score']) && $fixture['match_awayteam_score'] ? $fixture['match_awayteam_score']:'0'}}</h2>
            </div>
            <div class="one">
            <img src="{{ isset($fixture['team_away_badge']) && $fixture['team_away_badge'] ? $fixture['team_away_badge']:'team name'}}" alt="">
            <h4>{{ isset($fixture['match_awayteam_name']) && $fixture['match_awayteam_name'] ? $fixture['match_awayteam_name']:'match_awayteam_name'}}</h4>
            </div>
        </div>
        <button class="button_match">
            Match Details
            <svg class="icon" viewBox="0 0 24 24" fill="currentColor">
            <path fill-rule="evenodd" d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25zm4.28 10.28a.75.75 0 000-1.06l-3-3a.75.75 0 10-1.06 1.06l1.72 1.72H8.25a.75.75 0 000 1.5h5.69l-1.72 1.72a.75.75 0 101.06 1.06l3-3z" clip-rule="evenodd"></path>
            </svg>
            </button>
        </div>
   @endforeach







</div>

</div>



      <!--=============== MAIN JS ===============-->
      <script >
                            //navbar
                    const showMenu = (toggleId, navId) =>{
                        const toggle = document.getElementById(toggleId),
                            nav = document.getElementById(navId)

                        toggle.addEventListener('click', () =>{
                            // Add show-menu class to nav menu
                            nav.classList.toggle('show-menu');

                            // Add show-icon to show and hide the menu icon
                            toggle.classList.toggle('show-icon');
                        })
                    }
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





                // ------------------------------------------------------------------------------------
      </script>

   </body>
</html>
