<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
      <a href="index.html" class="app-brand-link">
        <img src="{{ asset('backend/assets/img/logo-zakhoo.png') }}" width="50" height="30" style="object-fit: contain" alt="zakhoo logo">

        <span class="app-brand-text demo menu-text fw-bold">Zakhoo FC</span>
      </a>

      <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
        <i class="ti menu-toggle-icon d-none d-xl-block ti-sm align-middle"></i>
        <i class="ti ti-x d-block d-xl-none ti-sm align-middle"></i>
      </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">

      <!-- Dashboards -->
      <li class="menu-item {{ Route::currentRouteName() == 'dashboard' ? 'active':''}}" >
        <a href="{{ route('dashboard') }}" class="menu-link">
          <i class="menu-icon tf-icons ti ti-smart-home"></i>
          <div data-i18n="Dashboards">Dashboards</div>
        </a>
      </li>

      {{-- User --}}
      <li class="menu-item {{ in_array(Route::currentRouteName(),['list.user','add.user','recycle.user','list.role','add.role'])?'active open':'' }}">
        <a href="javascript:void(0);" class="menu-link menu-toggle">
          <i class="menu-icon tf-icons ti ti-users"></i>
          <div data-i18n="Users">Users</div>
        </a>
        <ul class="menu-sub">
            <li class="menu-item {{ Route::currentRouteName()=='list.user' ? 'active':''}}">
              <a href="{{ route('list.user') }}" class="menu-link">
                  <div data-i18n="List of Users">List of Users</div>
              </a>
            </li>
          <li class="menu-item {{ Route::currentRouteName()=='add.user' ? 'active':''}}">
            <a href="{{ route('add.user') }}" class="menu-link">
              <div data-i18n="Add New User">Add New User</div>
            </a>
          </li>

          <li class="menu-item {{ Route::currentRouteName() == 'recycle.user' ? 'active':''}}">
            <a href="{{ route('recycle.user') }}" class="menu-link">
              <div data-i18n="Recycle User">Recycle User</div>
            </a>
          </li>


      {{-- User Role --}}
      <li class="menu-item {{ in_array(Route::currentRouteName(),['list.role','add.role'])?'active open':'' }}">
        <a href="javascript:void(0);" class="menu-link menu-toggle">
          <i class="menu-icon tf-icons ti ti-user-star"></i>
          <div data-i18n="User Role">User Role</div>
        </a>
        <ul class="menu-sub">
        <li class="menu-item {{ Route::currentRouteName() == 'list.role' ? 'active':''}}" >
            <a href="{{ route('list.role') }}" class="menu-link">
                <div data-i18n="List of Roles">List of Roles</div>
            </a>
          </li>
         <li class="menu-item {{ Route::currentRouteName() == 'add.role' ? 'active':''}}" >
            <a href="{{ route('add.role') }}" class="menu-link">
              <div data-i18n="Add New Role">Add New Role</div>
            </a>
          </li>
        </ul>
      </li>
        </ul>
      </li>



      {{-- Sponsor --}}
      <li class="menu-item {{ in_array(Route::currentRouteName(),['list.sponsor','add.sponsor','recycle.sponsor'])?'active open':'' }}">
        <a href="javascript:void(0);" class="menu-link menu-toggle">
          <i class="menu-icon tf-icons ti ti-social"></i>
          <div data-i18n="Sponsors">Sponsors</div>
        </a>
        <ul class="menu-sub">
            <li class="menu-item  {{ Route::currentRouteName() == 'list.sponsor' ? 'active':''}}">
              <a href="{{ route('list.sponsor') }}" class="menu-link">
                  <div data-i18n="List of Sponsors">List of Sponsors</div>
              </a>
            </li>

          <li class="menu-item  {{ Route::currentRouteName() == 'add.sponsor' ? 'active':''}}">
            <a href="{{ route('add.sponsor') }}" class="menu-link">
              <div data-i18n="Add New Sponsor">Add New Sponsor</div>
            </a>
          </li>

          <li class="menu-item  {{ Route::currentRouteName() == 'recycle.sponsor' ? 'active':''}}">
            <a href="{{ route('recycle.sponsor') }}" class="menu-link">
              <div data-i18n="Recycle Sponsor">Recycle Sponsor</div>
            </a>
          </li>

        </ul>
      </li>


      {{-- reklam --}}
      <li class="menu-item {{ in_array(Route::currentRouteName(),['list.reklam','add.reklam','recycle.reklam'])?'active open':'' }}">
        <a href="javascript:void(0);" class="menu-link menu-toggle">
          <i class="menu-icon tf-icons ti ti-ad"></i>
          <div data-i18n="Reklams">Reklams</div>
        </a>
        <ul class="menu-sub">
            <li class="menu-item  {{ Route::currentRouteName() == 'list.reklam' ? 'active':''}}">
              <a href="{{ route('list.reklam') }}" class="menu-link">
                  <div data-i18n="List of Reklams">List of Reklams</div>
              </a>
            </li>

          <li class="menu-item  {{ Route::currentRouteName() == 'add.reklam' ? 'active':''}}">
            <a href="{{ route('add.reklam') }}" class="menu-link">
              <div data-i18n="Add New Reklam">Add New Reklam</div>
            </a>
          </li>

          <li class="menu-item  {{ Route::currentRouteName() == 'recycle.reklam' ? 'active':''}}">
            <a href="{{ route('recycle.reklam') }}" class="menu-link">
              <div data-i18n="Recycle Reklam">Recycle Reklam</div>
            </a>
          </li>

        </ul>
      </li>

      {{-- news --}}
      <li class="menu-item {{ in_array(Route::currentRouteName(),['list.news','add.news','recycle.news'])?'active open':'' }}">
        <a href="javascript:void(0);" class="menu-link menu-toggle">
          <i class="menu-icon tf-icons ti ti-news"></i>
          <div data-i18n="News">News</div>
        </a>
        <ul class="menu-sub">
            <li class="menu-item  {{ Route::currentRouteName() == 'list.news' ? 'active':''}}">
              <a href="{{ route('list.news') }}" class="menu-link">
                  <div data-i18n="List of News">List of News</div>
              </a>
            </li>

          <li class="menu-item  {{ Route::currentRouteName() == 'add.news' ? 'active':''}}">
            <a href="{{ route('add.news') }}" class="menu-link">
              <div data-i18n="Add New News">Add New News</div>
            </a>
          </li>

          <li class="menu-item  {{ Route::currentRouteName() == 'recycle.news' ? 'active':''}}">
            <a href="{{ route('recycle.news') }}" class="menu-link">
              <div data-i18n="Recycle News">Recycle News</div>
            </a>
          </li>

        </ul>
      </li>

      {{-- Players --}}
      <li class="menu-item {{ in_array(Route::currentRouteName(),['list.player','add.player','recycle.player'])?'active open':'' }}">
        <a href="javascript:void(0);" class="menu-link menu-toggle">
          <i class="menu-icon tf-icons ti ti-play-football"></i>
          <div data-i18n="Player">Player</div>
        </a>
        <ul class="menu-sub">
            <li class="menu-item  {{ Route::currentRouteName() == 'list.player' ? 'active':''}}">
              <a href="{{ route('list.player') }}" class="menu-link">
                  <div data-i18n="List of Player">List of Player</div>
              </a>
            </li>

          <li class="menu-item  {{ Route::currentRouteName() == 'add.player' ? 'active':''}}">
            <a href="{{ route('add.player') }}" class="menu-link">
              <div data-i18n="Add New Player">Add New Player</div>
            </a>
          </li>

          <li class="menu-item  {{ Route::currentRouteName() == 'recycle.player' ? 'active':''}}">
            <a href="{{ route('recycle.player') }}" class="menu-link">
              <div data-i18n="Recycle Player">Recycle Player</div>
            </a>
          </li>

        </ul>
      </li>
      {{-- Poll --}}
      <li class="menu-item {{ in_array(Route::currentRouteName(),['list.poll','add.poll','recycle.poll','list.poll.category','add.poll.category','recycle.poll.category'])?'active open':'' }}">
        <a href="javascript:void(0);" class="menu-link menu-toggle">
          <i class="menu-icon tf-icons ti ti-chart-bar"></i>
          <div data-i18n="Poll">Poll</div>
        </a>
        <ul class="menu-sub">
            <li class="menu-item  {{ Route::currentRouteName() == 'list.poll' ? 'active':''}}">
              <a href="{{ route('list.poll') }}" class="menu-link">
                  <div data-i18n="List of Poll">List of Poll</div>
              </a>
            </li>

          <li class="menu-item  {{ Route::currentRouteName() == 'add.poll' ? 'active':''}}">
            <a href="{{ route('add.poll') }}" class="menu-link">
              <div data-i18n="Add New Poll">Add New Poll</div>
            </a>
          </li>

          <li class="menu-item  {{ Route::currentRouteName() == 'recycle.poll' ? 'active':''}}">
            <a href="{{ route('recycle.poll') }}" class="menu-link">
              <div data-i18n="Recycle Poll">Recycle Poll</div>
            </a>
          </li>

          {{-- Poll Category --}}
          <li class="menu-item {{ in_array(Route::currentRouteName(),['list.poll.category','add.poll.category','recycle.poll.category'])?'active open':'' }}">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
              <i class="menu-icon tf-icons ti ti-chart-bar"></i>
              <div data-i18n="Poll Category">Poll Category</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item  {{ Route::currentRouteName() == 'list.poll.category' ? 'active':''}}">
                  <a href="{{ route('list.poll.category') }}" class="menu-link">
                      <div data-i18n="List of Poll Category">List of Poll Category</div>
                  </a>
                </li>

              <li class="menu-item  {{ Route::currentRouteName() == 'add.poll.category' ? 'active':''}}">
                <a href="{{ route('add.poll.category') }}" class="menu-link">
                  <div data-i18n="Add New Poll Category">Add New Poll Category</div>
                </a>
              </li>

              <li class="menu-item  {{ Route::currentRouteName() == 'recycle.poll.category' ? 'active':''}}">
                <a href="{{ route('recycle.poll.category') }}" class="menu-link">
                  <div data-i18n="Recycle Poll Category">Recycle Poll Category</div>
                </a>
              </li>
            </ul>
          </li>

        </ul>
      </li>

      {{-- Team --}}
      <li class="menu-item {{ Route::currentRouteName() == 'detail.team' ? 'active':''}}" >
        <a href="{{ route('detail.team') }}" class="menu-link">
          <i class="menu-icon tf-icons ti ti-smart-home"></i>
          <div data-i18n="Team">Team</div>
        </a>
      </li>


    </ul>
  </aside>
