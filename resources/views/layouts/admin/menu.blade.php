<div class="main-menu menu-fixed menu-dark menu-bg-default rounded menu-accordion menu-shadow">
      <div class="main-menu-content"><a class="navigation-brand d-none d-md-block d-lg-block d-xl-block" href="{{url('/dashboard')}}"><img class="brand-logo" alt="CryptoDash admin logo" src="{{asset('admin-assets/images/logo/logo.png')}}"/></a>
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
          <li class="nav-item {{Request()->route()->getName() == 'dashboard' ? 'active':''}}"><a href="{{url('/dashboard')}}"><i class="icon-grid"></i><span class="menu-title" data-i18n="">Dashboard</span></a>
          </li>
            <li class="nav-item {{Request()->route()->getName() == 'users.index' ? 'active':''}}"><a href="{{route('users.index')}}"><i class="icon-user-following"></i><span class="menu-title" data-i18n="">Customers</span></a>
            </li>
         {{-- <li class=" nav-item"><a href="buy-ico.html"><i class="icon-layers"></i><span class="menu-title" data-i18n="">Buy ICO</span></a>
          </li>--}}
          <li class=" nav-item {{Request()->route()->getName() == 'wallet' ? 'active':''}} "><a href="{{route('wallet')}}"><i class="icon-wallet"></i><span class="menu-title" data-i18n="">Wallet</span></a>
          </li>
          <li class=" nav-item {{Request()->route()->getName() == 'trades' ? 'active':''}}"><a href="{{route('trades')}}"><i class="icon-shuffle"></i><span class="menu-title" data-i18n="">Trades</span></a>
          </li>
          <li class=" nav-item {{Request()->route()->getName() == 'list_trade_rates' ? 'active':''}}"><a href="{{route('list_trade_rates')}}"><i class="icon-shuffle"></i><span class="menu-title" data-i18n="">Trade Rates</span></a>
          </li>
{{--          <li class=" nav-item"><a href="faq.html"><i class="icon-support"></i><span class="menu-title" data-i18n="">FAQ</span></a>--}}
{{--          </li>--}}
          {{--<li class=" nav-item"><a href="#"><i class="icon-user-following"></i><span class="menu-title" data-i18n="">Account</span></a>
            <ul class="menu-content">
              <li><a class="menu-item" href="account-profile.html">Profile</a>
              </li>
              <li><a class="menu-item" href="account-login-history.html">Login History</a>
              </li>
              <li class="navigation-divider"></li>
              <li><a class="menu-item" href="#">Misc</a>
                <ul class="menu-content">
                  <li><a class="menu-item" href="account-login.html">Login</a>
                  </li>
                  <li><a class="menu-item" href="account-register.html">Register</a>
                  </li>
                </ul>
              </li>
            </ul>
          </li>--}}
        </ul>
      </div>
    </div>
