@extends('layouts.main')
@section('title','State Update')
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
                            <form class="row g-3" action="{{route('castle.state.update')}}" method="post">
                                @csrf
                                <input type="hidden" name="id" value="{{$stateEdit->id}}">
                                <div class="col-12">
                                    <label class="form-label">State Name</label>
                                    <input type="text" name="name" value="{{$stateEdit->name}}" class="form-control" placeholder="Country Name">
                                    @error("name")
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>

                                <div class="col-12">
                                    <label class="form-label">Dil</label>
                                    <select class="form-select mb-3" name="country_id" aria-label="Default select example">
                                        @foreach($countries as $country )
                                            <option value="{{$country->id}}" {{$country->id == $stateEdit->country_id ? "selected" : ""}}>{{$country->name}}</option>
                                        @endforeach
                                    </select>
                                    @error("country_id")
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary px-4">Add</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div><!--end row-->

    </main>


@endsection
