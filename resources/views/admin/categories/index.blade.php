@extends('admin.layouts.app')

@section('content')
    <div class="content">
        <div class="content-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <h4 class="card-header">
                            @lang('label.category_table')
                            <div class="card-tools">
                                <div class="input-group input-group-sm" style="width: 150px;">
                                  <input type="text" name="table_search" class="form-control float-right" placeholder="Search">
              
                                  <div class="input-group-append">
                                    <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                                  </div>
                                  <div class="right ml-1">
                                      <a href="#" class="fa fa-plus-circle" data-toggle="modal" data-target="#modal-category"></a>
                                  </div>
                                </div>
                            </div>
                        </h4>
                        <div class="card-body table-responsive">
                            <table class="table table-hover text-nowrap">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>@lang('label.name')</th>
                                        <th>Slug</th>
                                        <th>Parent</th>
                                        <th>@lang('label.action')</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($data as $key => $category)
                                    <tr>
                                        <td>{{ $key + $data->firstItem() }}</td>
                                        <td>{{ $category->name }}</td>
                                        <td>{{ $category->slug }}</td>
                                        <td>{{ $category->parent_id }}</td>
                                        <td>
                                            <a href="#" class="fas fa-pencil-alt" id="edit" data-category="{{ $category }}"></a> |
                                            <a href="#" class="fas fa-trash-alt" id="category_delete" data-id="{{ $category->id }}"></a>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="5">@lang('label.no_records')</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer clearfix">
                            <div class="pagination pagination-sm m-0 float-right">
                              {{ $data->links() }}
                            </div>
                          </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

{{-- modal --}}
    @include('admin.categories._modalForm')
<!-- /.modal -->
@endsection

@push('script')
    <script>
        $(document).on('click', "#edit", function(e) {
            var category = $(this).data('category');
            if (!category) return e.preventDefault()

            let url = "{{ route('categories.update', ['lang' => app()->getLocale(), 'category' => ':id' ]) }}";
            url = url.replace(':id', category.id);

            $('#id').val(category.id);
            $('#name').val(category.name);
            $('#slug').val(category.slug);
            $('#parent_id').val(category.parent_id);
            $('#form-edit').prop('action', url);
            document.getElementById("form-edit").action = url;
            
            $('#modal-edit-category').modal('show');

            $('#modal-edit-category').on('hide.bs.modal', function() {
                $("#form-edit").trigger("reset");
            })
        });
        @if(Session::has('message'))
            var type="{{Session::get('status','info')}}"

            switch(type){
                case 'info':
                    toastr.info("{{ Session::get('message') }}", "{{ Session::get('head') }}");
                    break;
                case 'success':
                    toastr.success("{{ Session::get('message') }}", "{{ Session::get('head') }}");
                    break;
                case 'warning':
                    toastr.warning("{{ Session::get('message') }}");
                    break;
            }
        @endif
        @if(count($errors) > 0)
            @foreach($errors->all() as $error)
                toastr.error("{{ $error }}");
            @endforeach
        @endif

        $(document).on('click', '#category_delete', function (e) {
            e.preventDefault();
            if( confirm('Are you sure?') )
            {
                var id = $(this).data('id'),
                    token = "{!! csrf_token() !!}";
                let url = "{{ route('categories.destroy', ['lang' => app()->getLocale(), 'category' => ':id']) }}";
                url = url.replace(':id', id);
                
                $.ajax({
                    type: 'POST',
                    url: url,
                    data: {
                        '_token': token,
                        '_method': 'DELETE'
                    },
                    success: function(response) {
                        toastr.success(
                            response.message,
                            response.head,
                            {
                                timeOut: 1000,
                                fadeOut: 1000,
                                onHidden: function () {
                                    window.location.reload();
                                }
                            }
                        );
                    }
                })
            }


        })

    </script>
@endpush