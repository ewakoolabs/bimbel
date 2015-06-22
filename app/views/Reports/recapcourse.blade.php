@extends('templates/base')

@section('content')

<!-- Page-Level Plugin CSS - Tables -->
{{ HTML::style('assets/css/datatables/dataTables.bootstrap.css') }}

<section class="content-header">
    <h1>Rekap Kelas Periodik</h1>
    <ol class="breadcrumb">
        <li><a href="{{ URL::to('/') }}"><i class="fa fa-desktop"></i> Home</a></li>
        <li><a href="{{ URL::to('laporan') }}"> Laporan</a></li>
        <li><a href="{{ URL::to('laporan/rekap-kelas') }}"><i class="active"></i> Rekap Kelas Periodik</a></li>
    </ol>
</section>

<section class="content">
    <div class="row">
        <div class="col-lg-12">
            <div class="box">
                <div class="box-body table-responsive">
                    <table class="table table-striped table-condensed">
                        <thead>
                            <tr class="success">
                                <th colspan="{{ count($periods) + 2 }}"><center>Rekap Kelas Periodik</center></th>
                            </tr>
                            <tr class="warning">
                                <th>Kelas</th>
                                @foreach($periods as $period)
                                    <th>
                                       <center>
                                            @if($period->months == 1)
                                                Jan, {{ $period->years }}   
                                            @elseif($period->months == 2)
                                                Feb, {{ $period->years }}
                                            @elseif($period->months == 3)
                                                Mar, {{ $period->years }}
                                            @elseif($period->months == 4)
                                                Apr, {{ $period->years }}
                                            @elseif($period->months == 5)
                                                Mei, {{ $period->years }}
                                            @elseif($period->months == 6)
                                                Jun, {{ $period->years }}
                                            @elseif($period->months == 7)
                                                Jul, {{ $period->years }}
                                            @elseif($period->months == 8)
                                                Agu, {{ $period->years }}
                                            @elseif($period->months == 9)
                                                Sep, {{ $period->years }}
                                            @elseif($period->months == 10)
                                                Okt, {{ $period->years }}
                                            @elseif($period->months == 11)
                                                Nop, {{ $period->years }}
                                            @elseif($period->months == 12)
                                                Des, {{ $period->years }}
                                            @endif
                                       </center>
                                    </th>
                                @endforeach
                                <th><center>Total</center></th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($courselists as $course)
                                <tr>
                                    <td>{{ $course['name'] }}</td>
                                    <?php $total = 0; ?>
                                    @foreach($course['statistics'] as $statistic)
                                        <td>
                                            @if($statistic['count'] == 0)
                                                <center><span class="text-danger">{{ $statistic['count'] }}</span></center>
                                            @else
                                                <center><span class="text-primary">{{ $statistic['count'] }}</span></center>
                                            @endif
                                        </td>
                                        <?php $total += $statistic['count']; ?>
                                    @endforeach
                                        <td><center><span class="text-success">{{ $total }}</span></center></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Page-Level Plugin Scripts - Tables -->
{{ HTML::script('assets/js/plugins/datatables/jquery.dataTables.js') }}
{{ HTML::script('assets/js/plugins/datatables/dataTables.bootstrap.js') }}

<script type="text/javascript">
    $(document).ready(function() {
        $('#data-table').dataTable();
    });
</script>
@stop