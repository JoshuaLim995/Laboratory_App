
@auth
@if(Auth::user()->isApproved())
@if(Auth::user()->isStaff())
{{-- <li class="nav-item dropdown">
	<a href="#" data-toggle="dropdown" class="dropdown-toggle nav-link">Here <b class="caret"></b></a>
	<ul class="dropdown-menu" id="menu1">
		<li><a class="dropdown-item" href="{{ route('inventory.index') }}">History</a></li>
		<li><a class="dropdown-item" href="{{ route('category.index') }}">Category</a></li>
	</ul>
</li> --}}

<li><a class="nav-link" href="{{ route('inventory.index') }}">Inventory</a></li>
<li><a class="nav-link" href="{{ route('transaction.index') }}">Transaction</a></li>
{{-- <li><a class="nav-link" href="{{ route('category.index') }}">Category</a></li> --}}
<li><a class="nav-link" href="{{ route('user.index') }}">User</a></li>
<li><a class="nav-link" href="{{ route('loan.index') }}">Loan</a></li>
@if(Auth::user()->isAdmin())
<li><a class="nav-link" href="{{ route('return.index') }}">Return</a></li>
<li><a class="nav-link" href="{{ route('reminder.index') }}">Reminder</a></li>
@endif
<li class="nav-item dropdown">
	<a href="#" data-toggle="dropdown" class="dropdown-toggle nav-link">Reservation<b class="caret"></b></a>
	<ul class="dropdown-menu" id="menu1">
		<li><a class="dropdown-item" href="{{ route('reservation.create') }}">Add Reservation</a></li>
		<li><a class="dropdown-item" href="{{ route('reservation.index') }}">All Reservations</a></li>
	</ul>
</li>
<li><a class="nav-link" href="{{ route('reservation.showCalendar') }}">Calender</a></li>
<li><a class="nav-link" href="{{ route('locker.index') }}">Locker</a></li>

@elseif(Auth::user()->isStudent())
{{-- <li><a class="nav-link" href="{{ route('loan.index') }}">Loan</a></li> --}}

<li class="nav-item dropdown">
	<a href="#" data-toggle="dropdown" class="dropdown-toggle nav-link">Loan<b class="caret"></b></a>
	<ul class="dropdown-menu" id="menu1">
		<li><a class="dropdown-item" href="{{ route('loan.create') }}">Make loan</a></li>
		<li><a class="dropdown-item" href="{{ route('loan.index') }}">All loan</a></li>
	</ul>
</li>

<li class="nav-item dropdown">
	<a href="#" data-toggle="dropdown" class="dropdown-toggle nav-link">Reservation<b class="caret"></b></a>
	<ul class="dropdown-menu" id="menu1">
		<li><a class="dropdown-item" href="{{ route('reservation.create') }}">Make Reservation</a></li>
		<li><a class="dropdown-item" href="{{ route('reservation.index') }}">All Reservations</a></li>
	</ul>
</li>

<li><a class="nav-link" href="{{ route('reservation.showCalendar') }}">Calender</a></li>
<li><a class="nav-link" href="{{ route('rentLocker.index') }}">Rent Locker</a></li>

@endif
@endif
@endauth
