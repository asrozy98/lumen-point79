@extends('layout.index',(['title'=> 'Transaksi']))
@section('content')
    <div class="mt-3 p-2 row">
        <h2 class="col">Transaksi</h2>
        <div class="col-md-auto">
            <div class="col-md-auto">
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addTransaksi">Tambah
                    Transaksi</button>
                <!-- Modal -->
                <div class="modal fade" id="addTransaksi" tabindex="-1" aria-labelledby="addTransaksiLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="addTransaksiLabel">Tambah Transaksi</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label for="account_id" class="form-label">Nasabah</label>
                                    <select class="form-select" id="account_id">
                                        <option value="" selected>Pilih Nasabah</option>
                                        @foreach ($nasabah as $item)
                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="description" class="form-label">Description</label>
                                    <input type="text" class="form-control" id="description">
                                </div>
                                <div class="mb-3">
                                    <label for="type" class="form-label">Type</label>
                                    <select class="form-select" id="type">
                                        <option selected>Pilih Type</option>
                                        <option value="D">Debit</option>
                                        <option value="C">Credit</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="amount" class="form-label">Amount</label>
                                    <input type="text" class="form-control" id="amount">
                                </div>
                                <label for="dateRange">Date:</label>
                                <div class="input-group input-daterange">
                                    <input type="text" class="form-control" id="date"
                                        placeholder="{{ Carbon\Carbon::now()->format('m/d/Y') }}" autocomplete="off"
                                        data-provide="datepicker" data-date-autoclose="true" data-date-format="mm/dd/yyyy"
                                        data-date-today-highlight="true">
                                </div>
                                <button onclick="transaksiSave()" class="btn btn-primary mt-3"
                                    data-bs-dismiss="modal">Simpan</button>
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
                    <th scope="col">Nasabah</th>
                    <th scope="col">Transaction Date</th>
                    <th scope="col">Description</th>
                    <th scope="col">Debit Credit</th>
                    <th scope="col">Amount</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($transaksi as $item)
                    <tr>
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td>{{ $item->nasabah->name }}</td>
                        <td>{{ App\Helpers\Helpers::dateFormat($item->transaction_date) }}</td>
                        <td>{{ $item->description }}</td>
                        <td>{{ $item->status }}</td>
                        <td>Rp. {{ number_format($item->amount, 2) }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="text-center">Data Kosong</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        {{ $transaksi->links() }}
    </div>
@endsection
@push('css')
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css"
        integrity="sha512-mSYUmp1HYZDFaVKK//63EcZq4iFWFjxSL+Z3T/aCt4IO9Cejm03q3NKKYN6pFQzY0SBOr8h+eCIAZHPXcpZaNw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
@endpush
@push('js')
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"
        integrity="sha512-T/tUfKSV1bihCnd+MxKD0Hm1uBBroVYBOYSk1knyvQ9VyZJpc/ALb4P0r6ubwVPSGB2GvjeoMAJJImBG12TiaQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        $('.input-daterange input').each(function() {
            $(this).datepicker();
        });

        function transaksiSave() {
            var account_id = $('#account_id').val();
            var description = $('#description').val();
            var amount = $('#amount').val();
            var type = $('#type').val();
            var date = $('#date').val();
            $.ajax({
                url: "{{ url('transaksi') }}",
                type: "post",
                data: {
                    "account_id": account_id,
                    "description": description,
                    "amount": amount,
                    "type": type,
                    "date": date,
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
