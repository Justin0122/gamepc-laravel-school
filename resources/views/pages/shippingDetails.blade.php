@extends('layouts.app')

@section('content')
    <div class="container">
        <form action="{{ route('shippingDetails.update', $shippingDetails->id) }}" method="post">
            @csrf
            @method('PUT')
            <table class="table bg-darkLaravel">
                <thead>
                <tr>
                    <th>Property</th>
                    <th>Value</th>
                    <th>Update to</th>
                </tr>
                </thead>
                <tbody>
                @foreach(['name', 'address', 'city', 'country', 'state', 'zip', 'phone'] as $property)
                    <tr>
                        <td>{{ ucfirst($property) }}</td>
                        <td>{{ !empty($shippingDetails->{$property}) ? $shippingDetails->{$property} : '' }}</td>
                        <td><input type="text" name="{{ $property }}" value="{{ $shippingDetails->{$property} }}"></td>
                    </tr>
                @endforeach
                <tr>
                    <td></td>
                    <td></td>
                    <td>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </td>
                </tr>
                </tbody>
            </table>
        </form>

    </div>
@endsection