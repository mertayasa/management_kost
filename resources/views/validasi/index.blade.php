@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <h4>Validasi Data</h4>
                    </div>
                    <div class="col-12">
                        @include('layouts.flash')
                    </div>
                    <div class="card-body">
                        <div class="container px-0">
                            <div class="bs-example">
                                <ul class="nav nav-tabs">
                                    <li class="nav-item">
                                        <a href="#sewaTab"
                                            class="nav-link {{ $active_tab == 'sewaTab' || $active_tab == null ? 'active' : '' }}"
                                            data-toggle="tab">Data Sewa</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#pemasukanTab"
                                            class="nav-link {{ $active_tab == 'pemasukanTab' ? 'active' : '' }}"
                                            data-toggle="tab">Data Pemasukan</a>
                                    </li>
                                    {{-- <li class="nav-item">
                                        <a href="#announcementTab" class="nav-link" data-toggle="tab">Pengumuman</a>
                                    </li> --}}
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane fade {{ $active_tab == 'sewaTab' || $active_tab == null ? 'show active' : '' }}"
                                        id="sewaTab">
                                        <div class="card-body px-0">
                                            @include('sewa.datatable_inactive')
                                        </div>
                                    </div>
                                    <div class="tab-pane fade {{ $active_tab == 'pemasukanTab' ? ' show active' : '' }}"
                                        id="pemasukanTab">
                                        <div class="card-body px-0">
                                            @include('pemasukan.datatable_inactive')
                                        </div>
                                    </div>
                                    {{-- <div class="tab-pane fade" id="announcementTab">
                                        <div class="card-body px-0">
                                          <p>vxcvxc</p>
                                            @include('announcement.datatable_inactive')
                                        </div>
                                    </div> --}}
                                </div>
                            </div>
                        </div>
                        {{-- @include('sewa.datatable') --}}
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        function updateStatus(url, promptText, tableid) {
            Swal.fire({
                title: "Warning",
                text: promptText,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#169b6b',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya',
                cancelButtonText: 'Tidak'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: url,
                        method: 'patch',
                        data: {
                            "status": "1",
                            "_token": "{{ csrf_token() }}"
                        },
                        dataType: 'json',
                        success: function(data) {
                            if (data.code == 1) {
                                showToast(data.code, data.message)
                            } else {
                                showToast(data.code, data.message)
                            }

                            $(`#${tableid}`).DataTable().ajax.reload()
                        }
                    })
                }
            })
        }

        function declineData(url, promptText, tableId) {
            let table = tableId
            Swal.fire({
                title: 'Tolak Data',
                text: promptText,
                input: 'text',
                inputAttributes: {
                    autocapitalize: 'off'
                },
                showCancelButton: true,
                confirmButtonText: 'Simpan',
                cancelButtonText: 'Batal',
                confirmButtonColor: '#d33',
                cancelButtonColor: '#169b6b',
                showLoaderOnConfirm: true,
                preConfirm: (alasan) => {
                    // return fetch(`//api.github.com/users/${login}`)
                    return fetch(url, {
                        method: 'PATCH',
                        headers: {
                            'Content-Type': 'application/json',
                            "X-CSRF-Token": "{{csrf_token()}}"
                        },
                        body: JSON.stringify({
                            status: 2,
                            alasan: alasan,
                        }),
                    })
                    .then(response => {
                        if (!response.ok) {
                            throw new Error(response.statusText)
                        }
                        return response.json()
                    })
                    .catch(error => {
                        Swal.showValidationMessage(
                            `Gagal mengubah validasi data`
                        )
                    })
                },
                allowOutsideClick: () => !Swal.isLoading()
            }).then((result) => {
                if (result.isConfirmed) {
                    if (result.value.code == 1) {
                        showToast(result.value.code, result.value.message)
                    } else {
                        showToast(result.value.code, result.value.message)
                    }

                    $(`#${table}`).DataTable().ajax.reload()
                }
            })
        }
        
    </script>
@endpush

@include('layouts.datatable_tab_js')
