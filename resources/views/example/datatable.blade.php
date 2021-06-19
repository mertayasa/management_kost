<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel Datatable Example</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <table id="product-table" class="table table-bordered">
                            <thead>
                                <tr>
                                  <th>Company</th>
                                  <th>Contact</th>
                                  <th>Country</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                  <td>Alfreds Futterkiste</td>
                                  <td>Maria Anders</td>
                                  <td>Germany</td>
                                </tr>
                                <tr>
                                  <td>Centro comercial Moctezuma</td>
                                  <td>Francisco Chang</td>
                                  <td>Mexico</td>
                                </tr>
                                <tr>
                                  <td>Ernst Handel</td>
                                  <td>Roland Mendel</td>
                                  <td>Austria</td>
                                </tr>
                                <tr>
                                  <td>Island Trading</td>
                                  <td>Helen Bennett</td>
                                  <td>UK</td>
                                </tr>
                                <tr>
                                  <td>Laughing Bacchus Winecellars</td>
                                  <td>Yoshi Tannamuri</td>
                                  <td>Canada</td>
                                </tr>
                                <tr>
                                  <td>Magazzini Alimentari Riuniti</td>
                                  <td>Giovanni Rovelli</td>
                                  <td>Italy</td>
                                </tr>
                            </tbody>
                          </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('js/app.js') }}"></script>
    <script>

        $(function () {
            $('#product-table').DataTable({
                processing: true,
                serverSide: false
            });
        });

    </script>
</body>
</html>