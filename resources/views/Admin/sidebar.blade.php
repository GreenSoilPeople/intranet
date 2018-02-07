<div class="col-sm-3 col-md-2 col-lg-2 sidebar">
  <ul class="nav nav-sidebar">
    <li class="{{ (request()->is('list*') && request('active') == null) ? 'active' : ''}}">
      <a href="/list">Angajati <span class="badge">{{\App\Employee::count()}}</span></a>
      <ul class="nav">
        <li class="{{ (request()->is('list') && request('active') == '1') ? 'active' : ''}}"><a href="/list?active=1">Activi <span class="badge">{{\App\Employee::Active()->count()}}</span></a></li>
        <li class="{{ (request()->is('list') && request('active') == '0') ? 'active' : ''}}"><a href="/list?active=0">Inactivi <span class="badge">{{\App\Employee::Inactive()->count()}}</span></a></li>
        <li class="{{ (request()->is('create')) ? 'active' : ''}}"><a href="/create">Angajat Nou</a></li>
      </ul>
    </li>
    
  </ul>
  <ul class="nav nav-sidebar">
    <li class="{{ (request()->is('department')) ? 'active' : ''}}"><a href="/department">Departamente</a></li>
  </ul>
  {{-- <ul class="nav nav-sidebar">
    <li><a href="/photo">Poze</a></li>
  </ul> --}}
</div>