@extends('templates.main')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">{{ $title ?? 'Rekap Hasil Personal' }}</h1>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <button type="button" class="btn btn-secondary" id="btnHitungPersonal">
                                    <i class="far fa-plus-square"></i> Hitung Penilaian
                                </button>
                            </div>
                            <div class="card-body">
                                <table class="table table-striped table-hover table-bordered" id="dataTablesHasilPersonal">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Npp Dinilai</th>
                                            <th>Npp Penilai</th>
                                            <th>Total Nilai</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($rekap_personal_data as $rp)
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>{{$rp->identitas_dinilai->npp_karyawan}}</td>
                                            <td>{{$rp->identitas_penilai->npp_karyawan}}</td>
                                            <td>{{$rp->sum_rekap}}</td>
                                            <td>
                                                <button 
                                                    class="btn btn-info btn-sm btn-personal" 
                                                    data-toggle="modal" data-target="#staticBackdrop" 
                                                    data-id="{{$rp->id}}">
                                                    <i class="far fa-eye"></i>
                                                </button>
                                                
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div><!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
                
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection

@push('modals')
<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Hasil Personal</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        @include('hc.rekap.personal.form-personal')
      </div>
    </div>
  </div>
</div>
@endpush

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endpush

@push('scripts')
<script>
$("#dataTablesHasilPersonal").DataTable({
    /**
    fixedColumns: {
        left: 1,
        right: 1
    },
    fixedHeader: {
        header: true,
        footer: true
    },
    **/
    /** 
    scrollX: true
    autoWidth : false,
    paging: false,
    scrollCollapse: true,
    lengthChange : false,
    searching : false,
    **/
    responsive: true,
    scrollY: '50vh',
    ordering: false,
});
</script>
@endpush

@push('scripts')
<script>
$(document).ready(function()
{
    $('#dataTablesHasilPersonal .btn-personal').on('click', function(e)
    {
        e.preventDefault();

        // $(this).prop('disabled', true | false);

        let id = $(this).attr('data-id');

        //showDetail(id);
        $('#penilai_atasan').children().remove();

        $('#penilai_selevel').children().remove();

        if($('.penilai_selevel_atasan').length > 0 )
        {
            $('.penilai_selevel_atasan').remove();
        }

        if($('.penilai_staff').length > 0 )
        {
            $('.penilai_staff').remove();
        }

        var status;

        $.when(showDetail(id))
            .then(function(sd)
            {
                let html;

                // Atasan Pejabat Dinilai
                $.when(showDetailPenilai(sd.karyawan_atasan[0].npp_atasan))
                    .then(function(sdp)
                        {
                            const url = '/rekap/hasil-personal/status?dinilai='+sd.identitas_dinilai.npp_karyawan+'&penilai='+sdp.id;
                            const urlFollowUp = '/rekap/hasil-personal/follow-up?dinilai='+sd.identitas_dinilai.npp_karyawan+'&penilai='+sdp.npp_karyawan;
                            $.getJSON(url, function(i, items)
                            {

                                html =`
                                    <td colspan="2">${sdp.nama_karyawan ?? 'data karyawan tidak di temukan'}</td>
                                    <td colspan="2">${sdp.npp_karyawan  ?? 'data karyawan tidak di temukan'}</td>
                                    <td>${i.status}</td>
                                    ${(i.status != 'Sudah Menilai') ?
                                            `<td data-id="${sdp.npp_karyawan}">
                                            <button 
                                                class="btnFollowUp btn btn-info" 
                                                data-url="${urlFollowUp}" 
                                                data-npp-penilai="${sdp.npp_karyawan}" 
                                                data-npp-dinilai="${sd.identitas_dinilai.npp_karyawan}">
                                            <i class="fab fa-whatsapp"></i>
                                            </button>
                                        </td>` : 
                                        `<td>
                                        </td>`
                                        }
                                    }`;

                                $('#penilai_atasan').append(html).ready(function(e)
                                {    
                                    $('.btnFollowUp').on('click', function(e)
                                    {
                                        e.preventDefault();
                                        var url = $(this).attr('data-url');
                                        var npp_penilai = $(this).attr('data-npp-penilai');
                                        var npp_dinilai = $(this).attr('data-npp-dinilai');

                                        console.log(url);
                                        console.log(npp_penilai);
                                        console.log(npp_dinilai);

                                        Swal.fire
                                        ({
                                            title: 'Follow Up',
                                            text: 'Anda yakin melakukan follow up',
                                            icon: 'question',
                                            showCancelButton: true,
                                            confirmButtonColor: "#3085d6",
                                            cancelButtonColor: "#d33",
                                            confirmButtonText: "follow up",
                                            cancelButtonText: "batal"
                                        }).then((result) => 
                                        {
                                            if (result.isConfirmed) 
                                            {
                                                $.ajax(
                                                {
                                                    url : url,
                                                    type : 'get',
                                                    dataType: 'json',
                                                    success : function (response){
                                                        console.log(response);
                                                        if(response.status === true){
                                                            Swal.fire({
                                                                title: "success",
                                                                text: response.detail,
                                                                icon: "success"
                                                            });
                                                        }else{
                                                            Swal.fire({
                                                                title: "gagal",
                                                                text: response.detail,
                                                                icon: "error"
                                                            });
                                                        }
                                                    }
                                                });
                                            }
                                        });
                                    });
                                });
                                /**
                                 *  $('#ttd_dinilai').html(sd.identitas_dinilai.nama_karyawan);
                                 *  $('#ttd_atasan_dinilai').html(sd.identitas_penilai.nama_karyawan);
                                 *  $('#ttd_atasan_penilai').html(sdp.nama_karyawan);
                                 */
                               
                            });

                        },
                        function(err)
                        {
                            console.log(err);
                        }
                    );

                // Selevel Pejabat Dinilai
                $.when(showDetailPenilai(sd.karyawan_selevel[0].npp_selevel))
                    .then(function(sdp)
                        {
                            const url = '/rekap/hasil-personal/status?dinilai='+sd.identitas_dinilai.npp_karyawan+'&penilai='+sdp.id;
                            const urlFollowUp = '/rekap/hasil-personal/follow-up?dinilai='+sd.identitas_dinilai.npp_karyawan+'&penilai='+sdp.npp_karyawan;
                            
                            $.getJSON(url, function(i, items)
                            {
                                html =`
                                    <td colspan="2">${sdp.nama_karyawan ?? 'data karyawan tidak di temukan'}</td>
                                    <td colspan="2">${sdp.npp_karyawan ?? 'data karyawan tidak di temukan'}</td>
                                    <td>${i.status}</td>
                                    ${(i.status != 'Sudah Menilai') ?
                                            `<td data-id="${sdp.npp_karyawan}">
                                            <button 
                                                class="btnFollowUp btn btn-info" 
                                                data-url="${urlFollowUp}" 
                                                data-npp-penilai="${sdp.npp_karyawan}" 
                                                data-npp-dinilai="${sd.identitas_dinilai.npp_karyawan}">
                                            <i class="fab fa-whatsapp"></i>
                                            </button>
                                        </td>` : 
                                        `<td>
                                        </td>`
                                        }
                                    }`;

                                $('#penilai_selevel').append(html).ready(function(e)
                                {
                                    $('.btnFollowUp').on('click', function(e)
                                    {
                                        e.preventDefault();
                                        var url = $(this).attr('data-url');
                                        var npp_penilai = $(this).attr('data-npp-penilai');
                                        var npp_dinilai = $(this).attr('data-npp-dinilai');

                                        Swal.fire
                                        ({
                                            title: 'Follow Up',
                                            text: 'Anda yakin melakukan follow up',
                                            icon: 'question',
                                            showCancelButton: true,
                                            confirmButtonColor: "#3085d6",
                                            cancelButtonColor: "#d33",
                                            confirmButtonText: "follow up",
                                            cancelButtonText: "batal"
                                        }).then((result) => 
                                        {
                                            if (result.isConfirmed) 
                                            {
                                                $.ajax(
                                                {
                                                    url : url,
                                                    type : 'get',
                                                    dataType: 'json',
                                                    success : function (response){
                                                        console.log(response);
                                                        if(response.status === true){
                                                            Swal.fire({
                                                                title: "success",
                                                                text: response.detail,
                                                                icon: "success"
                                                            });
                                                        }else{
                                                            Swal.fire({
                                                                title: "gagal",
                                                                text: response.detail,
                                                                icon: "danger"
                                                            });
                                                        }
                                                    }
                                                });
                                            }
                                        });
                                    });
                                });
                                console.log(sdp);
                            });
                        },
                        function(err)
                        {
                            console.log(err);
                        }
                    );
                
                // Tambahan Pejabat Selevel dengan Pejabat Dinilai Berdasarkan Atasan Pejabat Dinilai
                $.when(showDetailSelevelAtasan(sd.identitas_dinilai.id, sd.karyawan_atasan[0].npp_atasan))
                .then(function(sdsa)
                    {
                        $(sdsa).each(function(i, items)
                        {
                            console.log(items);
                            const url = '/rekap/hasil-personal/status?dinilai='+sd.identitas_dinilai.npp_karyawan+'&penilai='+items.parent_atasan.id;
                            const urlFollowUp = '/rekap/hasil-personal/follow-up?dinilai='+sd.identitas_dinilai.npp_karyawan+'&penilai='+items.parent_atasan.npp_karyawan;
                            
                            $.getJSON(url, function(i, items2)
                            {
                                // console.log(i);
                                html =`
                                    <tr class="penilai_selevel_atasan">
                                        <td colspan="2">${items.parent_atasan.nama_karyawan}</td>
                                        <td colspan="2">${items.parent_atasan.npp_karyawan}</td>
                                        <td>${i.status}</td>
                                        ${(i.status != 'Sudah Menilai') ?
                                            `<td data-id="${items.parent_atasan.npp_karyawan}">
                                            <button 
                                                class="btnFollowUp btn btn-info" 
                                                data-url="${urlFollowUp}" 
                                                data-npp-penilai="${items.parent_atasan.npp_karyawan}" 
                                                data-npp-dinilai="${sd.identitas_dinilai.npp_karyawan}">
                                            <i class="fab fa-whatsapp"></i>
                                            </button>
                                        </td>` : 
                                        `<td>
                                        </td>`
                                        }
                                    }
                                    <tr>
                                `;
                                
                                $(html).insertAfter('#penilai_atasan').ready(function(e)
                                {
                                    $('.btnFollowUp').on('click', function(e)
                                    {
                                        e.preventDefault();
                                        var url = $(this).attr('data-url');
                                        var npp_penilai = $(this).attr('data-npp-penilai');
                                        var npp_dinilai = $(this).attr('data-npp-dinilai');

                                        console.log(url);
                                        console.log(npp_penilai);
                                        console.log(npp_dinilai);

                                        Swal.fire
                                        ({
                                            title: 'Follow Up',
                                            text: 'Anda yakin melakukan follow up',
                                            icon: 'question',
                                            showCancelButton: true,
                                            confirmButtonColor: "#3085d6",
                                            cancelButtonColor: "#d33",
                                            confirmButtonText: "follow up",
                                            cancelButtonText: "batal"
                                        }).then((result) => 
                                        {
                                            if (result.isConfirmed) 
                                            {
                                                $.ajax(
                                                {
                                                    url : url,
                                                    type : 'get',
                                                    dataType: 'json',
                                                    success : function (response){
                                                        console.log(response);
                                                        if(response.status === true){
                                                            Swal.fire({
                                                                title: "success",
                                                                text: response.detail,
                                                                icon: "success"
                                                            });
                                                        }else{
                                                            Swal.fire({
                                                                title: "gagal",
                                                                text: response.detail,
                                                                icon: "error"
                                                            });
                                                        }
                                                    }
                                                });
                                            }
                                        });
                                    });
                                });
                            });

                        });
                    },
                    function(err)
                    {
                        console.log(err);
                    }
                );

                // Staff / Bawahan Pejabat Dinilai
                $(sd.karyawan_staff).each(function(i, items)
                {
                    $.when(showDetailPenilai(items.npp_staff))
                    .then(function(sdp)
                        {
                            const url = '/rekap/hasil-personal/status?dinilai='+sd.identitas_dinilai.npp_karyawan+'&penilai='+sdp.id;
                            const urlFollowUp = '/rekap/hasil-personal/follow-up?dinilai='+sd.identitas_dinilai.npp_karyawan+'&penilai='+sdp.npp_karyawan;
                            
                            $.getJSON(url, function(i, items)
                            {
                                html =`
                                    <tr class="penilai_staff">
                                        <td colspan="2">${sdp.nama_karyawan}</td>
                                        <td colspan="2">${sdp.npp_karyawan}</td>
                                        <td>${i.status}</td>
                                        ${(i.status != 'Sudah Menilai') ?
                                            `<td data-id="${sdp.npp_karyawan}">
                                            <button 
                                                class="btnFollowUp btn btn-info" 
                                                data-url="${urlFollowUp}" 
                                                data-npp-penilai="${sdp.npp_karyawan}" 
                                                data-npp-dinilai="${sd.identitas_dinilai.npp_karyawan}">
                                            <i class="fab fa-whatsapp"></i>
                                            </button>
                                        </td>` : 
                                        `<td>
                                        </td>`
                                        }
                                    }
                                    <tr>
                                `;
                                
                                $(html).insertAfter('#penilai_selevel').ready(function(e)
                                {
                                    $('.btnFollowUp').on('click', function(e)
                                    {
                                        e.preventDefault();
                                        var url = $(this).attr('data-url');
                                        var npp_penilai = $(this).attr('data-npp-penilai');
                                        var npp_dinilai = $(this).attr('data-npp-dinilai');

                                        console.log(url);
                                        console.log(npp_penilai);
                                        console.log(npp_dinilai);

                                        Swal.fire
                                        ({
                                            title: 'Follow Up',
                                            text: 'Anda yakin melakukan follow up',
                                            icon: 'question',
                                            showCancelButton: true,
                                            confirmButtonColor: "#3085d6",
                                            cancelButtonColor: "#d33",
                                            confirmButtonText: "follow up",
                                            cancelButtonText: "batal"
                                        }).then((result) => 
                                        {
                                            if (result.isConfirmed) 
                                            {
                                                $.ajax(
                                                {
                                                    url : url,
                                                    type : 'get',
                                                    dataType: 'json',
                                                    success : function (response){
                                                        console.log(response);
                                                        if(response.status === true){
                                                            Swal.fire({
                                                                title: "success",
                                                                text: response.detail,
                                                                icon: "success"
                                                            });
                                                        }else{
                                                            Swal.fire({
                                                                title: "gagal",
                                                                text: response.detail,
                                                                icon: "error"
                                                            });
                                                        }
                                                    }
                                                });
                                            }
                                        });
                                    });
                                });
                            });
                        },
                        function(err)
                        {
                            console.log(err);
                        }
                    );
                });

                showForm(sd);

            }, 
            function(err)
            {
                console.log(err);
            }
        );
    });

    async function showForm(response)
    {  
        var aspek_1 = 0;
        var aspek_2 = 0;
        var aspek_3 = 0;

        if(response.identitas_dinilai.level_jabatan == 'IA' || response.identitas_dinilai.level_jabatan == 'IC')
        {
            $("#ket_kp_1").html('a (25%)');

            $("#ket_kp_2").html('a (25%)');

            $("#ket_kp_3").html('a (50%)');

            aspek_1 = 0.25;

            aspek_2 = 0.25;

            aspek_3 = 0.50;
        }
        else if(response.identitas_dinilai.level_jabatan == 'II' || response.identitas_dinilai.level_jabatan == 'IINS')
        {
            $("#ket_kp_1").html('a (25%)');

            $("#ket_kp_2").html('a (30%)');

            $("#ket_kp_3").html('a (45%)');

            aspek_1 = 0.25;

            aspek_2 = 0.30;

            aspek_3 = 0.45;
        }
        else if(response.identitas_dinilai.level_jabatan == 'III')
        {
            $("#ket_kp_1").html('a (25%)');

            $("#ket_kp_2").html('a (35%)');

            $("#ket_kp_3").html('a (40%)');

            aspek_1 = 0.25;

            aspek_2 = 0.35;

            aspek_3 = 0.45;
        }
        else if(response.identitas_dinilai.level_jabatan == 'IVA')
        {
            $("#ket_kp_1").html('a (30%)');

            $("#ket_kp_2").html('a (60%)');

            $("#ket_kp_3").html('a (10%)');

            aspek_1 = 0.30;

            aspek_2 = 0.60;

            aspek_3 = 0.10;
        }
        else
        {
            aspek_1 = 0.35;

            aspek_2 = 0.65;

            aspek_3 = 0;

            $("#ket_kp_1").html('a (35%)'); // Perilaku

            $("#ket_kp_2").html('a (65%)'); // Sasaran

            $("#ket_kp_3").html('a (0%)'); // Kepemimpinan
        }

        $('#head-nama-dinilai').html(response.identitas_dinilai.nama_karyawan);
        $('#head-npp-dinilai').html(response.identitas_dinilai.npp_karyawan);
        $('#head-jabatan-dinilai').html(response.identitas_dinilai.level_jabatan);
        $('#head-unit-dinilai').html(response.identitas_dinilai.unit_jabatan);

        $('#head-nama-penilai').html(response.identitas_penilai.nama_karyawan);
        $('#head-npp-penilai').html(response.identitas_penilai.npp_karyawan);
        $('#head-jabatan-penilai').html(response.identitas_penilai.level_jabatan);
        $('#head-unit-penilai').html(response.identitas_penilai.unit_jabatan);

        $('#kp1').html(response.k_avg_1);
        $('#kp2').html(response.k_avg_2);
        $('#kp3').html(response.k_avg_3);
        $('#kp4').html(response.k_avg_4);
        $('#kp5').html(response.k_avg_5);
        $('#kp6').html(response.k_avg_6);

        $('#kp1_avg').html(((response.k_avg_1 / 30) * aspek_3).toFixed(3));
        $('#kp2_avg').html(((response.k_avg_2 / 30) * aspek_3).toFixed(3));
        $('#kp3_avg').html(((response.k_avg_3 / 30) * aspek_3).toFixed(3));
        $('#kp4_avg').html(((response.k_avg_4 / 30) * aspek_3).toFixed(3));
        $('#kp5_avg').html(((response.k_avg_5 / 30) * aspek_3).toFixed(3));
        $('#kp6_avg').html(((response.k_avg_6 / 30) * aspek_3).toFixed(3));

        $('#pp1_avg').html(((response.p_avg_1 / 25) * aspek_2).toFixed(3));
        $('#pp2_avg').html(((response.p_avg_2 / 25) * aspek_2).toFixed(3));
        $('#pp3_avg').html(((response.p_avg_3 / 25) * aspek_2).toFixed(3));
        $('#pp4_avg').html(((response.p_avg_4 / 25) * aspek_2).toFixed(3));
        $('#pp5_avg').html(((response.p_avg_5 / 25) * aspek_2).toFixed(3));

        $('#sp1_avg').html(((response.s_avg_1 / 25) * aspek_1).toFixed(3));
        $('#sp2_avg').html(((response.s_avg_2 / 25) * aspek_1).toFixed(3));
        $('#sp3_avg').html(((response.s_avg_3 / 25) * aspek_1).toFixed(3));
        $('#sp4_avg').html(((response.s_avg_4 / 25) * aspek_1).toFixed(3));
        $('#sp5_avg').html(((response.s_avg_5 / 25) * aspek_1).toFixed(3));

        $('#kpm1').html(response.mutator_k_avg_1);
        $('#kpm2').html(response.mutator_k_avg_2);
        $('#kpm3').html(response.mutator_k_avg_3);
        $('#kpm4').html(response.mutator_k_avg_4);
        $('#kpm5').html(response.mutator_k_avg_5);
        $('#kpm6').html(response.mutator_k_avg_6);

        $('#pp1').html(response.p_avg_1);
        $('#pp2').html(response.p_avg_2);
        $('#pp3').html(response.p_avg_3);
        $('#pp4').html(response.p_avg_4);
        $('#pp5').html(response.p_avg_5);

        $('#ppm1').html(response.mutator_p_avg_1);
        $('#ppm2').html(response.mutator_p_avg_2);
        $('#ppm3').html(response.mutator_p_avg_3);
        $('#ppm4').html(response.mutator_p_avg_4);
        $('#ppm5').html(response.mutator_p_avg_5);

        $('#sp1').html(response.s_avg_1);
        $('#sp2').html(response.s_avg_2);
        $('#sp3').html(response.s_avg_3);
        $('#sp4').html(response.s_avg_4);
        $('#sp5').html(response.s_avg_5);

        $('#spm1').html(response.mutator_s_avg_1);
        $('#spm2').html(response.mutator_s_avg_2);
        $('#spm3').html(response.mutator_s_avg_3);
        $('#spm4').html(response.mutator_s_avg_4);
        $('#spm5').html(response.mutator_s_avg_5);
        
        $('#kp1_sum').html((response.mutator_k_avg_1 * 100).toFixed(2));
        $('#kp2_sum').html((response.mutator_k_avg_2 * 100).toFixed(2));
        $('#kp3_sum').html((response.mutator_k_avg_3 * 100).toFixed(2));
        $('#kp4_sum').html((response.mutator_k_avg_4 * 100).toFixed(2));
        $('#kp5_sum').html((response.mutator_k_avg_5 * 100).toFixed(2));
        $('#kp6_sum').html((response.mutator_k_avg_6 * 100).toFixed(2));

        $('#pp1_sum').html((response.mutator_p_avg_1 * 100).toFixed(2));
        $('#pp2_sum').html((response.mutator_p_avg_2 * 100).toFixed(2));
        $('#pp3_sum').html((response.mutator_p_avg_3 * 100).toFixed(2));
        $('#pp4_sum').html((response.mutator_p_avg_4 * 100).toFixed(2));
        $('#pp5_sum').html((response.mutator_p_avg_5 * 100).toFixed(2));

        $('#sp1_sum').html((response.mutator_s_avg_1 * 100).toFixed(2));
        $('#sp2_sum').html((response.mutator_s_avg_2 * 100).toFixed(2));
        $('#sp3_sum').html((response.mutator_s_avg_3 * 100).toFixed(2));
        $('#sp4_sum').html((response.mutator_s_avg_4 * 100).toFixed(2));
        $('#sp5_sum').html((response.mutator_s_avg_5 * 100).toFixed(2));

        var spm = 0;
        var ppm = 0;
        var kpm = 0;
        var total_pm = 0;

        $('.spm').each(function()
        {
            var value = $(this).text();
            if(!isNaN(value) && value.length != 0)
            {
                spm += parseFloat(value);
            }
        });

        $('.ppm').each(function()
        {
            var value = $(this).text();
            if(!isNaN(value) && value.length != 0)
            {
                ppm += parseFloat(value);
            }
        });

        $('.kpm').each(function()
        {
            var value = $(this).text();
            if(!isNaN(value) && value.length != 0)
            {
                kpm += parseFloat(value);
            }
        });
        
        $('#sum_s_total').html((spm).toFixed(2));
        $('#sum_p_total').html((ppm).toFixed(2));
        $('#sum_k_total').html((kpm).toFixed(2));

        $('.totalNilai').each(function()
        {
            var value = $(this).text();
            if(!isNaN(value) && value.length != 0)
            {
                total_pm += parseFloat(value);
            }
        });

        var kriteria = null;

        if(total_pm > 94)
        {
            kriteria = 'Sangat Baik';
        }
        else if(total_pm <= 94 && total_pm > 80)
        {
            kriteria = 'Baik';
        }
        else if(total_pm <= 80 && total_pm > 65)
        {
            kriteria = 'Cukup';
        }
        else if(total_pm <= 65 && total_pm > 50)
        {
            kriteria = 'Kurang';
        }
        else
        {
            kriteria = 'Sangat Kurang';
        }

        $('#totalSumNilai').html(total_pm);
        $('#keterangan').html(kriteria);
    }

    async function showDetail(id)
    {
        return $.ajax(
            {
                url : '/rekap/hasil-personal?detail='+id,
                type : 'get',
                dataType: 'json',
            }
        );
    }

    async function showDetailPenilai(id)
    {
        return $.ajax(
            {
                url : '/rekap/hasil-personal/penilai?detail='+id,
                type : 'get',
                dataType: 'json',
            }
        );
    }

    async function showDetailSelevelAtasan(id_dinilai, npp_atasan_dinilai)
    {
        return $.ajax(
            {
                url : '/rekap/hasil-personal/selevel?dinilai='+id_dinilai+'&atasan='+npp_atasan_dinilai,
                type : 'get',
                dataType: 'json',
            }
        );
    }

    async function statusHasil(dinilai,penilai)
    {
        return $.getJSON(`/rekap/hasil-personal/status?dinilai='+${dinilai}+'&penilai='+${penilai}`, function(i, items)
            {
                return items;
            }
        );
    }

});
</script>
@endpush

@push('scripts')
<script>
$(document).ready(function(e)
{
    async function swalAjax()
    {
        $.ajax({
            url : '/rekap/personal-calculate',
            type : 'get',
            dataType: 'json',
            success : function (response){
                console.log(response)
            }
        });
    }

    async function swalOk()
    {
        Swal.fire({
            title: "success",
            text: "anda menarik data dari database, muat ulang halaman",
            icon: "success"
        });
    }

    async function alertswal(title, text, icon, confirmButtonText)
    {
        Swal.fire({
        title: title,
        text: text,
        icon: icon,
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: confirmButtonText,
        cancelButtonText: "batal"
        }).then((result) => {
        if (result.isConfirmed) {
            swalAjax();
            swalOk();
        }
        });
    }

    $('#btnHitungPersonal').on('click', function(ev)
    {
        ev.preventDefault();

        alertswal(
            'anda yakin',
            'anda melakukan perhitungan peniliaan',
            'warning',
            'Iya',
        );

    });

});
</script>
@endpush