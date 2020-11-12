<!-- APP ASIDE ==========-->
<aside id="menubar" class="menubar light">
  <div class="app-user">
    <div class="media">
      <div class="media-left">
        <div class="avatar avatar-md avatar-circle">
          <a href="javascript:void(0)">
            @php
              $profile_url = "";
              if(!empty(Auth::user()->profile_img))
              {
                $profile_url = url('/img').'/'.Auth::user()->profile_img;
              }
            @endphp
            <img class="img-responsive" src="{{ (!empty(Auth::user()->profile_img)) ? $profile_url : asset('/bower_components/infinity_admin/assets/images/default-avatar.png') }}" alt="avatar"/>
          </a>
        </div><!-- .avatar -->
      </div>
      <div class="media-body">
        <div class="foldable">
          <h5><a href="javascript:void(0)" class="username">
            @if(strlen(Auth::user()->name)>12)
              {{ substr(Auth::user()->name,0,12).'...' }}
            @else
              {{ Auth::user()->name }}
            @endif
          </a></h5>
          <ul>
            <li class="dropdown">
              <a href="javascript:void(0)" class="dropdown-toggle usertitle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <small>{{ (Auth::user()->user_role == config('params.user_role.admin')) ? trans('string.admin') : trans('string.user') }}</small>
                <span class="caret"></span>
              </a>
              <ul class="dropdown-menu animated flipInY">
                <li>
                  <a class="text-color" href="{{ route('home') }}">
                    <span class="m-r-xs"><i class="fa fa-home"></i></span>
                    <span>{{ trans('string.home') }}</span>
                  </a>
                </li>
                <li>
                  <a class="text-color" href="{{ route('admin.editProfile') }}">
                    <span class="m-r-xs"><i class="fa fa-user"></i></span>
                    <span>{{ trans('string.profile') }}</span>
                  </a>
                </li>
                <li>
                  <a class="text-color" href="{{ route('admin.editPassword') }}">
                    <span class="m-r-xs"><i class="fa fa-gear"></i></span>
                    <span>{{ trans('string.change_password') }}</span>
                  </a>
                </li>
                <li role="separator" class="divider"></li>
                <li>
                  <a class="text-color" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
					<span class="m-r-xs"><i class="fa fa-power-off"></i></span>
					<span>{{ trans('string.signout') }}</span>
				  </a>
				  <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
					{{ csrf_field() }}
				  </form>
                </li>
              </ul>
            </li>
          </ul>
        </div>
      </div><!-- .media-body -->
    </div><!-- .media -->
  </div><!-- .app-user -->

  <div class="menubar-scroll">
    <div class="menubar-scroll-inner">
      <ul class="app-menu">
		  <li class="{{ activeMenu('dashboard') }}">
          <a href="{{ route('home') }}">
            <i class="menu-icon zmdi zmdi-view-dashboard zmdi-hc-lg"></i>
            <span class="menu-text">{{ trans('string.dashboard') }}</span>
          </a>
        </li>
		
		<li class="{{ activeMenu('users') }}">
          <a href="{{ route('users.index') }}">
            <i class="menu-icon zmdi zmdi-account zmdi-hc-lg"></i>
            <span class="menu-text">{{ trans('string.users') }}</span>
          </a>
        </li>
		
		<li class="{{ activeMenu('cms') }}">
          <a href="{{ route('cms.index') }}">
            <i class="menu-icon zmdi zmdi-file-text zmdi-hc-lg"></i>
            <span class="menu-text">{{ trans('string.cms') }}</span>
          </a>
        </li>

    <li class="{{ activeMenu('version') }}">
          <a href="{{ route('version.index') }}">
            <i class="menu-icon zmdi zmdi-settings zmdi-hc-lg"></i>
            <span class="menu-text">{{ trans('string.version') }}</span>
          </a>
        </li>
        
<!--        <li class="has-submenu">
          <a href="javascript:void(0)" class="submenu-toggle">
            <i class="menu-icon zmdi zmdi-layers zmdi-hc-lg"></i>
            <span class="menu-text">Layouts</span>
            <span class="label label-warning menu-label">2</span>
            <i class="menu-caret zmdi zmdi-hc-sm zmdi-chevron-right"></i>
          </a>
          <ul class="submenu">
            <li><a href="../default/index.html"><span class="menu-text">Default</span></a></li>
            <li><a href="../topbar/index.html"><span class="menu-text">Topbar</span></a></li>
          </ul>
        </li>

        <li class="has-submenu">
          <a href="javascript:void(0)" class="submenu-toggle">
            <i class="menu-icon zmdi zmdi-puzzle-piece zmdi-hc-lg"></i>
            <span class="menu-text">UI Kit</span>
            <i class="menu-caret zmdi zmdi-hc-sm zmdi-chevron-right"></i>
          </a>
          <ul class="submenu">
            <li><a href="buttons.html"><span class="menu-text">Buttons</span></a></li>
            <li><a href="alerts.html"><span class="menu-text">Alerts</span></a></li>
            <li><a href="panels.html"><span class="menu-text">Panels</span></a></li>
            <li><a href="lists.html"><span class="menu-text">Lists</span></a></li>
            <li><a href="icons.html"><span class="menu-text">Icons</span></a></li>
            <li><a href="media.html"><span class="menu-text">Media</span></a></li>
            <li><a href="widgets.html"><span class="menu-text">Widgets</span></a></li>
            <li><a href="tabs.html"><span class="menu-text">Tabs &amp; Accordions</span></a></li>
            <li><a href="progress.html"><span class="menu-text">Progress</span></a></li>
          </ul>
        </li>

        <li class="has-submenu">
          <a href="javascript:void(0)" class="submenu-toggle">
            <i class="menu-icon zmdi zmdi-inbox zmdi-hc-lg"></i>
            <span class="menu-text">Mail Box</span>
            <i class="menu-caret zmdi zmdi-hc-sm zmdi-chevron-right"></i>
          </a>
          <ul class="submenu">
            <li>
              <a href="inbox.html">
                <span class="menu-text">Inbox</span>
                <span class="label label-primary menu-label">12</span>
              </a>
            </li>
            <li><a href="compose.html"><span class="menu-text">Compose</span></a></li>
          </ul>
        </li>
        
        <li>
          <a href="search.web.html">
            <i class="menu-icon zmdi zmdi-search zmdi-hc-lg"></i>
            <span class="menu-text">Search</span>
          </a>
        </li>

        <li class="has-submenu">
          <a href="javascript:void(0)" class="submenu-toggle">
            <i class="menu-icon zmdi zmdi-pages zmdi-hc-lg"></i>
            <span class="menu-text">Pages</span>
            <i class="menu-caret zmdi zmdi-hc-sm zmdi-chevron-right"></i>
          </a>
          <ul class="submenu">
            <li><a href="profile.html"><span class="menu-text">Profile</span></a></li>
            <li><a href="price.html"><span class="menu-text">Prices</span></a></li>
            <li><a href="invoice.html"><span class="menu-text">Invoice</span></a></li>
            <li><a href="gallery.1.html"><span class="menu-text">Gallery</span></a></li>
            <li><a href="gallery.2.html"><span class="menu-text">Gallery 2</span></a></li>
            <li><a href="support.html"><span class="menu-text">FAQ</span></a></li>
            <li class="has-submenu">
              <a href="javascript:void(0)" class="submenu-toggle">
                <i class="menu-icon zmdi zmdi-plus zmdi-hc-lg"></i>
                <span class="menu-text">Misc Pages</span>
                <i class="menu-caret zmdi zmdi-hc-sm zmdi-chevron-right"></i>
              </a>
              <ul class="submenu">
                <li><a href="login.html"><span class="menu-text">Login</span></a></li>
                <li><a href="signup.html"><span class="menu-text">Sign Up</span></a></li>
                <li><a href="password-forget.html"><span class="menu-text">Reset Password</span></a></li>
                <li><a href="unlock.html"><span class="menu-text">Unlock Screen</span></a></li>
                <li><a href="404.html"><span class="menu-text">404 Error</span></a></li>
              </ul>
            </li>
          </ul>
        </li>

        <li class="has-submenu">
          <a href="javascript:void(0)" class="submenu-toggle">
            <i class="menu-icon zmdi zmdi-check zmdi-hc-lg"></i>
            <span class="menu-text">Forms</span>
            <i class="menu-caret zmdi zmdi-hc-sm zmdi-chevron-right"></i>
          </a>
          <ul class="submenu">
            <li><a href="form.layouts.html"><span class="menu-text">Form Layouts</span></a></li>
            <li><a href="form.elements.html"><span class="menu-text">Form Elements</span></a></li>
            <li><a href="form.custom.html"><span class="menu-text">Customized Elements</span></a></li>
            <li><a href="form.plugins.html"><span class="menu-text">Form Plugins</span></a></li>
            <li><a href="file-upload.html"><span class="menu-text">File Upload</span></a></li>
            <li><a href="form.datetime.html"><span class="menu-text">DateTime Pickers</span></a></li>
            <li><a href="editors.html"><span class="menu-text">Editors</span></a></li>
          </ul>
        </li>

        <li class="has-submenu">
          <a href="javascript:void(0)" class="submenu-toggle">
            <i class="menu-icon zmdi zmdi-storage zmdi-hc-lg"></i>
            <span class="menu-text">Tables</span>
            <i class="menu-caret zmdi zmdi-hc-sm zmdi-chevron-right"></i>
          </a>
          <ul class="submenu">
            <li><a href="tables.basic.html"><span class="menu-text">Basic Tables</span></a></li>
            <li><a href="datatables.html"><span class="menu-text">DataTables</span></a></li>
          </ul>
        </li>

        <li class="has-submenu">
          <a href="javascript:void(0)" class="submenu-toggle">
            <i class="menu-icon zmdi zmdi-chart zmdi-hc-lg"></i>
            <span class="menu-text">Charts</span>
            <span class="label label-success menu-label">7</span>
            <i class="menu-caret zmdi zmdi-hc-sm zmdi-chevron-right"></i>
          </a>
          <ul class="submenu">
            <li><a href="charts.flot.html"><span class="menu-text">Flot Charts</span></a></li>
            <li><a href="echarts.bar.html"><span class="menu-text">Bar echarts</span></a></li>
            <li><a href="echarts.pie.html"><span class="menu-text">Pie echarts</span></a></li>
            <li><a href="echarts.line.html"><span class="menu-text">Line echarts</span></a></li>
            <li><a href="echarts.map.html"><span class="menu-text">Map echarts</span></a></li>
            <li><a href="echarts.scatter.html"><span class="menu-text">Scatter echarts</span></a></li>
            <li><a href="echarts.custom.html"><span class="menu-text">Custom echarts</span></a></li>
          </ul>
        </li>

        <li class="has-submenu">
          <a href="javascript:void(0)" class="submenu-toggle">
            <i class="menu-icon zmdi zmdi-pin zmdi-hc-lg"></i>
            <span class="menu-text">Maps</span>
            <i class="menu-caret zmdi zmdi-hc-sm zmdi-chevron-right"></i>
          </a>
          <ul class="submenu">
            <li><a href="map-google.html"><span class="menu-text">Google Maps</span></a></li>
            <li><a href="map-vector.html"><span class="menu-text">Vector Maps</span></a></li>
          </ul>
        </li>

        <li class="has-submenu">
          <a href="javascript:void(0)" class="submenu-toggle">
            <i class="menu-icon zmdi zmdi-apps zmdi-hc-lg"></i>
            <span class="menu-text">Apps</span>
            <span class="label label-info menu-label">2</span>
            <i class="menu-caret zmdi zmdi-hc-sm zmdi-chevron-right"></i>
          </a>
          <ul class="submenu">
            <li><a href="calendar.html"><span class="menu-text">Calendar</span></a></li>
            <li><a href="contacts.html"><span class="menu-text">Contacts</span></a></li>
          </ul>
        </li>

        <li class="menu-separator"><hr></li>

        <li>
          <a href="documentation.html">
            <i class="menu-icon zmdi zmdi-file-text zmdi-hc-lg"></i>
            <span class="menu-text">Documentation</span>
          </a>
        </li>

        <li>
          <a href="javascript:void(0)">
            <i class="menu-icon zmdi zmdi-settings zmdi-hc-lg"></i>
            <span class="menu-text">Settings</span>
          </a>
        </li>
        
        <li>
          <a href="javascript:void(0)">
            <i class="menu-icon zmdi zmdi-language-javascript zmdi-hc-lg"></i>
            <span class="menu-text">Angular Version</span>
          </a>
        </li>-->
      </ul><!-- .app-menu -->
    </div><!-- .menubar-scroll-inner -->
  </div><!-- .menubar-scroll -->
</aside>
<!--========== END app aside -->