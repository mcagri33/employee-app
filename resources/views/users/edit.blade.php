@extends('layouts.main')
@section('title','User Add')
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
                            <form class="row g-3" action="{{route('castle.user.update')}}" method="post">
                                @csrf
                                <input type="hidden" name="id" value="{{$userFind->id}}">
                                <div class="col-12">
                                    <label class="form-label">Username</label>
                                    <input type="text" name="username" value="{{$userFind->username}}" class="form-control" placeholder="Username">
                                    @error("username")
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>

                                <div class="col-12">
                                    <label class="form-label">First Name</label>
                                    <input type="text" name="first_name" value="{{$userFind->first_name}}" class="form-control" placeholder="First Name">
                                    @error("first_name")
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>

                                <div class="col-12">
                                    <label class="form-label">Last Name</label>
                                    <input type="text" name="last_name" value="{{$userFind->last_name}}" class="form-control"
                                           placeholder="Last Name">
                                    @error("last_name")
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>

                                <div class="col-12">
                                    <label class="form-label">Email</label>
                                    <input type="email" name="email" value="{{$userFind->email}}" class="form-control"
                                           placeholder="example@example.com">
                                    @error("email")
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


@endsection
