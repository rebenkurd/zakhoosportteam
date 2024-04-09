@extends('frontend.index')

@section('content')


<section class="home">
    <div class="swiper bg-slider">
        <div class="swiper-wrapper">
            @foreach ($breaknews as $break )
                <div class="swiper-slide dark-layer">
                    <img src="{{ !empty($break->image) ? asset($break->image) : 'https://via.placeholder.com'}}" />
                    <div class="text-content">
                        <h2 class="title">{{ $break->title_en }} </h2>
                        <p>{{ Str::substr($break->description_en, 0, 400) }}</p>
                        <a href="#" class="button_home pulse ">Read More</a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <div class="swiper bg-slider-thumbs">

        <div class="swiper-wrapper thumbs-container">
        </div>
    </div>
    <div class="swiper-button">
        <div class="swiper-button-next"><i class="fa-solid fa-arrow-left"></i></div>
        <div class="swiper-button-prev"><i class="fa-solid fa-arrow-right"></i></div>
    </div>
</section>
<!-- ---------------------------- -->

<div class="all_card">
    <div class="events">
        <div class="one">
            <div class="two">
                <h1>Next Events</h1>
                <p><span class="spantext">See All</span> <i class="fa-solid fa-arrow-right"></i> </p>
            </div>
            <button id="filter"><i class="fa-solid fa-list"></i> Filter Teames
            </button>
            <div class="modal_fixture">
                <label class="container">Iraq League
                    <input type="radio" name="radio">
                    <span class="check"></span>
                    <img src="{{ asset('frontend/assets/images/iraqiraq.png')}}" alt="">
                </label>
                <label class="container">Kurdistan League
                    <input type="radio" name="radio">
                    <span class="check"></span>
                    <img src="{{ asset('frontend/assets/images/kurdistan_league-removebg-preview.png')}}" alt="">

                </label>
                <button class="showevents">Show Events</button>
            </div>
        </div>
    </div>
    <div class="swiper mySwiper">
        <div class="swiper-wrapper">


            <div class="swiper-slide">
                <div class="card_fixture">
                    <div class="header_fixture">
                        <div class="club">
                            <img src="{{ asset('frontend/assets/images/Zakho_FC_logo.png')}}" alt="">
                            <p>ZAKHO</p>
                        </div>
                        <h1>VS</h1>
                        <div class="club">
                            <img src="{{ asset('frontend/assets/images/Nowruz_SC_logo.png')}}" alt="">

                            <p>NEWROZ</p>
                        </div>
                    </div>
                    <div class="footer_fixture">
                        <p>Football - premier league</p>
                        <h4>IRAQ PREMIER LEAGUE</h4>
                        <h4>Matchday 29</h4>
                        <div class="one_fix">
                            <i class="fa-solid fa-calendar-days"></i>
                            <p>Friday, Mar 15, 6:00 PM h</p>
                        </div>

                        <div class="two_fix">
                            <i class="fa-solid fa-location-dot"></i>
                            <p>Zakho</p>
                        </div>
                        <div class="btnn">
                            <i class="fa-solid fa-circle-info"></i>
                            <p>More</p>
                        </div>
                    </div>

                </div>


            </div>
            <!--  -->
            <div class="swiper-slide">
                <div class="card_fixture">
                    <div class="header_fixture">
                        <div class="club">
                            <img src="{{ asset('frontend/assets/images/Zakho_FC_logo.png')}}" alt="">
                            <p>ZAKHO</p>
                        </div>
                        <div class="fixvs">
                            <div class="headvs">
                                <img src="{{ asset('frontend/assets/images/iraq_league-removebg-preview.png')}}" alt="">
                            </div>
                            <div class="footvs">
                                <p>1</p>
                                <p>-</p>
                                <p>1</p>
                            </div>
                        </div>
                        <div class="club">
                            <img src="{{ asset('frontend/assets/images/Nowruz_SC_logo.png')}}" alt="">

                            <p>NEWROZ</p>
                        </div>
                    </div>
                    <div class="footer_fixture">
                        <p>Football - premier league</p>
                        <h4>IRAQ PREMIER LEAGUE</h4>
                        <h4>Matchday 29</h4>
                        <div class="one_fix">
                            <i class="fa-solid fa-calendar-days"></i>
                            <p>Friday, Mar 15, 6:00 PM h</p>
                        </div>

                        <div class="two_fix">
                            <i class="fa-solid fa-location-dot"></i>
                            <p>Zakho</p>
                        </div>
                        <div class="btnn">
                            <i class="fa-solid fa-circle-info"></i>
                            <p>More</p>
                        </div>
                    </div>

                </div>


            </div>
            <!--  -->

            <div class="swiper-slide">
                <div class="card_fixture">
                    <div class="header_fixture">
                        <div class="club">
                            <img src="{{ asset('frontend/assets/images/Zakho_FC_logo.png')}}" alt="">
                            <p>ZAKHO</p>
                        </div>
                        <h1>VS</h1>
                        <div class="club">
                            <img src="{{ asset('frontend/assets/images/Nowruz_SC_logo.png')}}" alt="">

                            <p>NEWROZ</p>
                        </div>
                    </div>
                    <div class="footer_fixture">
                        <p>Football - premier league</p>
                        <h4>IRAQ PREMIER LEAGUE</h4>
                        <h4>Matchday 29</h4>
                        <div class="one_fix">
                            <i class="fa-solid fa-calendar-days"></i>
                            <p>Friday, Mar 15, 6:00 PM h</p>
                        </div>

                        <div class="two_fix">
                            <i class="fa-solid fa-location-dot"></i>
                            <p>Zakho</p>
                        </div>
                        <div class="btn">
                            <i class="fa-solid fa-circle-info"></i>
                            <p>More</p>
                        </div>
                    </div>

                </div>


            </div>
            <!--  -->

            <div class="swiper-slide">
                <div class="card_fixture">
                    <div class="header_fixture">
                        <div class="club">
                            <img src="{{ asset('frontend/assets/images/Zakho_FC_logo.png')}}" alt="">
                            <p>ZAKHO</p>
                        </div>
                        <h1>VS</h1>
                        <div class="club">
                            <img src="{{ asset('frontend/assets/images/Nowruz_SC_logo.png')}}" alt="">

                            <p>NEWROZ</p>
                        </div>
                    </div>
                    <div class="footer_fixture">
                        <p>Football - premier league</p>
                        <h4>IRAQ PREMIER LEAGUE</h4>
                        <h4>Matchday 29</h4>
                        <div class="one_fix">
                            <i class="fa-solid fa-calendar-days"></i>
                            <p>Friday, Mar 15, 6:00 PM h</p>
                        </div>

                        <div class="two_fix">
                            <i class="fa-solid fa-location-dot"></i>
                            <p>Zakho</p>
                        </div>
                        <div class="btn">
                            <i class="fa-solid fa-circle-info"></i>
                            <p>More</p>
                        </div>
                    </div>

                </div>


            </div>
            <!--  -->



        </div>
        <div class="fix_zakho">
            <div class="swiper-pagination"></div>
        </div>
    </div>
</div>
<!-- -------------------------------------------------- -->


<!-- reklam -->
<div class="reklamvip">
    @forelse ($reklams as $reklam )
        @if ($loop->index == 0)
            <a href="{{ $reklam->url }}"><img src="{{ !empty($reklam->image) ? asset($reklam->image) : 'https://via.placeholder.com/970x250'}}" alt="{{ $reklam->title }} Image"></a>
        @endif
    @empty
        <img src="https://via.placeholder.com/970x250" alt="Reklam Image">
    @endforelse
</div>




<!--------------------------------- ----------------- -->
<div class="for_old_news">
    <!-- Swiper -->
    <div class="swiper mySwiper">
      <div class="swiper-wrapper">
        @foreach ($news as $new )
        @if ($loop->index <= 6)
        <div class="swiper-slide">
            <div class="card">
                <div class="card-img-holder">
                    <img src="{{ !empty($new->image) ? asset($new->image) : 'https://via.placeholder.com'}}" alt="">
                </div>
                <h3 class="blog-title">

                    @if (@session('lang') == 'ar')
                        {{ $new->title_ar }}
                    @elseif (@session('lang') == 'ku')
                        {{ $new->title_ku }}
                    @elseif (@session('lang') == 'ckb')
                        {{ $new->title_ckb }}
                    @else
                        {{ $new->title_en }}
                    @endif
                 </h3>
                <div class="options">
                    <span class="blog-time">{{ $new-> posted_time }}</span>
                    <button class="btnn btnbtn"> More</button>
                </div>
            </div>
        </div>
        @endif
        <!--  -->
        @endforeach
      </div>

    </div>

    <div class="swiper mySwiper">
      <div class="swiper-wrapper">
        @foreach ($news as $new )
        @if ($loop->index > 6)
        <div class="swiper-slide">
            <div class="card">
                <div class="card-img-holder">
                    <img src="{{ !empty($new->image) ? asset($new->image) : 'https://via.placeholder.com'}}" alt="">
                </div>
                <h3 class="blog-title"> {{ $new->title_en }} </h3>
                <div class="options">
                    <span class="blog-time">{{ $new-> posted_time }}</span>
                    <button class="btnn btnbtn"> More</button>
                </div>
            </div>
        </div>
        @endif
        <!--  -->
        @endforeach
      </div>

    </div>
  </div>
<!-- show news -->
<!-- -------- -->
<div class="all-fixture-news show-news">
    <div class="header-fixture">
        <div class="left">
            <a href="" class="arrow-news"><i class="fa-solid fa-arrow-left"></i></a>
            <h2>Messi Don’t want to waste time in Miami and come back
            </h2>
            <div class="share">
                <a href=""><i class="fa-solid fa-share"></i> Share</a>
            </div>
        </div>
        <div class="right">
            <img src="https://via.placeholder.com" alt="">
            <p>26 January 2023</p>
        </div>
    </div>
    <div class="text">
        <div class="show-text">
            <div class="forimage">
                <div class="swiper mySwiper">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide"><img src="{{ asset('frontend/assets/images/one.jpeg')}}" alt=""></div>
                        <div class="swiper-slide"><img src="{{ asset('frontend/assets/images/one.jpeg')}}" alt=""></div>
                        <div class="swiper-slide"><img src="{{ asset('frontend/assets/images/one.jpeg')}}" alt=""></div>
                        <div class="swiper-slide"><img src="{{ asset('frontend/assets/images/one.jpeg')}}" alt=""></div>
                    </div>
                    <div class="showforimage">

                    </div>
                    <div class="swiper-pagination"></div>
                </div>

            </div>
            <p class="document">
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed ut purus eget sapien
                tincidunt aliquam
            </p>
        </div>
    </div>

    <button class="close"><i class="fa-solid fa-xmark"></i></button>
</div>

<!-- -------- -->

<!-- ------------------------------------------- -->
<section id="tranding">
    <div class="container con_header">
        <h3 class="text-center section-subheading">- Players -</h3>
        <h1 class="text-center section-heading"><a href="">All Players 33</a></h1>
    </div>
    <div class="arrow_right_players">
        <span></span>
        <span></span>
        <span></span>
    </div>

    <div class="container">
        <div class="swiper tranding-slider">
            <div class="swiper-wrapper">
                <!-- Slide-start -->
                <div class="swiper-slide tranding-slide">
                    <div class="tranding-slide-img">
                        <img src="{{ asset('frontend/assets/images/amjad_photo-removebg-preview.png')}}" alt="Tranding">
                    </div>
                    <div class="tranding-slide-content">
                        <h1 class="player_number">30</h1>
                        <div class="tranding-slide-content-bottom">
                            <p class="pos">Striker</p>
                            <h2 class="player-name">
                                Amjad Attwan
                            </h2>
                            <div class="skiils">
                                <div class="one">
                                    <p>14</p>
                                    <p class="MG">matches</p>
                                </div>
                                <div class="one">
                                    <p>3</p>
                                    <p class="MG">Goals</p>
                                </div>
                                <div class="one">
                                    <p>6</p>
                                    <p class="MG">Assists</p>
                                </div>
                            </div>
                            <button> More Details</button>
                        </div>
                    </div>

                </div>
                <!-- Slide-end -->


                <!-- Slide-start -->
                <div class="swiper-slide tranding-slide">
                    <div class="tranding-slide-img">
                        <img src="{{ asset('frontend/assets/images/Remove-bg.ai_1710457700546.png')}}" alt="Tranding">
                    </div>
                    <div class="tranding-slide-content">
                        <h1 class="player_number">6</h1>
                        <div class="tranding-slide-content-bottom">
                            <p class="pos">Deffender</p>
                            <h2 class="player-name">
                                Sipan Sadiq
                            </h2>
                            <div class="skiils">
                                <div class="one">
                                    <p>14</p>
                                    <p class="MG">matches</p>
                                </div>
                                <div class="one">
                                    <p>3</p>
                                    <p class="MG">Goals</p>
                                </div>
                                <div class="one">
                                    <p>6</p>
                                    <p class="MG">Assists</p>
                                </div>
                            </div>
                            <button> More Details</button>
                        </div>
                    </div>

                </div>
                <!-- Slide-end -->



                <!-- Slide-start -->
                <div class="swiper-slide tranding-slide">
                    <div class="tranding-slide-img">
                        <img src="{{ asset('frontend/assets/images/Remove-bg.ai_1710456628702.png')}}" alt="Tranding">
                    </div>
                    <div class="tranding-slide-content">
                        <h1 class="player_number">3</h1>
                        <div class="tranding-slide-content-bottom">
                            <p class="pos">Striker</p>
                            <h2 class="player-name">
                                Patrick Marcelino
                            </h2>
                            <div class="skiils">
                                <div class="one">
                                    <p>27</p>
                                    <p class="MG">matches</p>
                                </div>
                                <div class="one">
                                    <p>4</p>
                                    <p class="MG">Goals</p>
                                </div>
                                <div class="one">
                                    <p>0</p>
                                    <p class="MG">Assists</p>
                                </div>
                            </div>
                            <button> More Details</button>
                        </div>
                    </div>
                </div>
                <!-- Slide-end -->
                <!-- Slide-start -->
                <!-------------------- FOR GOOAL KEEPER--------------- -->
                <div class="swiper-slide tranding-slide">
                    <div class="tranding-slide-img">
                        <img src="{{ asset('frontend/assets/images/Remove-bg.ai_1710457146825.png')}}" alt="Tranding">
                    </div>
                    <div class="tranding-slide-content">
                        <h1 class="player_number">12</h1>
                        <div class="tranding-slide-content-bottom">
                            <p class="pos">Goal Keeper</p>
                            <h2 class="player-name">
                                Ali Kadhim
                            </h2>
                            <div class="skiils">
                                <div class="one">
                                    <p>27</p>
                                    <p class="MG">matches</p>
                                </div>
                                <div class="one">
                                    <p>14</p>
                                    <p class="MG">SAVES</p>
                                </div>
                                <div class="one">
                                    <p>0</p>
                                    <p class="MG">Assists</p>
                                </div>
                            </div>
                            <button> More Details</button>
                        </div>
                    </div>
                </div>
                <!-- Slide-end -->






            </div>

            <div class="tranding-slider-control">
                <div class="swiper-button-prev slider-arrow">
                    <ion-icon name="arrow-back-outline"></ion-icon>
                </div>
                <div class="swiper-button-next slider-arrow">
                    <ion-icon name="arrow-forward-outline"></ion-icon>
                </div>
                <div class="swiper-pagination"></div>
            </div>
        </div>
    </div>
</section>
<!-- ---------------------------------- -->

<!-- -------------------------------------------------- -->
<!-- reklam -->
<div class="reklamvip">
    @forelse ($reklams as $reklam )
        @if ($loop->index == 1)
            <a href="{{ $reklam->url }}"><img src="{{ !empty($reklam->image) ? asset($reklam->image) : 'https://via.placeholder.com/970x250'}}" alt="{{ $reklam->title }} Image"></a>
        @endif
    @empty
        <img src="https://via.placeholder.com/970x250" alt="Reklam Image">
    @endforelse
</div>
<!--------------------------------- ----------------- -->

<!-- sponsors  Swiper -->
<div class="sponsors">
    <div class="our_sponsors">
        <h2>Our Sponsors</h2>
    </div>
    <div class="sponsor">
        @forelse ($sponsors as $sponsor)
            <div class="slide">
                <a href="{{ $sponsor->link }}"><img src="{{ !empty($sponsor->logo) ? asset($sponsor->logo) : 'https://via.placeholder.com/200x200'}}" alt="{{ $sponsor->title }} Image"></a>
                <h3>{{ $sponsor->title }}</h3>
            </div>
        @empty
            <div class="slide">
                <a href="#"><img src="https://via.placeholder.com/200x200" alt="Sponsor Image"></a>
                <h3>Sponsor Name</h3>
            </div>
        @endforelse

    </div>
</div>
@endsection
