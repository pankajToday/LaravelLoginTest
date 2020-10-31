@extends('layouts.app')

@section('style')
    <link href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css" rel="stylesheet">
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Product Detail</div>

                <div class="card-body">
                   <form role="form" method="post" action="{{route('productStore')}}" enctype="multipart/form-data">
                       @csrf

                       <div class="form-group row">
                           <label for="product_name" class="col-md-2 col-12  col-sm-6 col-form-label text-md-right">{{ __('Name') }}</label>
                           <div class="col-4  ">
                               <input type="text" name="product_name" class="form-control  @error('product_name') is-invalid @enderror"
                                      maxlength="50"  >

                               @error('product_name')
                               <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                               @enderror
                           </div>
                       </div>

                       <div class="form-group row">
                           <label for="product_code" class="col-md-2 col-form-label text-md-right">{{ __('Code') }}</label>
                           <div class="col-4">
                               <input type="text" name="product_code" class="form-control @error('product_code') is-invalid @enderror"
                                      maxlength="50"  >

                               @error('product_code')
                               <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                               @enderror
                           </div>
                       </div>

                       <div class="form-group row">
                           <label for="category_id" class="col-md-2 col-form-label text-md-right">{{ __('Category') }}</label>
                           <div class="col-4">
                               <select name="category_id" class="form-control @error('category_id') is-invalid @enderror">
                                   <option value="" selected >Select Category</option>
                                   @if( collect($categories)->count())
                                       @foreach(  $categories as $item)
                                           <option value="{{$item->id}}" >{{$item->category_name}}</option>
                                       @endforeach
                                   @endif
                               </select>

                               @error('category_id')
                               <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                               @enderror
                           </div>
                       </div>

                       <div class="form-group row">
                           <label for="quantity" class="col-md-2 col-form-label text-md-right">{{ __('Quantity') }}</label>
                           <div class="col-4">
                               <input type="text" name="quantity" class="form-control @error('quantity') is-invalid @enderror"
                                      maxlength="3"  >

                               @error('quantity')
                               <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                               @enderror
                           </div>
                       </div>


                       <div class="form-group row">
                           <label for="price" class="col-md-2 col-form-label text-md-right">{{ __('price') }}</label>
                           <div class="col-4">
                               <input type="text" name="price" class="form-control @error('price') is-invalid @enderror"
                                      maxlength="10" >

                               @error('price')
                               <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                               @enderror
                           </div>
                       </div>

                       <div class="form-group row">
                           <label for="product_image" class="col-md-2 col-form-label text-md-right">{{ __('Product Image') }}</label>
                           <div class="col-4">
                               <input type="file" name="product_image" class="form-control  @error('product_image') is-invalid @enderror"
                                   accept=".jpeg,.jpg,.png"  >

                               @error('product_image')
                               <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                               @enderror
                           </div>
                       </div>


                       <div class="form-group row">
                           <label for="description" class="col-md-2 col-form-label text-md-right">{{ __('description') }}</label>
                           <div class="col-4">
                            <textarea name="description" class="form-control @error('description') is-invalid @enderror"
                              rows="3" ></textarea>

                               @error('description')
                               <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                               @enderror
                           </div>
                       </div>

                       <div class="form-group row">
                           <div class="col-8 text-md-center">
                             <input type="submit" value="Save" class="btn btn-danger">
                                        &nbsp     &nbsp    &nbsp
                               <a href="{{route('home')}}"  class="btn btn-primary ">Cancel</a>
                           </div>
                       </div>
                   </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection


@section('script')


    <script >

    </script>
@endsection