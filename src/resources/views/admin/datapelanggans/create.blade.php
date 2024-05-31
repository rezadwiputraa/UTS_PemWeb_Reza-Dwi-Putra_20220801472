@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.datapelanggan.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.datapelanggans.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="name">{{ trans('cruds.datapelanggan.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', '') }}">
                @if($errors->has('name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.datapelanggan.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="description">{{ trans('cruds.datapelanggan.fields.description') }}</label>
                <input class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" type="text" name="description" id="description" value="{{ old('description', '') }}">
                @if($errors->has('description'))
                    <div class="invalid-feedback">
                        {{ $errors->first('description') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.datapelanggan.fields.description_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="age">{{ trans('cruds.datapelanggan.fields.age') }}</label>
                <input class="form-control {{ $errors->has('age') ? 'is-invalid' : '' }}" type="number" name="age" id="age" value="{{ old('age', '') }}" step="0.01">
                @if($errors->has('age'))
                    <div class="invalid-feedback">
                        {{ $errors->first('age') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.datapelanggan.fields.age_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="email">{{ trans('cruds.datapelanggan.fields.email') }}</label>
                <input class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" type="text" name="email" id="email" value="{{ old('email', '') }}" step="1">
                @if($errors->has('email'))
                    <div class="invalid-feedback">
                        {{ $errors->first('email') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.datapelanggan.fields.email_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="whatsap">{{ trans('cruds.datapelanggan.fields.whatsap') }}</label>
                <input class="form-control {{ $errors->has('whatsap') ? 'is-invalid' : '' }}" type="number" name="whatsap" id="whatsap" value="{{ old('whatsap', '') }}" step="1">
                @if($errors->has('whatsap'))
                    <div class="invalid-feedback">
                        {{ $errors->first('whatsap') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.datapelanggan.fields.email_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="bookingtime">{{ trans('cruds.datapelanggan.fields.bookingtime') }}</label>
                <input class="form-control {{ $errors->has('bookingtime') ? 'is-invalid' : '' }}" type="text" name="bookingtime" id="bookingtime" value="{{ old('bookingtime', '') }}" step="1">
                @if($errors->has('bookingtime'))
                    <div class="invalid-feedback">
                        {{ $errors->first('bookingtime') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.datapelanggan.fields.bookingtime_helper') }}</span>
            </div>
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection

@section('scripts')
<script>
    Dropzone.options.imageDropzone = {
    url: '{{ route('admin.datapelanggans.storeMedia') }}',
    maxFilesize: 2, // MB
    acceptedFiles: '.jpeg,.jpg,.png,.gif',
    maxFiles: 1,
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 2,
      width: 4096,
      height: 4096
    },
    success: function (file, response) {
      $('form').find('input[name="image"]').remove()
      $('form').append('<input type="hidden" name="image" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="image"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($datapelanggan) && $datapelanggan->image)
      var file = {!! json_encode($datapelanggan->image) !!}
          this.options.addedfile.call(this, file)
      this.options.thumbnail.call(this, file, file.preview ?? file.preview_url)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="image" value="' + file.file_name + '">')
      this.options.maxFiles = this.options.maxFiles - 1
@endif
    },
    error: function (file, response) {
        if ($.type(response) === 'string') {
            var message = response //dropzone sends it's own error messages in string
        } else {
            var message = response.errors.file
        }
        file.previewElement.classList.add('dz-error')
        _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
        _results = []
        for (_i = 0, _len = _ref.length; _i < _len; _i++) {
            node = _ref[_i]
            _results.push(node.textContent = message)
        }

        return _results
    }
}

</script>
@endsection