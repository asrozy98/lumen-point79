@extends('layout.index',(['title'=> 'Nasabah']))
@section('content')
    <div class="mt-3 p-2 row">
        <h2 class="col">Nasabah</h2>
        <div class="col-md-auto">
            <div class="col-md-auto">
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addTransaksi">Tambah
                    Nasabah</button>
                <!-- Modal -->
                <div class="modal fade" id="addTransaksi" tabindex="-1" aria-labelledby="addTransaksiLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="addTransaksiLabel">Tambah Nasabah</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                {{-- <form> --}}
                                <div class="mb-3">
                                    <label for="name" class="form-label">Nama</label>
                                    <input type="text" class="form-control " id="name">
                                </div>
                                <button onclick="nasabahSave()" class="btn btn-primary"
                                    data-bs-dismiss="modal">Simpan</button>
                                {{-- </form> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="p-2 bg-light">
        <hr>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">ID</th>
                    <th scope="col">Nama</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($nasabah as $item)
                    <tr>
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->name }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="text-center">Data Kosong</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
@push('js')
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function nasabahSave() {
            var name = $('#name').val();
            console.log(name);
            $.ajax({
                url: "{{ url('nasabah') }}",
                type: "post",
                data: {
                    "name": name
                },
                dataType: 'json',
                success: function(res) {
                    Swal.fire({
                        icon: res.type,
                        title: res.message
                    });
                    setTimeout(location.reload.bind(location), 5000);
                },
                error: function(res) {
                    Swal.fire({
                        icon: res.type,
                        title: res.message
                    });
                }
            })
        }
    </script>
@endpush
