@extends('backend.layouts.dashboard.master')

@section('title', 'Dashboard')



@section('css')

<link rel="stylesheet" type="text/css" href="{{asset('backend/css/vendors/animate.css')}}">
<style>
  .table tbody th {
    font-weight: 400;
  }
</style>

@endsection



@section('style')

@endsection



@section('breadcrumb-title')

<h3>Call Recall</h3>

@endsection



@section('breadcrumb-items')

<li class="breadcrumb-item">Call Recall</li>

@endsection



@section('content')

<div class="container-fluid">

  <div class="row second-chart-list third-news-update">



    <div class="col-sm-6 col-xl-4 col-lg-6">

        <div class="card o-hidden static-top-widget-card">

          <div class="card-body">

            <div class="media static-top-widget">

              <div class="media-body">

                <h6 class="font-roboto">Accounts</h6>

                <h4 class="mb-0 counter">{{ $userCounts}}</h4>

              </div>

              <svg class="fill-secondary" width="48" height="48" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">

                <path d="M22.5938 14.1562V17.2278C20.9604 17.8102 19.7812 19.3566 19.7812 21.1875C19.7812 23.5138 21.6737 25.4062 24 25.4062C24.7759 25.4062 25.4062 26.0366 25.4062 26.8125C25.4062 27.5884 24.7759 28.2188 24 28.2188C23.2241 28.2188 22.5938 27.5884 22.5938 26.8125H19.7812C19.7812 28.6434 20.9604 30.1898 22.5938 30.7722V33.8438H25.4062V30.7722C27.0396 30.1898 28.2188 28.6434 28.2188 26.8125C28.2188 24.4862 26.3263 22.5938 24 22.5938C23.2241 22.5938 22.5938 21.9634 22.5938 21.1875C22.5938 20.4116 23.2241 19.7812 24 19.7812C24.7759 19.7812 25.4062 20.4116 25.4062 21.1875H28.2188C28.2188 19.3566 27.0396 17.8102 25.4062 17.2278V14.1562H22.5938Z"></path>

                <path d="M25.4062 0V11.4859C31.2498 12.1433 35.8642 16.7579 36.5232 22.5938H48C47.2954 10.5189 37.4829 0.704531 25.4062 0Z"></path>

                <path d="M14.1556 31.8558C12.4237 29.6903 11.3438 26.9823 11.3438 24C11.3438 17.5025 16.283 12.1958 22.5938 11.4859V0C10.0492 0.731813 0 11.2718 0 24C0 30.0952 2.39381 35.6398 6.14897 39.8624L14.1556 31.8558Z"></path>

                <path d="M47.9977 25.4062H36.5143C35.8044 31.717 30.4977 36.6562 24.0002 36.6562C21.0179 36.6562 18.3099 35.5763 16.1444 33.8444L8.13779 41.851C12.3604 45.6062 17.905 48 24.0002 48C36.7284 48 47.2659 37.9508 47.9977 25.4062Z"></path>

              </svg>

            </div>

            <div class="progress-widget">

              <div class="progress sm-progress-bar progress-animate">

                <div class="progress-gradient-secondary" role="progressbar" style="width: 75%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"><span class="animate-circle"></span></div>

              </div>

            </div>

          </div>

        </div>

      </div>

      <div class="col-sm-6 col-xl-4 col-lg-6">

        <div class="card o-hidden static-top-widget-card">

          <div class="card-body">

            <div class="media static-top-widget">

              <div class="media-body">

                <h6 class="font-roboto">Payments</h6>

                <h4 class="mb-0 counter">{{ $paymentCounts }}</h4>

              </div>

              <svg class="fill-secondary" width="48" height="48" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">

                <path d="M22.5938 14.1562V17.2278C20.9604 17.8102 19.7812 19.3566 19.7812 21.1875C19.7812 23.5138 21.6737 25.4062 24 25.4062C24.7759 25.4062 25.4062 26.0366 25.4062 26.8125C25.4062 27.5884 24.7759 28.2188 24 28.2188C23.2241 28.2188 22.5938 27.5884 22.5938 26.8125H19.7812C19.7812 28.6434 20.9604 30.1898 22.5938 30.7722V33.8438H25.4062V30.7722C27.0396 30.1898 28.2188 28.6434 28.2188 26.8125C28.2188 24.4862 26.3263 22.5938 24 22.5938C23.2241 22.5938 22.5938 21.9634 22.5938 21.1875C22.5938 20.4116 23.2241 19.7812 24 19.7812C24.7759 19.7812 25.4062 20.4116 25.4062 21.1875H28.2188C28.2188 19.3566 27.0396 17.8102 25.4062 17.2278V14.1562H22.5938Z"></path>

                <path d="M25.4062 0V11.4859C31.2498 12.1433 35.8642 16.7579 36.5232 22.5938H48C47.2954 10.5189 37.4829 0.704531 25.4062 0Z"></path>

                <path d="M14.1556 31.8558C12.4237 29.6903 11.3438 26.9823 11.3438 24C11.3438 17.5025 16.283 12.1958 22.5938 11.4859V0C10.0492 0.731813 0 11.2718 0 24C0 30.0952 2.39381 35.6398 6.14897 39.8624L14.1556 31.8558Z"></path>

                <path d="M47.9977 25.4062H36.5143C35.8044 31.717 30.4977 36.6562 24.0002 36.6562C21.0179 36.6562 18.3099 35.5763 16.1444 33.8444L8.13779 41.851C12.3604 45.6062 17.905 48 24.0002 48C36.7284 48 47.2659 37.9508 47.9977 25.4062Z"></path>

              </svg>

            </div>

            <div class="progress-widget">

              <div class="progress sm-progress-bar progress-animate">

                <div class="progress-gradient-secondary" role="progressbar" style="width: 75%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"><span class="animate-circle"></span></div>

              </div>

            </div>

          </div>

        </div>

      </div>

      <div class="col-sm-6 col-xl-4 col-lg-6">

        <div class="card o-hidden static-top-widget-card">

          <div class="card-body">

            <div class="media static-top-widget">

              <div class="media-body">

                <h6 class="font-roboto">Reports</h6>

                <h4 class="mb-0 counter">{{ $callLogsCount }}</h4>

              </div>

              <svg class="fill-secondary" width="48" height="48" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">

                <path d="M22.5938 14.1562V17.2278C20.9604 17.8102 19.7812 19.3566 19.7812 21.1875C19.7812 23.5138 21.6737 25.4062 24 25.4062C24.7759 25.4062 25.4062 26.0366 25.4062 26.8125C25.4062 27.5884 24.7759 28.2188 24 28.2188C23.2241 28.2188 22.5938 27.5884 22.5938 26.8125H19.7812C19.7812 28.6434 20.9604 30.1898 22.5938 30.7722V33.8438H25.4062V30.7722C27.0396 30.1898 28.2188 28.6434 28.2188 26.8125C28.2188 24.4862 26.3263 22.5938 24 22.5938C23.2241 22.5938 22.5938 21.9634 22.5938 21.1875C22.5938 20.4116 23.2241 19.7812 24 19.7812C24.7759 19.7812 25.4062 20.4116 25.4062 21.1875H28.2188C28.2188 19.3566 27.0396 17.8102 25.4062 17.2278V14.1562H22.5938Z"></path>

                <path d="M25.4062 0V11.4859C31.2498 12.1433 35.8642 16.7579 36.5232 22.5938H48C47.2954 10.5189 37.4829 0.704531 25.4062 0Z"></path>

                <path d="M14.1556 31.8558C12.4237 29.6903 11.3438 26.9823 11.3438 24C11.3438 17.5025 16.283 12.1958 22.5938 11.4859V0C10.0492 0.731813 0 11.2718 0 24C0 30.0952 2.39381 35.6398 6.14897 39.8624L14.1556 31.8558Z"></path>

                <path d="M47.9977 25.4062H36.5143C35.8044 31.717 30.4977 36.6562 24.0002 36.6562C21.0179 36.6562 18.3099 35.5763 16.1444 33.8444L8.13779 41.851C12.3604 45.6062 17.905 48 24.0002 48C36.7284 48 47.2659 37.9508 47.9977 25.4062Z"></path>

              </svg>

            </div>

            <div class="progress-widget">

              <div class="progress sm-progress-bar progress-animate">

                <div class="progress-gradient-secondary" role="progressbar" style="width: 75%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"><span class="animate-circle"></span></div>

              </div>

            </div>

          </div>

        </div>

      </div>

    <div class="col-xl-12  appointment-sec box-col-12">

        <div class="row">

          <div class="col-xl-12 appointment">

            <div class="card">

              <div class="card-header card-no-border">

                <div class="header-top">

                  <h5 class="m-0">Today's Expiry Plan</h5>

                </div>

              </div>

              <div class="card-body pt-0">

                <div class="appointment-table table-responsive">

                  <table class="table table-border">

                  <thead>

                      <tr>

                          <th scope="col">#</th>

                          <th scope="col">User Name</th>

                          <th scope="col">User Email</th>

                          <th scope="col">Purchase Date</th>

                          <th scope="col">Plan Purchased</th>

                          <th scope="col">Remaining Minutes</th>

                          <th scope="col">Expiry Date</th>

                          <th scope="col">Action</th>

                      </tr>

                  </thead>

                    <tbody>

                    @forelse ($accounts as $key => $account)

                        <tr>

                            <th scope="row">{{ $key+1 }}</th>

                            <th>{{$account->name}}</th>

                            <th>{{$account->email}}</th>

                            <th>{{date('Y-m-d',strtotime($account->created_at))}}</th>

                            <th>{{$account->package_name}}</th>

                            <th>{{$account->remaining_minutes}}</th>

                            <th> {{ ( $account->expire_date ) ? date("Y-m-d",strtotime($account->expire_date) ) : '' }}</th>

                            <th> 
                                
                                <a href="{{ route('admin.accounts.renew_plan', base64_encode($account->customer_packages_id)) }}" class="btn-sm btn-info">Renew</a>

                                <?php if($account->remaining_minutes <= $changePlanLimit ) { ?>    
                                    <a href="{{ route('admin.accounts.add_minutes', base64_encode($account->customer_id)) }}" class="btn-sm btn-info">Change Plan</a> 
                                <?php } ?>
                            </th>

                        </tr>

                        @empty
                        

                          <tr><th colspan="8" align="center">No data found </th></tr>
                      
                                
                      @endforelse

                    </tbody>

                  </table>

                </div>

              </div>

            </div>

          </div>

        </div>

      </div>



  </div>

</div>

@endsection



@section('script')

<script src="{{asset('backend/js/dashboard/default.js')}}"></script>

@endsection

