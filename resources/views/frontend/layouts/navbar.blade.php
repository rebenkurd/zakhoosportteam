<header class="header_navbar">
    <nav class="nav container">
       <div class="nav__data">
          <a href="{{ route('home.page') }}" class="nav__logo">
             <img src="./assets/images/logo.png" alt=""> ZaKho Sport Club
          </a>

          <div class="nav__toggle" id="nav-toggle">
             <i class="fa-solid fa-bars-staggered"></i>
             <i class="ri-close-line nav__close"></i>
          </div>
       </div>
       <!--=============== NAV MENU ===============-->
       <div class="nav__menu" id="nav-menu">
          <ul class="nav__list">
             <li><a href="{{ route('home.page') }}" class="nav__link">@lang('index.home')</a></li>
             <li><a href="{{ route('news.page') }}" class="nav__link">News</a></li>
             <!--=============== DROPDOWN 1 ===============-->
             <li class="dropdown__item">
                <div class="nav__link">
                   Fixtures <i class="ri-arrow-down-s-line dropdown__arrow"></i>
                </div>

                <ul class="dropdown__menu">
                   <li>
                      <a href="../All-fixture/navbar/index.html" class="dropdown__link">
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

             <li><a href="{{ route('player.staff.page') }}" class="nav__link">Player & staff</a></li>

             <li><a href="../kits/navbar/index.html" class="nav__link">ZakhoKit</a></li>

             <!--=============== DROPDOWN 2 ===============-->
             <li class="dropdown__item">
                <div class="nav__link">
                   Users <i class="ri-arrow-down-s-line dropdown__arrow"></i>
                </div>

                <ul class="dropdown__menu">

                    @guest
                    <li>
                        <a href="{{ route('login') }}" class="dropdown__link">
                           <i class="ri-user-received-fill"></i> {{ __('Login') }}
                        </a>
                     </li>
                    <li>
                      <a href="{{ route('register') }}" class="dropdown__link">
                         <i class="ri-user-add-line"></i> Register
                      </a>
                   </li>
                    @endguest

                    @auth
                    <li>
                        <a href="{{ route('logout.user') }}" class="dropdown__link">
                           <i class="ri-user-received-fill"></i> @lang('index.logout')
                        </a>
                     </li>
                    @endauth





                   <li>
                      <a href="../vote_for_Goal/Poll_1/index.html" class="dropdown__link">
                         <i class="ri-feedback-fill"></i> Vote For Goal Month
                      </a>
                   </li>
                   <li>
                      <a href="../vote_for_Goal/Poll_1/index.html" class="dropdown__link">
                         <i class="ri-feedback-fill"></i> Vote For Player
                      </a>
                   </li>
                </ul>
             </li>

             <li><a href="../History/navbar/index.html" class="nav__link">Our history</a></li>

           <!--=============== DROPDOWN 3 ===============-->
           <li class="dropdown__item">
               <div class="nav__link">
                   <div class="language"><img src="./assets/images/flag.png" alt=""> <span>ENG</span></div>
                   <i class="ri-arrow-down-s-line dropdown__arrow"></i>
                    </div>

               <ul class="dropdown__menu">
                <li>
                   <a href="{{ route('set.lang','ckb') }}" class="dropdown__link">
                     <div class="language"><img src="./assets/images/flag-krd.png" alt=""> <span>Kurdish Sorani</span></div>
                 </a>
                </li>
                  <li>
                     <a href="{{ route('set.lang','en') }}" class="dropdown__link">
                       <div class="language"><img src="./assets/images/flag.png" alt=""> <span>English</span></div>
                   </a>
                  </li>

                  <li>
                     <a href="{{ route('set.lang','ku') }}" class="dropdown__link">
                       <div class="language"><img src="./assets/images/flag-krd.png" alt=""> <span>Kurdish Badini</span></div>
                   </a>
                  </li>

                  <li>
                     <a href="{{ route('set.lang','ar') }}" class="dropdown__link">
                       <div class="language"><img src="./assets/images/flag-iraq.png" alt=""> <span>Arabic</span></div>
                   </a>
                  </li>
               </ul>
            </li>


            @auth
                @if (Auth::check() && Auth::user()->role != 'subscriber')
                    <li><a href="{{ route('dashboard') }}" target="_blank" class="nav__link">Dashboard</a></li>
                @endif
            @endauth


          </ul>
       </div>

    </nav>
 </header>

