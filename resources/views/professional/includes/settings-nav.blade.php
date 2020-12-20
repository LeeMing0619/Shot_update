<div class="candidate-info onepage">
  <ul>
    @if(Auth::user()->account_type == "professional")
      <li><a href="{{ route('settings.index') }}" class="@if(URL::full() == 'http://127.0.0.1:8000/settings') active @endif"><i class="fa fa-info"></i> Account Infomation</a></li>
      <li><a href="" class="@if(URL::full() == 'http://127.0.0.1:8000/change-password') active @endif"><i class="fa fa-unlock-alt"></i> Change password</a></li>
      <li><a href="{{ route('package.index') }}" class="@if(URL::full() == 'http://127.0.0.1:8000/package') active @endif"><i class="fa fa-archive"></i> Create new package</a></li>
      <li><a href="{{ route('schedule.index') }}" class="@if(URL::full() == 'http://127.0.0.1:8000/schedule') active @endif"><i class="fa fa-calendar"></i> Business schedule</a></li>
    @else
      <li><a href="{{ route('settings.index') }}" class="@if(URL::full() == 'http://127.0.0.1:8000/settings') active @endif"><i class="fa fa-info"></i> Account Infomation</a></li>
      <li><a href="" class="@if(URL::full() == 'http://127.0.0.1:8000/change-password') active @endif"><i class="fa fa-unlock-alt"></i> Change password</a></li>
    @endif
  </ul>
</div>
