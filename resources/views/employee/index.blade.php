@extends('layouts.main')
@section('title','Employee List')
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
            <div class="ms-auto">
                <div class="btn-group">
                    <a href="{{route('castle.employee.add')}}" class="btn btn-primary">Employee Create</a>
                </div>
            </div>
        </div>
        <!--end breadcrumb-->
        @include('layouts.alert')
        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <h5 class="mb-0">@yield('title')</h5>
                    <form class="ms-auto position-relative" action="{{route('castle.employee.index')}}" method="GET">
                        <input type="search" name="search" class="form-control">
                        <div style="margin-left: 58%;padding: 10px;">
                            <button type="submit" class="btn btn-primary mb-2">Search</button></div>
                    </form>
                </div>
                <div class="table-responsive mt-3">
                    <table class="table align-middle">
                        @if(count($employees)>0)
                            <thead class="table-secondary">
                            <tr>
                                <th>#</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Department</th>
                                <th>Country</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $count = 1; ?>
                            @foreach($employees as $employee)
                                <tr>
                                    <td>{{$employees->perPage()*($employees->currentPage()-1)+$count}}</td>
                                    <?php $count++; ?>
                                    <td>{{$employee->first_name}}</td>
                                    <td>{{$employee->last_name}}</td>
                                    <td>
                                        @if($employee->department_id)
                                            {{$employee->department->name}}
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td>
                                        @if($employee->country_id)
                                            {{$employee->country->name}}
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td>
                                        <div class="table-actions d-flex align-items-center gap-3 fs-6">
                                            <a href="{{route('castle.employee.edit',$employee->id)}}" class="text-warning" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Edit"><i class="bi bi-pencil-fill"></i></a>
                                            <a href="{{route('castle.employee.delete',$employee->id)}}" class="text-danger" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Delete"><i class="bi bi-trash-fill"></i></a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        @else
                            No found Data
                        @endif
                    </table>
                    <div class="d-flex justify-content-center">
                        {!! $employees->links() !!}
                    </div>
                </div>
            </div>
        </div>
    </main>

@endsection
