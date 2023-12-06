@extends('layouts.app')
@php use Illuminate\Support\Facades\DB;

    $b = [];
    $brands = DB::table('brands')->get();
    foreach ($brands as $brand) {
        $b[$brand->BrandId] = $brand->Name;
    }
@endphp
@section('content')

    <!-- include the filter -->
    @include('pc.filter')
    <div class="products container">
        <table class="table bg-darkLaravel">
            <thead>
            <tr>
                <th scope="col">{{ $parttype . (substr($parttype, -1) === 's' ? '' : 's') }}</th>
                <th scope="col" id="imageRow">Image</th>
                <th scope="col">Brand</th>
                <th scope="col">Stock</th>
                <th scope="col">Price</th>
                @php try{ @endphp
                @if (Auth::user()->role == '1')
                    <th scope="col" id="iconRow">
                        <button type="button" class="btn btn-primary addcomponent" data-bs-toggle="modal"
                                data-bs-target="#addPartModal"><i class="bi bi-plus-lg"></i></button>
                    </th>
                @else
                    <th scope="col" id="iconRow">Actions</th>
                @endif
                @php }catch(Exception $e){ @endphp
                <th scope="col" id="iconRow">Actions</th>
                @php } @endphp
            </tr>
            </thead>

            <tbody>
            @foreach ($parts as $c)
                <tr class="component-row" onclick="location.href='/component/{{$parttype}}/{{ $c->PartID }}'">
                    <td class="productLink">
                        {{ $c->Name }}
                    </td>
                    <td class="imageRow">
                        @php
                            echo file_exists('product_images/'.$c->Name.'.png')
                                ? '<img loading="lazy" class="productImage" id="parttypeTable" src="'.asset('product_images/'.$c->Name.'.png').'" alt="'.$c->Name.'">'
                                : '<img loading="lazy" class="productImage" id="parttypeTable" src="'.asset('img/placeholder.png').'" alt="placeholder of '.$c->Name.'">';
                        @endphp
                    </td>

                    <td>{{ $b[$c->FKBrandID] }}</td>
                    <td>
                        <!-- if page is OS, show N/A -->
                        @if ($parttype == 'os')
                            N/A
                        @else
                            <span class="text-{{ $c->Stock == 0 ? 'danger' : ($c->Stock < 5 ? 'warning' : 'success') }}">
                        {{ $c->Stock }}
                        </span>
                        @endif
                    </td>
                    <td class="price">
                        <span class="big-num">€{{ (int)$c->Price }}</span>
                        <span class="small-num">.{{
                            (int)$c->Price === $c->Price
                                ? '00'
                                : (int)round(($c->Price - (int)$c->Price) * 100)
                        }}</span>

                    </td>
                    <td class="iconRow">
                        @if(Auth::check())
                            @if (Auth::user()->role == '1')
                                <a>
                                    <form method="POST" action="{{ route('product.destroy', $c->PartID) }}">
                                        @csrf
                                        @method('DELETE')
                                        @php
                                            //if there is only one part left of that parttype, the delete button is disabled
                                            (count($parts) == 1)
                                                ? $disabled = 'disabled'
                                                : $disabled = '';
                                            //button to delete a part
                                            echo '<button class="btn btn-danger" '.$disabled.'><i class="bi bi-trash"></i></button>';
                                        @endphp
                                    </form>
                                </a>

                            @else
                                @php
                                    $user = Auth::user();
                                    $parttype = str_replace(' ', '', $parttype);
                                    $productInPC = DB::table('my_pcs')->where('FKUserID', $user->id)->where('FK'.$parttype.'ID', $c->PartID)->exists();
                                @endphp
                                @if ($productInPC)
                                    <a href="/component/{{ $parttype }}/{{ $c->PartID }}">
                                        <!-- put a button to go to the component page with bi bi-eye and set the session "alreadyInPC" to true -->
                                        <button type="button" class="btn btn-secondary">
                                            <i class="bi bi-eye"></i>
                                        </button>
                                    </a>
                                @else
                                    <form action="/addcomponent/{{ $c->PartID }}" method="post">
                                        @csrf
                                        <button type="submit" class="btn btn-primary"><i class="bi bi-plus-lg"></i>
                                        </button>
                                    </form>
                                @endif

                            @endif
                        @endif
                    </td>
                </tr>
                @include('pc.addComponent-modal', ['c' => $c])
            @endforeach
            </tbody>
        </table>
        <div class="my-pagination">
            {{ $parts->links() }}
        </div>
    </div>

@endsection