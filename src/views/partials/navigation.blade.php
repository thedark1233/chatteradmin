@if($ismaster)
<ul>
  <li><a href="{{route('admin.dashboard')}}"><i class="fa fa-home"></i><span>Dashboard</span></a></li>
  <li><a href="/chatteradmin/discussions"><i class="fa fa-list"></i><span>Discussions</span></a></li>
  <li><a href="/chatteradmin/categories"><i class="fa fa-archive"></i><span>Categories</span></a></li>
</ul>
@endif
