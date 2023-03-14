<!doctype html>
<html lang="en">

<head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS v5.2.1 -->
    <link href="dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>
    <header>
        <!-- place navbar here -->
        <nav class="navbar navbar-expand-sm navbar-light bg-light">
            <div class="container">
                <a class="navbar-brand" href="#"><img src="dist/img/logopmu.png" alt="pmu" class="img-fluid"
                        width="120"></a>
                <button class="navbar-toggler d-lg-none" type="button" data-bs-toggle="collapse"
                    data-bs-target="#collapsibleNavId" aria-controls="collapsibleNavId" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="collapsibleNavId">
                    <ul class="navbar-nav me-auto mt-2 mt-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" href="#" aria-current="page">Home <span
                                    class="visually-hidden">(current)</span></a>
                        </li>
                        {{-- <li class="nav-item">
                            <a class="nav-link" href="#">Link</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Profil</a>
                        </li> --}}
                    </ul>

                    <ul class="navbar-nav  mt-2 mt-lg-0">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('logout') }}">Logout</a>
                        </li>
                    </ul>

                </div>
            </div>
        </nav>

    </header>
    <main class="mt-5">
        <div class="container">
            <div class="card">
                <div class="card-header">
                    Link Tabel Penilaian
                </div>
                <div class="card-body">
                    @foreach ($sheet as $item)
                        {{-- {{ Auth::user()->npp }} --}}
                        @if (data_get($item, 'NPP') == Auth::user()->npp)
                            <h1>NPP : {{ data_get($item, 'NPP') }}</h1>
                        @endif
                        @php
                            break;
                        @endphp
                    @endforeach
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>NPP ATASAN</th>
                                    <th>NPP SELEVEL</th>
                                    <th>NPP STAFF</th>
                                    <th>LINK SELF ASSESSMENT</th>
                                    <th>LINK MENILAI ATASAN</th>
                                    <th>LINK MENILAI SELEVEL</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($sheet as $item)
                                    <tr>
                                        <td>
                                            {{ $loop->iteration }}
                                        </td>
                                        <td>
                                            {{ data_get($item, 'NPP_ATASAN') }}
                                        </td>
                                        <td>
                                            {{ data_get($item, 'NPP_SELEVEL') }}
                                        </td>
                                        <td>
                                            {{ data_get($item, 'NPP_STAFF') }}
                                        </td>
                                        <td>
                                            @if (data_get($item, 'LINK_SELF-ASSESSMENT'))
                                                <a href="{{ data_get($item, 'LINK_SELF-ASSESSMENT') }}">link</a>
                                            @endif
                                        </td>
                                        <td>
                                            @if (data_get($item, 'LINK_MENILAI_ATASAN'))
                                                <a href="{{ data_get($item, 'LINK_MENILAI_ATASAN') }}">link</a>
                                            @endif
                                        </td>
                                        <td>
                                            @if (data_get($item, 'LINK_MENILAI_SELEVEL'))
                                                <a href="{{ data_get($item, 'LINK_MENILAI_SELEVEL') }}">link</a>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- 16:9 aspect ratio -->
                    <div class="embed-responsive embed-responsive-16by9">
                        <iframe class="embed-responsive-item"
                            src="https://docs.google.com/forms/d/e/1FAIpQLSfd657N1T_N9d1wBTGBeOEjSEpJEEhfbcEvRf9l0wOyq4vG1g/viewform"
                            frameborder="0"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <footer>
        <!-- place footer here -->
    </footer>
    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
        integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
    </script>

    <script src="dist/js/bootstrap.min.js"></script>
</body>

</html>
