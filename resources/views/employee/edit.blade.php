@extends('layouts.main')
@section('title','Employee Update')
@section('castle')

    <main class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">@yield('title')</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">@yield('title')</li>
                    </ol>
                </nav>
            </div>
        </div>
        <!--end breadcrumb-->

        <div class="row">
            <div class="col-lg-8 mx-auto">
                <div class="card">
                    <div class="card-header py-3 bg-transparent">
                        <h5 class="mb-0">@yield('title')</h5>
                    </div>
                    <div class="card-body">
                        <div class="border p-3 rounded">
                            <form class="row g-3" action="{{route('castle.employee.update')}}" method="post">
                                @csrf
                                <input type="hidden" name="id" value="{{$employEdit->id}}">
                                <div class="col-12">
                                    <label class="form-label">First Name</label>
                                    <input type="text" name="first_name" value="{{$employEdit->first_name}}" class="form-control" placeholder="First Name">
                                    @error("first_name")
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>

                                <div class="col-12">
                                    <label class="form-label">Last Name</label>
                                    <input type="text" name="last_name" value="{{$employEdit->last_name}}" class="form-control" placeholder="Last Name">
                                    @error("last_name")
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>

                                <div class="col-12">
                                    <label class="form-label">Middle Name</label>
                                    <input type="text" name="middle_name" value="{{$employEdit->middle_name}}" class="form-control" placeholder="Middle Name">
                                    @error("middle_name")
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>

                                <div class="col-12">
                                    <label class="form-label">Address</label>
                                    <input type="text" name="address" value="{{$employEdit->address}}" class="form-control" placeholder="Address">
                                    @error("address")
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>

                                <div class="col-12">
                                    <label class="form-label">Department</label>
                                    <select class="form-select mb-3" name="department_id" aria-label="Default select example">
                                        @foreach($departments as $department )
                                            <option value="{{$department->id}}" {{$employEdit->department_id == $department->id ? "selected" : "" }}>{{$department->name}}</option>
                                        @endforeach
                                    </select>
                                    @error("department_id")
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>

                                <div class="col-12">
                                    <label class="form-label">Country</label>
                                    <select id="country-dd" class="form-select mb-3" name="country_id" aria-label="Default select example">
                                        <option value="">Select Country</option>

                                        @foreach($countries as $country )
                                            <option value="{{$country->id}}" {{$employEdit->country_id == $country->id ? "selected" : "" }}>{{$country->name}}</option>
                                        @endforeach
                                    </select>
                                    @error("country_id")
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>

                                <div class="col-12">
                                    <label class="form-label">State</label>
                                    <select id="state-dd" class="form-select mb-3"  name="state_id" aria-label="Default select example">

                                    </select>
                                    @error("state_id")
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>

                                <div class="col-12">
                                    <label class="form-label">City</label>
                                    <select id="city-dd" class="form-select mb-3"  name="city_id" aria-label="Default select example">

                                    </select>
                                    @error("city_id")
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>

                                <div class="col-12">
                                    <label class="form-label">Zip Code</label>
                                    <input type="text" name="zip_code" value="{{$employEdit->zip_code}}" class="form-control" placeholder="Zip Code">
                                    @error("zip_code")
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>

                                <div class="col-12">
                                    <label class="form-label">Birth Date</label>
                                    <input type="text" name="birthdate" value="{{$employEdit->birthdate}}" class="form-control datepicker" >
                                    @error("birthdate")
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>

                                <div class="col-12">
                                    <label class="form-label">Date Hired</label>
                                    <input type="text" name="date_hired" value="{{$employEdit->date_hired}}" class="form-control datepicker" >
                                    @error("date_hired")
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary px-4">Update</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div><!--end row-->

    </main>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <script>
        $(document).ready(function () {
            $('#country-dd').on('change', function () {
                var idCountry = this.value;
                $("#state-dd").html('');
                $.ajax({
                    url: "{{url('castle/employee/fetch-states')}}",
                    type: "POST",
                    data: {
                        country_id: idCountry,
                        _token: '{{csrf_token()}}'
                    },
                    dataType: 'json',
                    success: function (result) {
                        $('#state-dd').html('<option value="">Select State</option>');
                        $.each(result.states, function (key, value) {
                            $("#state-dd").append('<option value="' + value
                                .id + '">' + value.name + '</option>');
                        });
                        $('#city-dd').html('<option value="">Select City</option>');
                    }
                });
            });
            $('#state-dd').on('change', function () {
                var idState = this.value;
                $("#city-dd").html('');
                $.ajax({
                    url: "{{url('castle/employee/fetch-cities')}}",
                    type: "POST",
                    data: {
                        state_id: idState,
                        _token: '{{csrf_token()}}'
                    },
                    dataType: 'json',
                    success: function (res) {
                        $('#city-dd').html('<option value="">Select City</option>');
                        $.each(res.cities, function (key, value) {
                            $("#city-dd").append('<option value="' + value
                                .id + '">' + value.name + '</option>');
                        });
                    }
                });
            });
        });
    </script>
@endsection
