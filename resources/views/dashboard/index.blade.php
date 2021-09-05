@extends('layouts.app')

@push('styles')
  <style>
    .filepond--root{
        margin-bottom: 0px !important;
    }

    @media (min-width: 768px) and (max-width: 991.98px) {
        .filepond--item {
            width: calc(50% - 0.5em);
        }
    }

    @media (min-width: 992px) {
        .filepond--item {
            width: calc(33.33% - 0.5em);
        }
    }
  </style>
@endpush

@section('content')
<section class="section">
    <div class="row">
      <div class="col-lg-4 col-md-4 col-sm-12">
        <div class="card card-statistic-2">
          <div class="card-icon shadow-primary bg-primary">
            <i class="fas fa-archive"></i>
          </div>
          <div class="card-wrap">
            <div class="card-header">
              <h4>Total Orders</h4>
            </div>
            <div class="card-body">
              59
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-4 col-md-4 col-sm-12">
        <div class="card card-statistic-2">
          <div class="card-icon shadow-primary bg-primary">
            <i class="fas fa-dollar-sign"></i>
          </div>
          <div class="card-wrap">
            <div class="card-header">
              <h4>Balance</h4>
            </div>
            <div class="card-body">
              $187,13
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-4 col-md-4 col-sm-12">
        <div class="card card-statistic-2">
          <div class="card-icon shadow-primary bg-primary">
            <i class="fas fa-shopping-bag"></i>
          </div>
          <div class="card-wrap">
            <div class="card-header">
              <h4>Sales</h4>
            </div>
            <div class="card-body">
              4,732
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-header">
            <h4>Chart JS</h4>
            <div class="card-header-action">
              <div class="card-stats-title">
                <div class="dropdown d-inline">
                  <a class="font-weight-600 btn btn-danger dropdown-toggle" data-toggle="dropdown" href="#" id="orders-month">Select Period</a>
                  <ul class="dropdown-menu dropdown-menu-sm">
                    <li class="dropdown-title">Select Month</li>
                    <li><a href="#" class="dropdown-item">January</a></li>
                    <li><a href="#" class="dropdown-item">February</a></li>
                    <li><a href="#" class="dropdown-item">March</a></li>
                    <li><a href="#" class="dropdown-item">April</a></li>
                    <li><a href="#" class="dropdown-item">May</a></li>
                    <li><a href="#" class="dropdown-item">June</a></li>
                    <li><a href="#" class="dropdown-item">July</a></li>
                    <li><a href="#" class="dropdown-item active">August</a></li>
                    <li><a href="#" class="dropdown-item">September</a></li>
                    <li><a href="#" class="dropdown-item">October</a></li>
                    <li><a href="#" class="dropdown-item">November</a></li>
                    <li><a href="#" class="dropdown-item">December</a></li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
          <div class="card-body">
            <canvas id="myChart" height="158"></canvas>
          </div>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-12 col-md-8">
        <div class="card">
          <div class="card-header">
            <h4>DataTables</h4>
            <div class="card-header-action">
              <a href="#" class="btn btn-danger">View More <i class="fas fa-chevron-right"></i></a>
            </div>
          </div>
          <div class="card-body p-4">
            <div class=" ">
              <table class="table table-striped" id="productTable">
                <thead>
                  <tr>
                    <th>Invoice ID</th>
                    <th>Customer</th>
                    <th>Status</th>
                    <th>Due Date</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td><a href="#">INV-87239</a></td>
                    <td class="font-weight-600">Kusnadi</td>
                    <td><div class="badge badge-warning">Unpaid</div></td>
                    <td>July 19, 2018</td>
                    <td>
                      <a href="#" class="btn btn-primary">Detail</a>
                    </td>
                  </tr>
                  <tr>
                    <td><a href="#">INV-48574</a></td>
                    <td class="font-weight-600">Hasan Basri</td>
                    <td><div class="badge badge-success">Paid</div></td>
                    <td>July 21, 2018</td>
                    <td>
                      <a href="#" class="btn btn-primary">Detail</a>
                    </td>
                  </tr>
                  <tr>
                    <td><a href="#">INV-76824</a></td>
                    <td class="font-weight-600">Muhamad Nuruzzaki</td>
                    <td><div class="badge badge-warning">Unpaid</div></td>
                    <td>July 22, 2018</td>
                    <td>
                      <a href="#" class="btn btn-primary">Detail</a>
                    </td>
                  </tr>
                  <tr>
                    <td><a href="#">INV-84990</a></td>
                    <td class="font-weight-600">Agung Ardiansyah</td>
                    <td><div class="badge badge-warning">Unpaid</div></td>
                    <td>July 22, 2018</td>
                    <td>
                      <a href="#" class="btn btn-primary">Detail</a>
                    </td>
                  </tr>
                  <tr>
                    <td><a href="#">INV-87320</a></td>
                    <td class="font-weight-600">Ardian Rahardiansyah</td>
                    <td><div class="badge badge-success">Paid</div></td>
                    <td>July 28, 2018</td>
                    <td>
                      <a href="#" class="btn btn-primary">Detail</a>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
      
      <div class="col-12 col-md-4">
        <div class="card gradient-bottom">
          <div class="card-header">
            <h4>Top 5 Products</h4>
            <div class="card-header-action dropdown">
              <a href="#" data-toggle="dropdown" class="btn btn-danger dropdown-toggle">Month</a>
              <ul class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
                <li class="dropdown-title">Select Period</li>
                <li><a href="#" class="dropdown-item">Today</a></li>
                <li><a href="#" class="dropdown-item">Week</a></li>
                <li><a href="#" class="dropdown-item active">Month</a></li>
                <li><a href="#" class="dropdown-item">This Year</a></li>
              </ul>
            </div>
          </div>
          <div class="card-body" id="top-5-scroll">
            <ul class="list-unstyled list-unstyled-border">
              <li class="media">
                <img class="mr-3 rounded" width="55" src="{{asset('stisla-assets/img/products/product-1-50.png')}}" alt="product">
                <div class="media-body">
                  <div class="float-right"><div class="font-weight-600 text-muted text-small">86 Sales</div></div>
                  <div class="media-title">oPhone S9 Limited</div>
                  <div class="mt-1">
                    <div class="budget-price">
                      <div class="budget-price-square bg-primary" data-width="64%"></div>
                      <div class="budget-price-label">$68,714</div>
                    </div>
                    <div class="budget-price">
                      <div class="budget-price-square bg-danger" data-width="43%"></div>
                      <div class="budget-price-label">$38,700</div>
                    </div>
                  </div>
                </div>
              </li>
              <li class="media">
                <img class="mr-3 rounded" width="55" src="{{asset('stisla-assets/img/products/product-1-50.png')}}" alt="product">
                <div class="media-body">
                  <div class="float-right"><div class="font-weight-600 text-muted text-small">67 Sales</div></div>
                  <div class="media-title">iBook Pro 2018</div>
                  <div class="mt-1">
                    <div class="budget-price">
                      <div class="budget-price-square bg-primary" data-width="84%"></div>
                      <div class="budget-price-label">$107,133</div>
                    </div>
                    <div class="budget-price">
                      <div class="budget-price-square bg-danger" data-width="60%"></div>
                      <div class="budget-price-label">$91,455</div>
                    </div>
                  </div>
                </div>
              </li>
              <li class="media">
                <img class="mr-3 rounded sample-lightbox" width="55" src="{{asset('stisla-assets/img/products/product-1-50.png')}}" alt="product">
                <div class="media-body">
                  <div class="float-right"><div class="font-weight-600 text-muted text-small">63 Sales</div></div>
                  <div class="media-title">Headphone Blitz</div>
                  <div class="mt-1">
                    <div class="budget-price">
                      <div class="budget-price-square bg-primary" data-width="34%"></div>
                      <div class="budget-price-label">$3,717</div>
                    </div>
                    <div class="budget-price">
                      <div class="budget-price-square bg-danger" data-width="28%"></div>
                      <div class="budget-price-label">$2,835</div>
                    </div>
                  </div>
                </div>
              </li>
              <li class="media">
                <img class="mr-3 rounded" width="55" src="{{asset('stisla-assets/img/products/product-1-50.png')}}" alt="product">
                <div class="media-body">
                  <div class="float-right"><div class="font-weight-600 text-muted text-small">28 Sales</div></div>
                  <div class="media-title">oPhone X Lite</div>
                  <div class="mt-1">
                    <div class="budget-price">
                      <div class="budget-price-square bg-primary" data-width="45%"></div>
                      <div class="budget-price-label">$13,972</div>
                    </div>
                    <div class="budget-price">
                      <div class="budget-price-square bg-danger" data-width="30%"></div>
                      <div class="budget-price-label">$9,660</div>
                    </div>
                  </div>
                </div>
              </li>
              <li class="media">
                <img class="mr-3 rounded" width="55" src="{{asset('stisla-assets/img/products/product-1-50.png')}}" alt="product">
                <div class="media-body">
                  <div class="float-right"><div class="font-weight-600 text-muted text-small">19 Sales</div></div>
                  <div class="media-title">Old Camera</div>
                  <div class="mt-1">
                    <div class="budget-price">
                      <div class="budget-price-square bg-primary" data-width="35%"></div>
                      <div class="budget-price-label">$7,391</div>
                    </div>
                    <div class="budget-price">
                      <div class="budget-price-square bg-danger" data-width="28%"></div>
                      <div class="budget-price-label">$5,472</div>
                    </div>
                  </div>
                </div>
              </li>
            </ul>
          </div>
          <div class="card-footer pt-3 d-flex justify-content-center">
            <div class="budget-price justify-content-center">
              <div class="budget-price-square bg-primary" data-width="20"></div>
              <div class="budget-price-label">Selling Price</div>
            </div>
            <div class="budget-price justify-content-center">
              <div class="budget-price-square bg-danger" data-width="20"></div>
              <div class="budget-price-label">Budget Price</div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="row mt-3">
      <div class="col-12">
          {!! Form::label('filePondMulti', 'Multiple Upload', ['class' => 'mb-1']) !!}
          {!! Form::file('filepond[]', ['class' => 'd-block filepond', 'id' => 'filePondMulti', 'multiple', 'data-max-files' => '3', 'data-allow-reorder' => true]) !!}
          <span class="text-danger d-none" id="filePondError"></span>
      </div>
    </div>

    <div class="row mt-3">
        <div class="col-12">
            {!! Form::label('tinyMceContent', 'Tiny MCE', ['class' => 'mb-1']) !!}
            {!! Form::textarea('tiny_mce', null, ['class' => 'form-control', 'id' => 'tinyMceContent']) !!}
        </div>
    </div>

</section>
@endsection

@push('scripts')
    <script>

        $(function () {
            $('#productTable').DataTable({
                processing: true,
                serverSide: false,
                responsive: true
            })
        })

        toastr.success('Welcome')
        const ctx = document.getElementById("myChart").getContext('2d')

        const labels = ["January", "February", "March", "April", "May", "June", "July", "August"]
        const data = {
            labels: labels,
            datasets: [
                {
                    label: 'My First Dataset',
                    data: [65, 59, 80, 81, 56, 55, 40, 99],
                    fill: false,
                    borderColor: 'rgb(75, 192, 192)',
                    tension: 0.1
                },{
                    label: 'My Second Dataset',
                    data: [34, 12, 76, 67, 43, 89, 45, 77],
                    fill: false,
                    borderColor: 'rgb(75, 111, 89)',
                    tension: 0.1
                }
            ]
        }

        const options = {
            legend: {
                display: false
            },
            elements: {
                line: {
                    lineTension: 0
                }
            },
            scales: {
                yAxes: [
                    {
                        gridLines: {
                            // display: false,
                            drawBorder: false,
                            color: '#f2f2f2',
                        },
                        ticks: {
                            beginAtZero: true,
                            stepSize: 1500,
                            callback: function(value, index, values) {
                                return '$' + value;
                            }
                        }
                    }
                ],
                xAxes: [
                    {
                        gridLines: {
                            display: false,
                            tickMarkLength: 15,
                        }
                    }
                ]
            }
        }

        var myLineChart = new Chart(ctx, {
            type: 'line',
            data: data,
            options: options
        });

        const tinyMce = tinymce.init({
            selector: '#tinyMceContent',
            height: "850",
            images_upload_url: "{!! url('tiny-image-upload') !!}",
            relative_urls: false,
            remove_script_host: false,
            convert_urls: true,
            plugins: 'preview paste autolink fullscreen image link media table anchor insertdatetime advlist lists wordcount',
            toolbar: 'undo redo | bold italic strikethrough underline numlist bullist removeformat | fontselect fontsizeselect formatselect | alignleft aligncenter alignright alignjustify | copy paste cut selectall | image | preview',
            image_title: true,
            automatic_uploads: true,
            file_picker_types: 'image',
            content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:14px; line-height: 0.5;}'
        });

        function storeTinyAndForm(submitBtn) {
            let text = tinyMCE.get('articleContent').getContent();
            window.localStorage.setItem('summaryTextArea', text);
            submitBtn.setAttribute('type', 'submit')
            submitBtn.click()
        }

        document.addEventListener('DOMContentLoaded', function() {
            FilePond.registerPlugin(
                FilePondPluginFileEncode,
                FilePondPluginFileValidateSize,
                FilePondPluginFileValidateType,
                FilePondPluginImageExifOrientation,
                FilePondPluginImagePreview
            );

            let options
            let imageUrl
            const url = window.location
            const filePondError = document.getElementById('filePondError')

            if (window.location.href.indexOf("dashboard") > -1) {
                options = {
                    labelIdle: 'Drag & drop gambar atau <span class="filepond--label-action">cari di file manager</span>',
                    acceptedFileTypes: ['image/png', 'image/jng', 'image/jpeg'],
                    maxFileSize: '500KB',
                    server: {
                        revert: (uniqueFileId, load, error) => {
                            let removeDoubleQuote = uniqueFileId.replace(/\\"/g, "|");
                            fetch("{{url('filepond-image-delete')}}" + '/' + removeDoubleQuote.split('/')[0], {
                                method: 'DELETE',
                            })
                            .then(res => res.json()) // or res.json()
                            .then(res => console.log(res))
                            .catch(err => {
                                error('oh my goodness');
                            })

                            load();
                        },
                        process: (fieldName, file, metadata, load, error, progress, abort, transfer, options) => {
                            // fieldName is the name of the input field
                            // file is the actual file object to send
                            const formData = new FormData();
                            formData.append(fieldName, file, file.name);
                        
                            const request = new XMLHttpRequest();
                            request.open('POST', "{{ url('filepond-image-upload') }}");
                        
                            // Should call the progress method to update the progress to 100% before calling load
                            // Setting computable to false switches the loading indicator to infinite mode
                            request.upload.onprogress = (e) => {
                                progress(e.lengthComputable, e.loaded, e.total);
                            };
                        
                            // Should call the load method when done and pass the returned server file id
                            // this server file id is then used later on when reverting or restoring a file
                            // so your server knows which file to return without exposing that info to the client
                            request.onload = function () {
                                if (request.status >= 200 && request.status < 300) {
                                    // the load method accepts either a string (id) or an object
                                    load(request.responseText); 
                                }else{ 
                                    // Can call the error method if something is wrong, should exit after
                                    filePondError.innerHTML = `Gagal mengupload gambar ${request.responseText}`
                                }

                            }; 
                            
                            request.send(formData); // Should expose an abort method so the request can be cancelled
                            return { 
                                abort: ()=> {
                                    // This function is entered if the user has tapped the cancel button
                                    request.abort();
                                    // Let FilePond know the request has been cancelled
                                    abort();
                                },
                            };
                        },
                    }
                }   
            }else{
                imageUrl = <?= json_encode($article->all_image ?? '', true) ?>

                let image_array = []

                for (let i = 0; i < imageUrl.length; i++) { 
                    image_array.push({
                            source: imageUrl[i],
                            options:{
                                type: 'remote'
                            }
                        })
                }
                
                options = {
                    acceptedFileTypes: ['image/png', 'image/jng', 'image/jpeg'],
                    maxFileSize: '500KB',
                    labelIdle: 'Drag & drop gambar atau <span class="filepond--label-action">cari di file manager</span>',
                    files: image_array,
                    server: {
                        revert: (uniqueFileId, load, error) => {
                            let removeDoubleQuote = uniqueFileId.replace(/\\"/g, "|");
                            fetch("{{url('filepond-image-delete')}}" + '/' + removeDoubleQuote.split('/')[0], {
                                method: 'DELETE',
                            })
                            .then(res => res.json()) // or res.json()
                            .then(res => console.log(res))
                            .catch(err => {
                                error('oh my goodness');
                            })

                            load();
                        },
                        process: (fieldName, file, metadata, load, error, progress, abort, transfer, options) => {
                            const formData = new FormData();
                            formData.append(fieldName, file, file.name);
                        
                            const request = new XMLHttpRequest();
                            request.open('POST', "{{ url('filepond-image-upload') }}");
                            
                            request.upload.onprogress = (e) => {
                                progress(e.lengthComputable, e.loaded, e.total);
                            };

                            request.onload = function () {
                                if (request.status >= 200 && request.status < 300) {
                                    // the load method accepts either a string (id) or an object
                                    load(request.responseText); 
                                }else{ 
                                    // Can call the error method if something is wrong, should exit after
                                    filePondError.innerHTML = `Gagal mengupload gambar ${request.responseText}`
                                }

                            }; 
                            
                            request.send(formData); // Should expose an abort method so the request can be cancelled
                            return { 
                                abort: ()=> {
                                    // This function is entered if the user has tapped the cancel button
                                    request.abort();
                                    // Let FilePond know the request has been cancelled
                                    abort();
                                },
                            };
                        },
                    }
                }
            }

            const filePond = FilePond.create(
                document.getElementById('filepondMulti'), options
            );

            filePond.on('warning', (error) => {
                filePondError.classList.remove('d-none')
                if (error.body == 'Max files') {
                    filePondError.innerHTML = 'Maksimal 3 gambar'
                }
            });
        })

    </script>
@endpush
