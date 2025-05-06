@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-body">
        <center><h1>EDIT DATA PEMBAYARAN</h1></center>
        <form action="/pembayaran/{{ $pembayaran->id }}" method="post">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="pelanggan_id">Pelanggan</label>
                <select class="form-select" name="pelanggan_id" id="pelanggan_id" required>
                    @foreach ($pelanggan as $p)
                        <option value="{{ $p->id }}" {{ $pembayaran->pelanggan_id == $p->id ? 'selected' : '' }}>
                            {{ $p->nama }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="total_harga">Total Harga</label>
                <input class="form-control" type="number" name="total_harga" id="total_harga" step="0.01" 
                value="{{ $pembayaran->total_harga }}" required>
            </div>

            <div class="mb-3">
                <label for="metode_pembayaran">Metode Pembayaran</label>
                <input class="form-control" type="text" name="metode_pembayaran" id="metode_pembayaran" 
                value="{{ $pembayaran->metode_pembayaran }}" required>
            </div>

            <div class="mb-3">
                <label for="alamat_pengiriman">Alamat Pengiriman</label>
                <input class="form-control" type="text" name="alamat_pengiriman" id="alamat_pengiriman" 
                value="{{ $pembayaran->alamat_pengiriman }}" required>
            </div>

            <div class="mb-3">
                <label for="status">Status</label>
                <select class="form-select" name="status" id="status" required>
                    <option value="pending" {{ $pembayaran->status == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="diproses" {{ $pembayaran->status == 'diproses' ? 'selected' : '' }}>Diproses</option>
                    <option value="dikirim" {{ $pembayaran->status == 'dikirim' ? 'selected' : '' }}>Dikirim</option>
                    <option value="selesai" {{ $pembayaran->status == 'selesai' ? 'selected' : '' }}>Selesai</option>
                </select>
            </div>

            <button class="btn btn-primary" type="submit">UBAH PEMBAYARAN</button>
        </form>
    </div>
</div>
@endsection
