@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.datapelanggan.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.datapelanggans.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.datapelanggan.fields.id') }}
                        </th>
                        <td>
                            {{ $datapelanggan->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.datapelanggan.fields.name') }}
                        </th>
                        <td>
                            {{ $datapelanggan->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.datapelanggan.fields.description') }}
                        </th>
                        <td>
                            {{ $datapelanggan->description }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.datapelanggan.fields.age') }}
                        </th>
                        <td>
                            {{ $datapelanggan->age }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.datapelanggan.fields.email') }}
                        </th>
                        <td>
                            {{ $datapelanggan->email }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.datapelanggan.fields.whatsap') }}
                        </th>
                        <td>
                            {{ $datapelanggan->whatsap }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.datapelanggan.fields.bookingtime') }}
                        </th>
                        <td>
                            {{ $datapelanggan->bookingtime }}
                        </td>
                    </tr>
                    
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.datapelanggans.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection