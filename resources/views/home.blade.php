@extends('templates.main')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h4 class="m-0">{{ $page }}</h4>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">

                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title">Form Penilaian</h5>

                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>

                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <!-- 16:9 aspect ratio -->
                                <div class="embed-responsive embed-responsive-1by1">
                                    <iframe src="{{ $link }}" frameborder="0" class="embed-responsive-item"
                                        style="min-height: 100%; height: auto !important!;" id="google-form-nilai"></iframe>
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
    $(document).ready(function(){

        $('#google-form-nilai').on('load', function(){
            // alert('Frame Loaded');

            $('#mG61Hd .DE3NNc CekdCb .NPEfkd RveJvd snByac').on('click', function(){
                console.log('button clicked');
                alert('button clicked');
            })

        })

    })
</script>
@endpush
