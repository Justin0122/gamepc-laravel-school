@extends('layouts.app')
@section('content')
    @php
        //if the session updated is set to true, refresh the page and delete the session
        if(session('updated')){
            session()->forget('updated');
            echo '<meta http-equiv="refresh" content="0">';
        }
    @endphp
    <div class="container parts">
        @foreach ($part as $p)
            <div class="header">
                <div class="product-name">
                    <div class="next-previous-component">
                        @php
                            // Get all the components of the current parttype
                            $components = \App\Models\Parts::where('FKPartTypeID', $p->FKPartTypeID)->get();
                            // Get the index of the current part
                            $index = $components->search(function ($item) use ($p) {
                                return $item->PartID == $p->PartID;
                            });
                            // Get the next part
                            if ($index != $components->count() - 1) {
                                $next = $components[$index + 1];
                                // Get the next part's name
                                $nextName = $next->Name;
                                //get the id of the next part
                                $nextId = $next->PartID;
                            }
                            // Get the previous part
                            if ($index != 0) {
                                $previous = $components[$index - 1];
                                // Get the previous part's name
                                $previousName = $previous->Name;
                                //get the id of the previous part
                                $previousId = $previous->PartID;
                            }

                            //get the current parttype name using the parttype id
                            $parttype = \App\Models\Parttype::where('PartTypeID', $p->FKPartTypeID)->first();
                            $parttypeName = $parttype->Name;

                        @endphp
                        <h1>@if($index != 0)
                                <a href="/component/{{$parttypeName}}/{{$previousId}}" title="{{$previousName}}">
                                    <i class="bi bi-arrow-left"></i>
                                </a>

                            @endif
                            {{$p->Name}}
                            @if($index != $components->count() - 1)
                                <a href="/component/{{$parttypeName}}/{{$nextId}}" title="{{$nextName}}">
                                    <i class="bi bi-arrow-right"></i>
                                </a>

                            @endif
                        </h1>

                    </div>
                </div>
            </div>
            <div class="main">

            </div>
            <div class="productImage">
                @include('pc.image-gallery')
            </div>
            <div class="addToPc">
                <div class="product-price">
                    <span class="big-num">€{{ (int)$p->Price }}</span>
                    <span class="small-num">.{{
                            (int)$p->Price === $p->Price
                                ? '00'
                                : (int)round(($p->Price - (int)$p->Price) * 100)
                        }}</span>
                </div>
                <div class="product-stock">{{ $part[0]['Stock'] > 0 ? 'In stock (' . $part[0]['Stock'] . ')' : 'Out of stock' }}</div>

                <div class="action-button">
                    @if(Auth::check())
                        @if (Auth::user()->role == '1')
                            <form method="POST" action="{{ route('product.destroy', $p->PartID) }}">
                                @csrf
                                @method('DELETE')
                                @php
                                    //if only one part is left, disable the delete button
                                    $count = \App\Models\Parts::where('FKPartTypeID', $p->FKPartTypeID)->count();
                                    ($count == 1) ? $disabled = 'disabled' : $disabled = '';
                                @endphp
                                <button type="submit" class="btn btn-danger" {{$disabled}}>Delete</button>
                            </form>
                        @else
                            <form method="POST" action="{{ route('addtopc', $p->PartID) }}">
                                @csrf
                                <button type="submit" class="btn btn-primary buy-button">Add to my PC</button>
                            </form>
                        @endif
                    @endif


                </div>
            </div>
            <div class="specifications">
                <form method="POST" action="{{ route('product.update', $p->PartID) }}" id="product-form">
                    @csrf
                    @method('PUT')
                    <table class="table bg-darkLaravel">
                        <thead>
                        <tr>
                            <th>Specification</th>
                            <th>Value</th>
                            @if (Auth::check())
                                @if (Auth::user()->role == '1')
                                    <th>Update to</th>
                                @endif
                            @endif
                        </tr>
                        </thead>
                        <tbody>
                        @if (Auth::check())
                            @if (Auth::user()->role == '1')
                                <tr>
                                    <td>Name</td>
                                    <td>{{ $p->Name }}</td>
                                    <td><input type="text" name="Name" value="{{ $p->Name }}"></td>
                                </tr>
                                <tr>
                                    <td>Price</td>
                                    <td>{{ $p->Price }}</td>
                                    <td><input type="text" name="Price" value="{{ $p->Price }}"></td>
                                </tr>
                                <tr>
                                    <td>Stock</td>
                                    @php if ($p->FKPartTypeID == 10) $p->Stock = 'N/A';
                                    $disabled = ($p->Stock == 'N/A') ? 'disabled' : '';
                                    @endphp
                                    <td>{{ $p->Stock }}</td>
                                    <td><input type="text" name="Stock" <?php echo $disabled ?> value="{{ $p->Stock }}">
                                    </td>


                                </tr>
                            @endif
                        @endif
                        @foreach ($specifications as $key => $value)
                            <tr>
                                <td>{{ $key }}</td>
                                <td>{{ $value }}</td>
                                @if(Auth::check())
                                    @if (Auth::user()->role == '1')
                                        <td class="form-group">
                                            <input type="" name="Specifications[{{ $key }}]" value="{{ $value }}">
                                        </td>
                                    @endif
                                @endif
                            </tr>
                        @endforeach
                        @if(Auth::check())
                            @if (Auth::user()->role == '1')
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td>
                                        <button type="submit" class="btn btn-primary">Update</button>
                                    </td>
                                </tr>
                            @endif
                        @endif
                        </tbody>
                    </table>
                </form>
            </div>
    </div>
    @endforeach
@endsection
