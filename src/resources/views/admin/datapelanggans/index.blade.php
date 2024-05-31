@extends('layouts.admin')
@section('content')
@can('datapelanggan_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.datapelanggans.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.datapelanggan.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.datapelanggan.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-Datapelanggan">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.datapelanggan.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.datapelanggan.fields.name') }}
                        </th>
                        <th>
                            {{ trans('cruds.datapelanggan.fields.description') }}
                        </th>
                        <th>
                            {{ trans('cruds.datapelanggan.fields.age') }}
                        </th>
                        <th>
                            {{ trans('cruds.datapelanggan.fields.email') }}
                        </th>
                        <th>
                            {{ trans('cruds.datapelanggan.fields.whatsap') }}
                        </th>
                        <th>
                            {{ trans('cruds.datapelanggan.fields.bookingtime') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($datapelanggans as $key => $datapelanggan)
                        <tr data-entry-id="{{ $datapelanggan->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $datapelanggan->id ?? '' }}
                            </td>
                            <td>
                                {{ $datapelanggan->name ?? '' }}
                            </td>
                            <td>
                                {{ $datapelanggan->description ?? '' }}
                            </td>
                            <td>
                                {{ $datapelanggan->age ?? '' }}
                            </td>
                            <td>
                                {{ $datapelanggan->email ?? '' }}
                            </td>
                            <td>
                                {{ $datapelanggan->whatsap ?? '' }}
                            </td>
                            <td>
                                {{ $datapelanggan->bookingtime ?? '' }}
                            </td>
                            <td>
                                @can('datapelanggan_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.datapelanggans.show', $datapelanggan->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('datapelanggan_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.datapelanggans.edit', $datapelanggan->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('datapelanggan_delete')
                                    <form action="{{ route('admin.datapelanggans.destroy', $datapelanggan->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
                                    </form>
                                @endcan

                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>



@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('datapelanggan_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.datapelanggans.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).nodes(), function (entry) {
          return $(entry).data('entry-id')
      });

      if (ids.length === 0) {
        alert('{{ trans('global.datatables.zero_selected') }}')

        return
      }

      if (confirm('{{ trans('global.areYouSure') }}')) {
        $.ajax({
          headers: {'x-csrf-token': _token},
          method: 'POST',
          url: config.url,
          data: { ids: ids, _method: 'DELETE' }})
          .done(function () { location.reload() })
      }
    }
  }
  dtButtons.push(deleteButton)
@endcan

  $.extend(true, $.fn.dataTable.defaults, {
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  });
  let table = $('.datatable-Datapelanggan:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection