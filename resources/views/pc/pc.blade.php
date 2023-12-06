@extends('layouts.app')

@section('content')
    @include('pc.filter')

    @php
        if (session('added')) {
            $message = "has been added to your PC.";
            $status = "success! ";
            $type = "success";
        } elseif (session('removed')) {
            $message = "has been removed from your PC.";
            $status = "success! ";
            $type = "info";
        }
        //unset the sessions

    @endphp

            <!-- if "added" session is set, show a message -->
    <div class="products container">
        @if (session('added') || session('removed'))
            @include('layouts.message')

        @endif
        @php
            session()->forget('added');
            session()->forget('removed');
            $totalPrice = [];
            $hasOutOfStock = false;
                $data = [];
                foreach ($types as $partType) {
                    //if parttype is casecooler, change it to case cooler
                    if ($partType == 'casecooler') {
                        $partType = 'case cooler';
                    }
                    if ($partType == 'cpucooler') {
                        $partType = 'cpu cooler';
                    }
                    $product = null;
                    $price = '';
                    $stock = '';
                    $partID = '';
                    $button = '<button class="btn btn-primary" onclick="window.location.href=\'/parttype/'.$partType.'\'"><i class="bi bi-plus-lg"></i></button>';
                    $delbutton = '';
                    foreach ($components as $p) {
                        if ($p->partTypeName == $partType) {
                            $product = $p->Name;
                            $price = $p->Price;
                            array_push($totalPrice, $p->Price);
                            $stock = $p->Stock;
                            $partID = $p->PartID;
                            $button = '<button class="btn btn-warning" onclick="window.location.href=\'/parttype/'.$partType.'\'"><i class="bi bi-pencil-square"></i></button>';
                        }
                    }
                    $data[] = [
                        'type' => $partType,
                        'product' => $product,
                        'price' => $price,
                        'stock' => $stock,
                        'partID' => $partID,
                        'button' => $button,
                        'delbutton' => $delbutton,
                    ];
                }
        @endphp
        <table class="table bg-darkLaravel">
            <thead>
            <tr>
                <th scope="col">Component</th>
                <th scope="col">Product</th>
                <th scope="col">Price</th>
                <th scope="col">Stock</th>
                <th scope="col" id="iconRow"></th>
                <th scope="col" id="iconRow"></th>
            </tr>
            </thead>
            <tbody>
            @foreach ($data as $d)
                <tr>
                    <td>{{ $d['type'] }}</td>
                    <td>
                        @if ($d['product'])
                            <a href='/component/{{$d['type']}}/{{$d['partID']}}'>{{ $d['product'] }}</a>
                        @endif
                    </td>
                    <td>{{ $d['price'] }}</td>
                    <td>
                        @if ($d['product'] != null)
                            <!-- show N/A for os -->
                            @if ($d['type'] == 'os')
                                N/A
                            @else
                                <span class="text-{{ $d['stock'] == 0 ? 'danger' : ($d['stock'] < 5 ? 'info' : 'success') }}">
                            {{ $d['stock'] == 0 ? 'Out of stock': ($d['stock'] < 5 ? 'Low stock' : 'In stock') }}
                                    @if ($d['stock'] == 0)
                                        @php
                                            $hasOutOfStock = true;
                                        @endphp
                                    @endif
                            </span>
                            @endif
                        @endif
                    </td>
                    <td>{!! $d['button'] !!}</td>
                    @if ($d['product'] != null)
                        <td>
                            <form action="/pc/{{$d['type']}}/{{$d['partID']}}" method="POST">
                                @csrf
                                @method('PUT')
                                <button class=" btn btn-danger" type="submit"><i class="bi bi-trash"></i></button>
                            </form>
                        </td>
                    @endif
                </tr>
            @endforeach
            <tr>
                <td>Total</td>
                <td></td>
                <td>{{ array_sum($totalPrice) }}</td>
                <td>
                    <form action="/order" method="POST">
                        @csrf
                        <button class="btn btn-success"
                                type="submit" {{ count($totalPrice) <= 1 || $hasOutOfStock ? 'disabled' : '' }}>
                            Order
                        </button>
                    </form>
                </td>
                <td></td>
                <td></td>
            </tr>
            </tbody>
        </table>

    </div>
@endsection