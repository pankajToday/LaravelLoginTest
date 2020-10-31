@extends('layouts.app')

@section('style')
    <link href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css" rel="stylesheet">
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Dashboard
                    <a href="{{route('productCreate')}}"  style="float: right;">Add Product</a>
                 </div>

                <div class="card-body">
                    @if (session()->get('status'))
                        <div class="alert alert-success" role="alert">
                            <i class="fa-fw fa fa-{{session()->get('status')}}"></i>
                            <strong>  {{session()->get('message')}}</strong>.
                        </div>
                    @endif

                    <table id="example" class="display" style="width:100%">
                        <thead>
                        <tr>
                            <th>Sl. No </th>
                            <th>Product </th>
                            <th>Category</th>
                            <th>Quantity</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>

                        @if(collect($productData)->count())
                            @foreach( $productData as  $i => $productDatum )
                                <tr>
                                    <td> {{ $i+1}} </td>
                                    <td>{{$productDatum->product_name}} - {{$productDatum->product_code}} </td>
                                    <td>{{$productDatum->getCategory?$productDatum->getCategory->category_name:""}}</td>
                                    <td>{{$productDatum->quantity}}</td>
                                    <td>
                                        <a href="{{route('productEdit',$productDatum->id)}}"> Edit</a>
                                        &nbsp     &nbsp    &nbsp
                                        <a href="javascript:deleteConfirm('{{route('productDelete',$productDatum->id)}}')" > Delete</a>
                                    </td>
                                </tr>

                             @endforeach
                        @else
                            <tr>
                                <td colspan="5"> No Product record found!  </td>
                            </tr>
                        @endif
                        </tbody>
                    </table>
                    <br > <br > <hr>
                    {{$productData->links()}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


@section('script')
    <script src="https://code.jquery.com/jquery-3.5.1.js"> </script>
    <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"> </script>

    <script >
        $(document).ready(function() {
            $('#productList').DataTable();
        } );

        function deleteConfirm(url)
        {
            if( confirm("Are you sure about to delete!") )
            {
                window.location=url;
            }

        }

    </script>
@endsection