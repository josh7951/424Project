@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-10">
			<div class="card">
				<div class="card-header">Hello, {{ Auth::user()->firstname }} {{ Auth::user()->lastname }}</div>

			<div class="card-body">
					@if (session('status'))
						<div class="alert alert-success" role="alert">
							{{ session('status') }}
						</div>
					@endif
					<div class="table-responsive" style="text-align:center">          
						<table class="table">
							<thead>
								<tr>
									<th>D.O.B</th>
									<th>Current Login Time</th>
									<th>Last Login Time</th>
									<th>Total Logins</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>{{ auth()->user()->birthday }}</td>
									<td>{{ auth()->user()->current_login }}</td>
									<td>{{ auth()->user()->last_login }}</td>
									<td><strong>{{ auth()->user()->login_count }}</strong></td>
								</tr>
							</tbody>
						</table>
					</div>
					<p>Download the <a href="files/company_confidential_file.txt" download>company_confidential_file.txt</a> <i class="fas fa-file-alt"></i></p>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
