@extends('templates.main')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">

                <div class="row py-3">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title text-uppercase">Form Penilaian - {{ $page }}</h5>

                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>

                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body" id="frameBody">
                                <!-- 16:9 aspect ratio -->
                                <div class="embed-responsive embed-responsive-1by1">
                                    <iframe src="{{ $link }}" frameborder="0" class="embed-responsive-item"
                                        title="google-form" style="min-height: 100%; height: auto !important!;"
                                        id="google-form-nilai">
                                    </iframe>
                                </div>
                            </div>
                            <!-- ./card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->

            </div>
            <!--/. container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection

@push('scripts')
    <script>
        // $(document).ready(function(){
        function checkstatus(npp_dinilai) {
            let npp = npp_dinilai
            localStorage.setItem('npp', npp);
        }

        // $('.LinkMenilai').on('click', function(e){
        //     // e.preventDefault();
        //     let npp_dinilai = $(this).attr('data-npp');
        //     localStorage.setItem('npp', npp_dinilai);
        // });

        $(document).ready(function() {

            // localStorage.setItem('npp', { json_encode($sheet['NPP'], JSON_HEX_TAG) !!})

            function closeIFrame() {
                $('#google-form-nilai').remove();
                let content = `<p>Anda sudah melakukan penilaian, terimakasih</p>`;
                $('#frameBody').html(content);
            }

            let response_check = null;
            $('#google-form-nilai').on('load', function(e) {
                e.preventDefault();
                // alert('local storage '+localStorage.getItem('npp'));
                // var selevel = { json_encode($sheet['NPP_SELEVEL'], JSON_HEX_TAG) !!};
                let npp = localStorage.getItem('npp');
                // localStorage.removeItem('npp');
                // alert('frame-loaded');
                const uri = '/nilai-rekap/documen/check';
                if (response_check && response_check.readyState != 4) {
                    response_check.abort();
                }
                response_check = $.ajax({
                    url: uri,
                    type: 'get',
                    data: {
                        npp_dinilai: npp,
                        _method: 'GET',
                        _token: '{{ csrf_token() }}',
                    },
                    dataType: 'json',
                    success: function(response) {
                        console.log(response.status);
                        if (response.status > 0) {
                            closeIFrame();
                        }
                    },
                    error: function(response) {}
                })
            });

            // var frame = document.getElementById("myframe");
            // frame.src = "about:blank";
        })
    </script>
@endpush
