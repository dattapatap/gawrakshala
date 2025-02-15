@extends('backend.layouts.app')
@section('styles')
<style>
    .table td {
    vertical-align: middle;
    white-space: normal !important;
}
.table{
    overflow: auto !important;
}
</style>
@endsection
@section('content')
    <div class="mb-4 d-flex">
        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ url('/admin') }}">
                        <i class="bi bi-globe2 small me-2"></i> Dashboard
                    </a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Testimonial</li>
            </ol>
        </nav>
        <div class=" ms-auto">
            <a href="{{route('admin.testimonial.create')}}" class="btn btn-primary btn-sm btn-icon">
                    <i class="bi bi-plus"></i>  Add New </a>
        </div>
    </div>



    <div class="card">
        <div class="card-body">
            <div class="d-md-flex gap-4 align-items-center">
                <table class="table table-responsive mb-0" id="">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Image</th>
                            <th>Name</th>
                            <th width="300">Quote</th>
                            <th>Rating</th>
                            <th>Serial</th>
                            <th>Publish</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ( $testimonial as $key=>$item)
                        <tr>
                            <td>{{  $testimonial->firstItem() + $key  }}</td>
                            <td><img class="rounded-circle" src="{{ asset('storage/'.$item->image) }}" alt=""
                                    width="50px" height="50px"></td>
                            <td>{{ $item->name }}</td>
                            <td width="50%">{{ $item->quote }}</td>
                            <td>{{ $item->rating }}</td>
                            <td>{{ $item->serial }}</td>
                            <td>
                                <div class="form-check form-switch">
                                    <input class="form-check-input change-status" type="checkbox" id="{{$item->id}}" @if ($item->status==true)
                                        checked
                                    @endif >
                                </div>
                            </td>
                            <td>
                                <div class="d-flex jc">
                                    <div class="dropdown">
                                        <a href="#" data-bs-toggle="dropdown" class="btn btn-floating"
                                            aria-haspopup="true" aria-expanded="false">
                                            <i class="bi bi-three-dots"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-end">
                                            <a href="{{url('admin/testimonial/'.$item->id.'/edit')}}" class="dropdown-item">Edit</a>
                                            <a href="javascript:void(0)" data="{{$item->id}}" class="dropdown-item delete-testimonial">Delete</a>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8"> No testimonials are added </td>
                        </tr>

                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection


@push('scripts')


<script>
    $(document).ready(function(){
        $('body').on('click', '.change-status', function(){
            let isChecked = $(this).is(':checked');
            let id = $(this).attr('id');
            $.ajax({
                url: "{{ route('admin.testimonial.change-status')}}",
                method: 'GET',
                data: { status: isChecked, id: id    },
                success: function(data){
                    toastr.success(data.message)
                },
                error: function(xhr, status, error){
                    console.log(error);
                }
            })
        })

        $('body').on('click', '.delete-testimonial', function(){
            let id = $(this).attr('data');
            $.ajax({
                url: "testimonial/"+ id,
                type: 'DELETE',
                data: {_token: '{{csrf_token()}}' },
                success: function(data){
                    toastr.success(data.message)
                    location.reload()
                },
                error: function(xhr, status, error){
                    console.log(error);
                }
            })

        })
    })
</script>

@endpush
