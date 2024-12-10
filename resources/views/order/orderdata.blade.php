@extends('tamplete.navbar', ['title' => 'Order Data'])
@section('content-dinamis')
    <div class="container mt-5" style="width: 75%">
        <div class="d-flex justify-content-between">
            <h3>History</h3>
            <div class="d-flex" style="gap: 200px">
                <form action="" class="d-flex">
                    <input type="date" name="search" placeholder="search" aria-label="search" class="form-control">
                    <button class="btn btn-light ms-2" type="submit">Search</button>
                    <a href="{{ route('orders') }}" class="btn btn-danger ms-2">Clear</a>
                </form>
            </div>
            <a href="{{ route('orders.create') }}" class="btn btn-dark">+ add purchases</a>
        </div>
        <div class="mt-4">
            <table class="table table-striped">
                <head>
                    <tr>
                        <th>No</th>
                        <th>Buyer's name</th>
                        <th>Crochets</th>
                        <th>Total price</th>
                        <th>Purchase date</th>
                        <th>Action</th>
                    </tr>
                </head>
                <body>
                    @foreach ($order as $index => $item)
                        <tr>
                            <td> {{ $index + 1 }} </td>
                            <td> {{ Auth::user()->name }} </td>
                            <td> {{ $item['name_customer'] }} </td>
                            <td> @php
                                $crochets = $item['crochets'];
                                $detailCrochet = [];
                                foreach ($crochets as $crochet) {
                                    $detailCrochet [] = '->' . $crochet['name_crochet'] . '(Rp.' . number_format($crochet['sub_price'], 0, ',', '.') 
                                    . ') = Rp.' . number_format($crochet['price'], 0, ',', '.') . '<small class="text-success"> qty' . $crochet['qyt'] . '</small>' ;
                                }
                                $nameCrochet = implode('<br>', $detailCrochet);
                                @endphp
                                {!! $nameCrochet !!}
                            </td>
                            <td> {{ \Carbon\Carbon::parse($item->created_at)->format('d F Y') }} </td>
                            <td><a href="{{ route('download', $item['id']) }}" class="btn btn-secondary">Download</a></td>
                            
                        </tr>
                    @endforeach
                </body>
            </table>
            <div class="d-flex justify-content-end mt-3 mb-3">
                {{ $order->links() }}
            </div>
        </div>
    </div>
@endsection