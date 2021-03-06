@extends('templates/base')

@section('content')

<!-- Page-Level Plugin CSS - Tables -->
{{ HTML::style('assets/css/datatables/dataTables.bootstrap.css') }}
{{ HTML::style('assets/css/datepicker/datepicker.css') }}

<section class="content-header">
    <h1>
        Presensi Siswa
    </h1>
    <ol class="breadcrumb">
        <li><a href="/"><i class="fa fa-desktop"></i> Home</a></li>
        <li><a href="#"> Akademik</a></li>
        <li><a href="presensi-siswa"><i class="active"></i> Presensi Siswa</a></li>
    </ol>
</section>

<section class="content">
    <div class="row">
        <div class="col-xs-12">
            @if(Session::has('message'))
                <div class="alert alert-info alert-dismissable">
                    <i class="fa fa-warning"></i>
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>

                    {{ Session::get('message') }}
                </div>
            @endif

            <div class="box">
                <div class="box-body table-responsive">
                    <button class="btn btn-warning" onclick="showFormFilter()"><i class="fa fa-filter"></i> Filter Pertemuan</button>
                    <button class="btn btn-success" onclick="showFormBeforeCreate()"><i class="fa fa-plus"></i> Input Presensi Baru</button>
                    <div class="clear-fix"><br/></div>
                    <table class="table table-bordered table-hover table-condensed" id="data-table">
                        <thead>
                            <tr>
                                <th>Tanggal</th>
                                <th>Kelas</th>
                                <th>Bidang Studi</th>
                                <th>Tentor</th>
                                <th>Jam Belajar</th>
                                <th>Materi</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($teaches as $teach)
                                <tr>
                                    <td>{{ date('d-m-Y', strtotime($teach->course_date)) }}</td>
                                    <td><span class="badge bg-blue">{{ $teach->course->name }}</span></td>
                                    <td>{{ $teach->subject->name }}</td>
                                    <td>{{ $teach->employee->code }} / {{ $teach->employee->name }}</td>
                                    <td>{{ $teach->hour->start }} - {{ $teach->hour->end }}</td>
                                    <td>
                                        <a href="{{ URL::to('presensi') }}/{{ $teach->id }}" class="btn btn-xs btn-success" data-toggle="tooltip" data-placement="top" title="Klik untuk Detail">
                                            {{ $teach->title }}
                                        </a>
                                    </td>
                                    <td>
                                        <a href="{{ URL::to('presensi') }}/{{ $teach->id }}/edit" class="btn btn-circle btn-primary" data-toggle="tooltip" data-placement="top" title="Klik untuk Koreksi"><i class="fa fa-edit"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Form before Create Presences [modal]
===================================== -->
<div id="formBeforeCreate" class="modal fade" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h3 id="myModalLabel">Input Presensi</h3>
            </div>

            <div class="modal-body">
                <form class="form-horizontal" role="modal">
                    <div class="form-group">
                        <label class="col-lg-3 control-label" for="coursess">Pilih Kelas</label>
                        <div class="col-lg-8">
                           <select class="form-control" name="courses">
                               <option value="0">--Pilih Kelas</option>
                               @foreach($courses as $course)
                                    <option value="{{ $course->id }}">{{ $course->name }} / {{ $course->course_days }}</option>
                               @endforeach
                           </select>
                        </div>
                    </div>
                </form>
            </div>

            <div class="modal-footer">
                <button class="btn" data-dismiss="modal" aria-hidden="true">Batal</button>
                <button class="btn btn-primary" onClick="showFormCreate()" data-dismiss="modal" aria-hidden="true">Pilih</button>
            </div>
        </div>
    </div>
</div>
<!-- End of Form Create Earnings [modal] -->

<!-- Form Filter Earnings [modal]
===================================== -->
<div id="formFilter" class="modal fade" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h3 id="myModalLabel">Filter Presensi</h3>
            </div>

            <div class="modal-body">
                <form class="form-horizontal" role="modal">
                    <div class="form-group">
                        <label class="col-lg-3 control-label" for="date">Tanggal</label>
                        <div class="col-lg-4">
                            <input type="text" class="form-control" name="date" value="{{ $curr_date }}">
                        </div>
                    </div>
                </form>
            </div>

            <div class="modal-footer">
                <button class="btn" data-dismiss="modal" aria-hidden="true">Batal</button>
                <button class="btn btn-primary" onClick="filter()" data-dismiss="modal" aria-hidden="true">Filter</button>
            </div>
        </div>
    </div>
</div>
<!-- End of Form Filter Earnings [modal] -->

<!-- Page-Level Plugin Scripts - Tables -->
{{ HTML::script('assets/js/plugins/datatables/jquery.dataTables.js') }}
{{ HTML::script('assets/js/plugins/datatables/dataTables.bootstrap.js') }}
{{ HTML::script('assets/js/plugins/datepicker/bootstrap-datepicker.js') }}

<script type="text/javascript">
    $(document).ready(function() {
        $('#data-table').dataTable();
        $('.mytooltip').tooltip({
            selector: "[data-toggle=tooltip]",
            container: "body"
        });
        $('[name=date]').datepicker({format:"yyyy-mm-dd"});
    });

    function showFormFilter()
    {
        $('#formFilter').modal('show');
    }

    function filter()
    {
        var date = $('[name=date]').val();

        window.location = "{{ URL::to('presensi') }}/filter/"+date;
    }

    function showFormBeforeCreate()
    {
        $('#formBeforeCreate').modal('show');
    }

    function showFormCreate()
    {
        var course_id = $('[name=courses]').val();

        window.location = "{{ URL::to('presensi') }}/create/"+course_id;
    }
</script>
@stop