
@extends('admin.layouts.master')

@section('title','Category List Page')

@section('content')

        <!-- MAIN CONTENT-->
        <div class="main-content">
            <div class="section__content section__content--p30">
                <div class="container-fluid">
                    <div class="col-md-12">
                        <!-- DATA TABLE -->

                       @if(session('deleteSuccess'))
                       <div class="col-4 offset-8">
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            <i class="fa-solid fa-circle-xmark mx-2"></i>{{ session('deleteSuccess') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                          </div>
                        </div>
                       @endif

                    <div class="row">
                        <div class="col-3">
                            <h4 class="text-secondary">Search Key : <span class="text-danger">{{ request('key') }}</span></h4>
                        </div>
                        <div class="col-3 offset-6">
                            <form action="{{ route('admin#list') }}" method="get">
                                @csrf
                                <div class="m-2 d-flex justify-content-end ">
                                    <input type="text" name="key" class="form control px-2" placeholder="Search something....." value="{{ request('key') }}">
                                    <button class="btn btn-dark text-white" type="submit">
                                        <i class="fa-solid fa-magnifying-glass"></i>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="row m-2 justify-content-end">
                        <div class="col-1  bg-light shadow-sm p-2 text-center">
                            <h3><i class="fa-solid fa-database px-2"></i> {{ $admin->total() }} </h3>
                        </div>
                    </div>

                        <div class="table-responsive table-responsive-data2">
                            <table class="table table-data2 text-center">
                                <thead>
                                    <tr>
                                        <th>Image</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Gender</th>
                                        <th>Phone</th>
                                        <th>Address</th>
                                        <th></th>

                                    </tr>
                                </thead>
                                <tbody>
                                     @foreach ($admin  as $a )
                                        <tr class="tr-shadow">
                                        <td class="col-2">
                                            @if ($a->image == null)
                                               @if ($a->gender == 'male')
                                               <img src="{{ asset('image/default_user.png') }}" class="img-thumbnail shadow-sm">
                                               @else
                                               <img src="{{ asset('image/female_default.png') }}" class="img-thumbnail shadow-sm">
                                               @endif
                                            @else
                                            <img src="{{ asset('storage/'.$a->image) }}" class="img_thumbnail shadow-sm">
                                            @endif
                                        </td>
                                        <input type="hidden" id="adminId" value="{{Auth::user()->id }}">
                                        <td>{{ $a->name }}</td>
                                        <td>{{ $a->email }}</td>
                                        <td>{{ $a->gender }}</td>
                                        <td>{{ $a->phone }}</td>
                                        <td>{{ $a->address }}</td>
                                        <td>
                                            <div class="d-flex">
                                                {{-- table-data-feature --}}
                                               @if (Auth::user()->id == $a->id)

                                               @else

                                                {{-- href="{{ route('admin#changeRole',$a->id) }}" --}}
                                                    {{-- <button class="item" data-toggle="tooltip" data-placement="top" title="Change Admin Role"> --}}
                                                        {{-- <i class="fa-solid fa-person-circle-question fs-4 text-dark"></i> --}}
                                                    {{-- </button> --}}

                                                    <select class="form-control statusChange text-center px-5 me-1">
                                                        <option value="admin" @if(Auth::user()->role == 'admin') selected @endif>Admin</option>
                                                        <option value="user" @if(Auth::user()->role == 'user') selected @endif>User</option>
                                                    </select>

                                               <a href="{{ route('admin#delete',$a->id) }}">
                                                    <button class="item text-center" data-toggle="tooltip" data-placement="top" title="Delete">
                                                        <i class="zmdi zmdi-delete fs-4"></i>
                                                    </button>
                                                </div>
                                               @endif
                                            </div>
                                        </td>

                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            <div class="mt-3">
                                {{ $admin->links() }}
                                {{-- {{ $categories->appends(request()->query())->links() }} --}}
                            </div>

                        </div>
                        <!-- END DATA TABLE -->
                    </div>
                </div>
            </div>
        </div>
        <!-- END MAIN CONTENT-->

@endsection

@section('scriptSource')

<script>

$(document).ready(function(){

      //change role
      $('.statusChange').change(function(){
            $currentStatus = $(this).val();       //ajs-1 console.log($currentStatus); //to know is this change sth
            $parentNode = $(this).parents("tr");
            $adminId = $parentNode.find('#adminId').val();
            //console.log($adminId);
            $data = {
                'adminId' : $adminId ,
                'role'  : $currentStatus

            };

            console.log($data);

            // $.ajax({
            //     type :'get',
            //     url : 'http://localhost:8000/admin/changeRole',
            //     data : $data,
            //     dataType :'json'
            // })

            //location.reload();      // when roles are changed ,page is reload

})

})
</script>


@endsection
