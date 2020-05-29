{{-- create new --}}
<form action="{{ route('categories.store', app()->getLocale()) }}" id="form" method="POST">
  @csrf
    <div class="modal fade" id="modal-category">
        <div class="modal-dialog">
          <div class="modal-content bg-secondary">
            <div class="modal-header">
              <h4 class="modal-title">
                @lang('title.categories_create')
              </h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="category_name">@lang('label.category_name')</label>
                    <input type="text" name="category_name" value="" class="form-control" placeholder="">
                </div>
                <div class="form-group">
                  <label for="parent">Parent</label>
                  <select name="parent_id" id="" class="form-control">
                    <option value="0" selected>@lang('label.category_select')</option>
                    {{-- @foreach ($dataAll as $item)
                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                    @endforeach --}}
                    @foreach ($dataAll as $item)
                    @if ($item->parent_id == 0)
                    <option value="{{ $item->id }}" {{  old('parent_id') == $item->id ? 'selected' : '' }}>
                      {{ $item->name }}
                    @endif
                        @if (!empty($item->childs))
                            @foreach ($item->childs as $child)
                                <option value="{{ $child->id }}">-- {{ $child->name }}</option>
                                @if (!empty($child->childs))
                                    @foreach ($child->childs as $subchild)
                                      <option value="{{ $subchild->id }}">---- {{ $subchild->name }}</option>
                                    @endforeach
                                @endif
                            @endforeach
                        @endif
                      </option>
                    @endforeach
                  </select>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-outline-light" data-dismiss="modal">@lang('button.close')</button>
              <button type="submit" class="btn btn-primary">@lang('button.save')</button>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
    <!-- /.modal -->
</form>
{{-- create new --}}
<form action="" id="form-edit" method="POST">
  @method('PUT')
  @csrf
    <input type="hidden" id="id" name="id">
    <div class="modal fade" id="modal-edit-category">
        <div class="modal-dialog">
          <div class="modal-content bg-secondary">
            <div class="modal-header">
              <h4 class="modal-title">
                  @lang('title.categories_edit')
              </h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="name">@lang('label.category_name')</label>
                    <input type="text" name="category_name" value="" id="name" class="form-control" placeholder="">
                </div>
                <div class="form-group">
                  <label for="parent">Parent</label>
                  <select name="id_parent" id="parent" class="form-control">
                    <option value="0" id="category_default" selected>@lang('label.category_select')</option>
                    {{-- @foreach ($dataAll as $item)
                        <option id="{{ $item->id }}" value="{{ $item->id }}">{{ $item->name }}</option>
                    @endforeach --}}
                    @foreach ($dataAll as $item)
                    @if ($item->parent_id == 0)
                    <option id="{{ $item->id }}" value="{{ $item->id }}" {{  old('parent_id') == $item->id ? 'selected' : '' }}>
                      {{ $item->name }}
                    @endif
                        @if (!empty($item->childs))
                            @foreach ($item->childs as $child)
                                <option id="{{ $child->id }}" value="{{ $child->id }}">-- {{ $child->name }}</option>
                                @if (!empty($child->childs))
                                    @foreach ($child->childs as $subchild)
                                      <option id="{{ $subchild->id }}" value="{{ $subchild->id }}">---- {{ $subchild->name }}</option>
                                    @endforeach
                                @endif
                            @endforeach
                        @endif
                      </option>
                    @endforeach
                  </select>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-outline-light" data-dismiss="modal">@lang('button.close')</button>
              <button type="submit" class="btn btn-warning">@lang('button.update')</button>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
    <!-- /.modal -->
</form>