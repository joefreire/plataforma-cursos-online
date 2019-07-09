@extends('layouts.instrutor')
@section('title', 'Dashboard')

@section('content')

@if (Session::has('message')) 
		<br>
        <div class="alert alert-success" align="center">
            <span>
                {{ Session::get('message') }}
            </span>
        </div>
@endif

<div class="row p-t-40">
	<div class="col-md-12">
		<div class="card card-inverse card-flat border-none">
			<div class="card-block p-b-10">
				<div class="row p-t-10 p-b-15">

					<!-- Leads -->
					<div class="col-lg-3 col-sm-6 text-danger-a300 p-l-30 p-r-40 mb-5 mb-sm-5 mb-lg-0 br-grey-100 br-lg br-dashed no-b-xs">
						<div class="row">
							<div class="col-md-8 col-8">
								<h4 class="text-uppercase text-muted no-m">Leads</h4>
								<div class="x3 no-p no-m m-t-10 m-b-10">543 <i class="icon-arrow-up16 text-success text-size-large"></i></div>
							</div>
							<div class="col-md-4 col-4 no-p text-right">
								<i class="icon-comment x6 text-grey-100 m-t-15"></i>
							</div>
						</div>
						<div id="leads"></div>
					</div>
					<!-- /Leads -->

					<!-- Payments -->
					<div class="col-lg-3 col-sm-6 text-success-a300 p-l-30 p-r-40 mb-5 mb-sm-5 mb-lg-0 br-grey-100 br-lg br-dashed no-b-xs no-b-sm">
						<div class="row">
							<div class="col-md-8 col-8">
								<h4 class="text-uppercase text-muted no-m">Payment</h4>
								<div class="x3 no-p no-m m-t-10 m-b-10">$6,210</div>
							</div>
							<div class="col-md-4 col-4 no-p text-right">
								<i class="icon-coin-dollar x6 text-grey-100 m-t-15"></i>
							</div>
						</div>
						<div id="payment"></div>
					</div>
					<!-- /Payments -->

					<!-- Sales -->
					<div class="col-lg-3 col-sm-6 text-info p-l-30 p-r-40 mb-5 mb-sm-0 br-grey-100 br-lg br-dashed no-b-xs">
						<div class="row">
							<div class="col-md-8 col-8">
								<h4 class="text-uppercase text-muted no-m">Sales</h4>
								<div class="x3 no-p no-m m-t-10 m-b-10">765 <i class="icon-arrow-down16 text-danger text-size-large"></i></div>
							</div>
							<div class="col-md-4 col-4 no-p text-right">
								<i class="icon-price-tags x6 text-grey-100 m-t-15"></i>
							</div>
						</div>
						<div id="sales"></div>
					</div>
					<!-- /Sales -->

					<!-- Orders -->
					<div class="col-lg-3 col-sm-6 text-warning p-l-30 p-r-40">
						<div class="row">
							<div class="col-md-8 col-8">
								<h4 class="text-uppercase text-muted no-m">Orders</h4>
								<div class="x3 no-p no-m m-t-10 m-b-10">532 <i class="icon-arrow-up16 text-success text-size-large"></i></div>
							</div>
							<div class="col-md-4 col-4 no-p text-right">
								<i class="icon-cart2 x6 text-grey-100 m-t-15"></i>
							</div>
						</div>
						<div id="orders"></div>
					</div>
					<!-- /Orders -->

				</div>
			</div>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-lg-8">

		<!-- Income & Expenses -->
		<div class="card card-inverse card-flat">
			<div class="card-header">
				<h5 class="card-title">Income & Expenses <small>(Current Year)</small></h5>
			</div>
			<div class="card-block">
				<div class="row hidden-xs">
					<div class="col-lg-12 text-right">
						<div class="button-toolbar">
							<div class="btn-group">
								<button type="button" class="btn btn-sm btn-secondary">Week</button>
								<button type="button" class="btn btn-sm btn-secondary active">Month</button>
								<button type="button" class="btn btn-sm btn-secondary">Year</button>
							</div>
							<div class="btn-group">
								<button type="button" class="btn btn-sm btn-secondary">Today</button>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div id="income"></div>
		</div>
		<!-- /Income & Expenses -->

	</div>
	<div class="col-lg-4">

		<!-- Annual Growth -->
		<div class="card card-inverse card-flat">
			<div class="card-header">
				<h5 class="card-title">Annual Growth</h5>
			</div>
			<div class="card-block">
				<div id="growth"></div>
			</div>
		</div>
		<!-- /Annual Growth -->

		<!-- Website Stats -->
		<div class="card card-inverse card-flat">
			<div class="card-header">
				<h5 class="card-title">Website Stats</h5>
			</div>
			<div class="card-block">
				<div id="stats" style="margin: 0 auto"></div>
			</div>
		</div>
		<!-- /Website Stats -->

	</div>
</div>

<div class="row">

	<!-- Recent Activities -->
	<div class="col-lg-3">
		<div class="card card-inverse card-flat">
			<div class="card-header">
				<h5 class="card-title">
					Recent Activities
				</h5>
			</div>
			<div class="card-block p-l-20 p-b-20">
				<div class="streamline">
					<div class="sl-item sl-primary">
						<div class="sl-content">
							<small class="text-muted"><i class="icon-user-plus position-left"></i>2 mins ago</small>
							<p>Jane Elliott added a new friend.</p>
						</div>
					</div>

					<div class="sl-item sl-danger">
						<div class="sl-content">
							<small class="text-muted"><i class="icon-pencil5 position-left"></i>10 mins ago</small>
							<p>Florence Douglas posted on your timeline.</p>
						</div>
					</div>

					<div class="sl-item sl-success">
						<div class="sl-content">
							<small class="text-muted"><i class="icon-user position-left"></i>14 mins ago</small>
							<p>Jacqueline Howell sent you a friend request.</p>
						</div>
					</div>

					<div class="sl-item sl-warning">
						<div class="sl-content">
							<small class="text-muted"><i class="icon-calendar position-left"></i>20 mins ago</small>
							<p>Sara has invited you for an event.</p>
						</div>
					</div>

					<div class="sl-item sl-primary">
						<div class="sl-content">
							<small class="text-muted"><i class="icon-user-plus position-left"></i>1 day ago</small>
							<p>Ann Porter added a new friend.</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- /Recent Activities -->

	<!-- Recent Comments -->
	<div class="col-lg-4">
		<div class="card card-inverse card-flat">
			<div class="card-header p-b-5">
				<h5 class="card-title">
					Recent Comments
				</h5>
			</div>

			<ul class="media-list media-list-linked">
				<li class="media bg-light-lighter">
					<a href="#" class="media-link">
						<div class="media-left">
							<img src="img/demo/img1.jpg" class="rounded-circle" alt="">
						</div>

						<div class="media-body">
							<h6 class="media-heading">Jane Elliott <span class="media-annotation">4 hours ago</span></h6>
							Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus.
						</div>
					</a>
				</li>

				<li class="media">
					<a href="#" class="media-link">
						<div class="media-left">
							<img src="img/demo/img2.jpg" class="rounded-circle" alt="">
						</div>

						<div class="media-body">
							<h6 class="media-heading">Florence Douglas <span class="media-annotation">3 hours ago</span></h6>
							Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. In enim justo, rhoncus ut.
						</div>
					</a>
				</li>

				<li class="media bg-light-lighter">
					<a href="#" class="media-link">
						<div class="media-left">
							<img src="img/demo/img3.jpg" class="rounded-circle" alt="">
						</div>

						<div class="media-body">
							<h6 class="media-heading">Jacqueline Howell <span class="media-annotation">2 hours ago</span></h6>
							Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus elementum.
						</div>
					</a>
				</li>

				<li class="media">
					<a href="#" class="media-link">
						<div class="media-left">
							<img src="img/demo/img4.jpg" class="rounded-circle" alt="">
						</div>

						<div class="media-body">
							<h6 class="media-heading">Eugine Turner <span class="media-annotation">Yesterday, 14:54</span></h6>
							Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. In enim justo.
						</div>
					</a>
				</li>
			</ul>
		</div>
	</div>
	<!-- /Recent Comments -->

	<!-- Recent Leads -->
	<div class="col-lg-5">
		<div class="card card-inverse card-flat">
			<div class="card-header">
				<h5 class="card-title">Recent leads</h5>
			</div>
			<div class="table-responsive">
				<table class="table table-hover table-striped user-list">
					<thead>
						<tr>
							<th>ID</th>
							<th>Name</th>
							<th>Date</th>
							<th>Status</th>
							<th>Priority</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>1</td>
							<td>Jane Elliott</td>
							<td>Jun 14, 2016</td>
							<td><span class="badge badge-info">Opened</span></td>
							<td><span class="badge badge-danger">High</span></td>
						</tr>

						<tr>
							<td>2</td>
							<td>Florence Douglas</td>
							<td>Jun 14, 2016</td>
							<td><span class="badge badge-success">Closed</span></td>
							<td><span class="badge badge-success">Low</span></td>
						</tr>

						<tr>
							<td>3</td>
							<td>Jacqueline Howell</td>
							<td>Jun 14, 2016</td>
							<td><span class="badge badge-info">Opened</span></td>
							<td><span class="badge badge-warning">Medium</span></td>
						</tr>

						<tr>
							<td>4</td>
							<td>Eugine Turner</td>
							<td>Jun 13, 2016</td>
							<td><span class="badge badge-danger">Pending</span></td>
							<td><span class="badge badge-danger">High</span></td>
						</tr>

						<tr>
							<td>5</td>
							<td>Andrew Brewer</td>
							<td>Jun 14, 2016</td>
							<td><span class="badge badge-danger">Pending</span></td>
							<td><span class="badge badge-success">Low</span></td>
						</tr>
						<tr>
							<td>6</td>
							<td>Jonaly Smith</td>
							<td>Jun 12, 2016</td>
							<td><span class="badge badge-info">Opened</span></td>
							<td><span class="badge badge-success">Low</span></td>
						</tr>
						<tr>
							<td>7</td>
							<td>Ann Porter</td>
							<td>Jun 12, 2016</td>
							<td><span class="badge badge-info">Opened</span></td>
							<td><span class="badge badge-success">Low</span></td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>
	<!-- /Recent Leads -->
</div>

<div class="row">
	<div class="col-lg-12">

		<!-- Stocks -->
		<div class="card card-inverse card-flat">
			<div class="row">
				<div class="col-lg-8">
					<div class="map-container map-world-markers" style="max-height:400px;"></div>
				</div>
				<div class="col-lg-4 pt-0 pt-sm-4 p-md-5 p-lg-3 p-xlg-5 mx-4 mx-sm-0">
					<div class="row">
						<div class="col-md-6 col-sm-6 ">
							<div class="row p-b-20 border-bottom border-grey-200">
								<div class="col-md-6 col-sm-6 col-6">
									<p class="text-semibold no-m">Apple</p>
									<h2 class="text-bold no-m text-success"><i class="icon-arrow-up16 position-left"></i>0.21%</h2>
								</div>
								<div class="col-md-6 col-sm-6 col-6">
									<p class="text-semibold no-m">Facebook</p>
									<h2 class="text-bold no-m text-success"><i class="icon-arrow-up16 position-left"></i>0.40%</h2>
								</div>
							</div>
							<div class="row m-t-20">
								<div class="col-md-6 col-sm-6 col-6">
									<p class="text-semibold no-m">Alabama</p>
								</div>
								<div class="col-md-6 col-sm-6 col-6">
									<p class="text-black">245 <i class="icon-arrow-up5 icon-1x text-success"></i></p>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6 col-sm-6 col-6">
									<p class="text-semibold no-m">Missouri</p>
								</div>
								<div class="col-md-6 col-sm-6 col-6">
									<p class="text-black">599 <i class="icon-arrow-down5 icon-1x text-danger"></i></p>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6 col-sm-6 col-6">
									<p class="text-semibold no-m">Texas</p>
								</div>
								<div class="col-md-6 col-sm-6 col-6">
									<p class="text-black">800 <i class="icon-arrow-down5 icon-1x text-danger"></i></p>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6 col-sm-6 col-6">
									<p class="text-semibold no-m">Oklahoma</p>
								</div>
								<div class="col-md-6 col-sm-6 col-6">
									<p class="text-black">450 <i class="icon-arrow-up5 icon-1x text-success"></i></p>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6 col-sm-6 col-6">
									<p class="text-semibold no-m">Ohio</p>
								</div>
								<div class="col-md-6 col-sm-6 col-6">
									<p class="text-error">155 <i class="icon-arrow-down5 icon-1x text-danger"></i></p>
								</div>
							</div>
						</div>
						<div class="col-md-6 col-sm-6 p-r-40 pt-4 pt-sm-0">
							<div class="row p-b-20 border-bottom border-grey-200">
								<div class="col-md-6 col-sm-6 col-6">
									<p class="text-semibold no-m">Google</p>
									<h2 class="text-bold no-m text-danger"><i class="icon-arrow-down16 position-left"></i>0.09%</h2>
								</div>
							</div>
							<div class="row m-t-20">
								<div class="col-md-6 col-sm-6 col-6">
									<p class="text-semibold no-m">Alabama</p>
								</div>
								<div class="col-md-6 col-sm-6 col-6">
									<p class="text-black">245 <i class="icon-arrow-up5 icon-1x text-success"></i></p>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6 col-sm-6 col-6">
									<p class="text-semibold no-m">Missouri</p>
								</div>
								<div class="col-md-6 col-sm-6 col-6">
									<p class="text-black">599 <i class="icon-arrow-down5 icon-1x text-danger"></i></p>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6 col-sm-6 col-6">
									<p class="text-semibold no-m">Texas</p>
								</div>
								<div class="col-md-6 col-sm-6 col-6">
									<p class="text-black">800 <i class="icon-arrow-down5 icon-1x text-danger"></i></p>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6 col-sm-6 col-6">
									<p class="text-semibold no-m">Oklahoma</p>
								</div>
								<div class="col-md-6 col-sm-6 col-6">
									<p class="text-black">450 <i class="icon-arrow-up5 icon-1x text-success"></i></p>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6 col-sm-6 col-6">
									<p class="text-semibold no-m">Ohio</p>
								</div>
								<div class="col-md-6 col-sm-6 col-6">
									<p class="text-error">155 <i class="icon-arrow-down5 icon-1x text-danger"></i></p>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- /Stocks -->

	</div>
</div>
@endsection