@extends('layout.index',(['title'=> 'Transaksi']))
@section('content')
    <div class="mt-3 p-2 row">
        <h2 class="col">Poin Transaksi</h2>
    </div>
    <div class="p-2 bg-light">
        <hr>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">ID</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Total Poin</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($nasabah as $item)
                    <tr>
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->name }}</td>
                        <td>{{ App\Helpers\Helpers::poin($item->id) }}</td>
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
