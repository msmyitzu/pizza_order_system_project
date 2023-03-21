
@extends('admin.layouts.master')

@section('title','Category List Page')

@section('content')

        <!-- MAIN CONTENT-->
        <div class="main-content">
            <div class="row">
                <div class="col-4 offset-6 mb-2">
                    @if(session('updateSuccess'))
                       <div class="">
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="fa-solid fa-circle-xmark mx-2"></i>{{ session('updateSuccess') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                          </div>
                        </div>
                       @endif
                </div>
            </div>
            <div class="section__content section__content--p30">
                <div class="container-fluid">
                    <div class="col-lg-10 offset-1">
                        <div class="card">
                            <div class="card-body">
                                <div class="ms-5">
                                   {{-- <a href="{{ route('product#list') }}" class="nav-link"> --}}
                                    <i class="fa-solid fa-arrow-left" onclick="history.back()"></i>
                                   {{-- </a> --}}
                                </div>

                                <div class="row">
                                    <div class="col-3 offset-2">
                                            <img src="{{ asset('storage/'.$pizza->image)}}" class="img-thumbnail shadow-sm align-items-center" />
                                    </div>
                                    <div class="col-7">
                                        <div class="my-3 btn bg-danger text-white d-block w-75 fs-5 text-center"> {{ $pizza->name }}</div>

                                        <span class="my-3 btn btn-dark text-white"><i class="fa-solid fa-money-bill-1-wave fx-2 me-2"></i>{{ $pizza->price }} Kyats</span>
                                        <span class="my-3 btn btn-dark text-white"><i class="fa-solid fa-clock fx-2 me-2"></i>{{ $pizza->waiting_time }} mins</span>
                                        <span class="my-3 btn btn-dark text-white"><i class="fa-solid fa-eye fx-2 me-2"></i>{{ $pizza->view_count }}</span>
                                        <span class="my-3 btn btn-dark text-white"><i class="fa-solid fa-clone fx-2 me-2"></i>{{ $pizza->category_name }}</span>
                                        <span class="my-3 btn btn-dark text-white"><i class="fa-solid fa-user-clock fx-2 me-2"></i>{{ Auth::user()->created_at->format('j-F-Y') }}</span>

                                        <div class="my-3"><i class="fa-solid fa-folder-open fs-4 me-2"></i>Details</div>
                                        <div class="">{{ $pizza->description }}</div>

                                    </div>
                                </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
         </div>

        <!-- END MAIN CONTENT-->

@endsection
