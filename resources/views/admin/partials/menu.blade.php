<nav class="navbar navbar-expand-sm navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="javascript:void(0)">AryanIntl Admin Panel</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mynavbar">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="mynavbar">
      <ul class="navbar-nav me-auto">
        <li class="nav-item">
          <a class="nav-link " href="{{route('contact-data')}}">Leads</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{route('jobs')}}">Jobs</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{route('site-settings')}}">Site Settings</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{route('company-doc')}}">Company Docs</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{route('logout')}}">Logout</a>
        </li>
      </ul>
     
    </div>
  </div>
</nav>