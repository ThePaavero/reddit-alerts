
<h1>Reddit-Alerts v.0.0.0</h1>

@if (Auth::check())
<a href='<?php echo URL::to('logout'); ?>'>Logout</a>
@else
<a href='<?php echo URL::to('login'); ?>'>Login</a>
@endif