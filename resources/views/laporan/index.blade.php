@extends('layout.index',(['title'=> 'Laporan Transaksi']))
@section('content')
    <div class="mt-3 p-2 row">
        <h2 class="col">Laporan Transaksi</h2>
    </div>
    <div class="p-2 bg-light">
        <div class="d-print-none">
            <div class="row align-items-end">
                <h4>Filter</h4>
                <div class="col-3">
                    <label for="filter">Nasabah:</label>
                    <select class="form-control" wire:model="filter" id="filter" name="account_id">
                        <option value="">Semua <i class="bi bi-collection"></i></option>
                        @foreach ($nasabah as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-6">
                    <label for="dateRange">Date:</label>
                    <div class="input-group input-daterange">
                        <input type="text" class="form-control" name="dateStart" placeholder="{{ $start }}"
                            autocomplete="off" data-provide="datepicker" data-date-autoclose="true"
                            data-date-format="mm/dd/yyyy" data-date-today-highlight="true">
                        <div class="input-group-addon">to</div>
                        <input type="text" class="form-control" name="dateEnd" placeholder="{{ $end }}"
                            autocomplete="off" data-provide="datepicker" data-date-autoclose="true"
                            data-date-format="mm/dd/yyyy" data-date-today-highlight="true">
                    </div>
                </div>
                <div class="col-2">
                    <button class="btn btn-secondary" type="submit">Filter</button>
                    <button class="btn btn-warning" onclick="window.print()">Print</button>
                </div>
            </div>
            <hr>
        </div>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Transaction Date</th>
                    <th scope="col">Description</th>
                    <th scope="col">Credit</th>
                    <th scope="col">Debit</th>
                    <th scope="col">Amount</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($transaksi as $item)
                    <tr>
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td>{{ App\Helpers\Helpers::dateFormat($item->transaction_date) }}</td>
                        <td>{{ $item->description }}</td>
                        <td>
                            @if ($item->status == 'C')
                                Rp. {{ number_format($item->amount, 2) }}
                            @else
                                -
                            @endif
                        </td>
                        <td>
                            @if ($item->status == 'D')
                                Rp. {{ number_format($item->amount, 2) }}
                            @else
                                -
                            @endif
                        </td>
                        <td>Rp. {{ number_format($item->amount, 2) }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center">Data Kosong</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
@push('css')
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css"
        integrity="sha512-mSYUmp1HYZDFaVKK//63EcZq4iFWFjxSL+Z3T/aCt4IO9Cejm03q3NKKYN6pFQzY0SBOr8h+eCIAZHPXcpZaNw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-print-css/css/bootstrap-print.min.css"
        media="print">
@endpush
@push('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.js"
        integrity="sha512-n/4gHW3atM3QqRcbCn6ewmpxcLAHGaDjpEBu4xZd47N0W2oQ+6q7oc3PXstrJYXcbNU1OHdQ1T7pAP+gi5Yu8g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"
        integrity="sha512-T/tUfKSV1bihCnd+MxKD0Hm1uBBroVYBOYSk1knyvQ9VyZJpc/ALb4P0r6ubwVPSGB2GvjeoMAJJImBG12TiaQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        $('.input-daterange input').each(function() {
            $(this).datepicker();
        });
    </script>
@endpush
