@extends('layouts.main')
@section('title','Country List')
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
                    <a href="{{route('castle.state.add')}}" class="btn btn-primary">State Create</a>
                </div>
            </div>
        </div>
        <!--end breadcrumb-->
        @include('layouts.alert')
        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <h5 class="mb-0">@yield('title')</h5>
                    <form class="ms-auto position-relative" action="{{route('castle.state.index')}}" method="GET">
                        <input type="search" name="search" class="form-control">
                        <div style="margin-left: 58%;padding: 10px;">
                            <button type="submit" class="btn btn-primary mb-2">Search</button></div>
                    </form>
                </div>
                <div class="table-responsive mt-3">
                    <table class="table align-middle">
                        @if(count($states)>0)
                            <thead class="table-secondary">
                            <tr>
                                <th>#</th>
                                <th>Country</th>
                                <th>State Name</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $count = 1; ?>
                            @foreach($states as $state)
                                <tr>
                                    <td>{{$states ->perPage()*($states->currentPage()-1)+$count}}</td>
                                    <?php $count++; ?>
                                    <td>
                                        @if($state->country_id)
                                            {{$state->country->name}}
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td>{{$state->name}}</td>
                                    <td>
                                        <div class="table-actions d-flex align-items-center gap-3 fs-6">
                                            <a href="{{route('castle.state.edit',$state->id)}}" class="text-warning" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Edit"><i class="bi bi-pencil-fill"></i></a>
                                            <a href="{{route('castle.state.delete',$state->id)}}" class="text-danger" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Delete"><i class="bi bi-trash-fill"></i></a>
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
                        {!! $states->links() !!}
                    </div>
                </div>
            </div>
        </div>
    </main>

@endsection
