@extends('layout.app')

@section('title') Product Details | E-Shopper @endsection
@section('content')
    <section>

        </div><!--/category-products-->
            <div class="container">
                <div class="row">
                    <div class="col-sm-3">
                        <div class="left-sidebar">
                            <h2>Category</h2>
                            <div class="panel-group category-products" id="accordian"><!--category-productsr-->
                                @foreach($sidebar as $key=>$data)
{{--                                    {{dd($sidebar)}}--}}
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <h4 class="panel-title">
                                                <a data-toggle="collapse" data-parent="#accordian"
                                                   href="#{{ 'category_' . $newKey = str_replace(" ", "", $key) }}">
                                                    <span class="badge pull-right"><i class="fa fa-plus"></i></span>
                                                    {{$key}}
                                                </a>
                                            </h4>
                                        </div>
                                        <div id="{{ 'category_' . $newKey = str_replace(" ", "", $key) }}" class="panel-collapse collapse">
                                            <div class="panel-body">
                                                <ul>
                                                    @foreach($data as $value)
                                                        <li><a href="{{ route('request', ['value' => $value]) }}">{{$value}}</a></li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div><!--/category-products-->

                        <div class="brands_products"><!--brands_products-->
                            <h2>Brands</h2>
                            <div class="brands-name">
                                <ul class="nav nav-pills nav-stacked">
                                    <li><a href="#"> <span class="pull-right">(50)</span>Acne</a></li>
                                    <li><a href="#"> <span class="pull-right">(56)</span>Grüne Erde</a></li>
                                    <li><a href="#"> <span class="pull-right">(27)</span>Albiro</a></li>
                                    <li><a href="#"> <span class="pull-right">(32)</span>Ronhill</a></li>
                                    <li><a href="#"> <span class="pull-right">(5)</span>Oddmolly</a></li>
                                    <li><a href="#"> <span class="pull-right">(9)</span>Boudestijn</a></li>
                                    <li><a href="#"> <span class="pull-right">(4)</span>Rösch creative culture</a></li>
                                </ul>
                            </div>
                        </div><!--/brands_products-->

                        <div class="price-range"><!--price-range-->
                            <h2>Price Range</h2>
                            <div class="well">
                                <div class="span2" value="" data-slider-min="0" data-slider-max="600"
                                      data-slider-step="5" data-slider-value="[{{ request('min_price', 0) }},{{ request('max_price', 600) }}]" id="sl2" ></div><br />
                                <b>$ 0</b> <b class="pull-right">$ 600</b>
                            </div>
                        </div><!--/price-range-->
                    </div>
                </div>

                <div class="col-sm-9 padding-right">
                    <div class="features_items"><!--features_items-->
                        <h2 class="title text-center">Features Items</h2>
                        @foreach($watches as $watch)
                        <div class="col-sm-4">
                            <a href="{{ route('product', ['watch_id' => $watch->id]) }}">
                                <div class="product-image-wrapper">
                                    <div class="single-products">
                                        <div class="productinfo text-center">
                                            <img src="{{ $watch->image }}" alt="" />
                                            <h2>{{ $watch->price }} </h2>
                                            <p>{{ $watch->title }}</p>
                                            <a href="{{ route('product', ['watch_id' => $watch->id]) }}" class="btn btn-default add-to-cart"><i
                                                    class="fa fa-shopping-cart"></i>Смотреть</a>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        @endforeach
                        <ul class="pagination">
                            <li>{{ $watches->links('vendor.pagination.custom') }}</li>
                        </ul>
                    </div><!--features_items-->
                </div>
            </div>
        </div>
    </section>
    <form action="" method="GET" id="product-form">
        <input type="hidden" name="min_price" value="{{ request('min_price', 0) }}">
        <input type="hidden" name="max_price" value="{{ request('max_price', 600) }}">
    </form>
@endsection

@section('script')
        <script type="text/javascript">
            $('#sl2').slider()
                .on('slideStop', function(ev){
                    $('input[name="min_price"]').val(ev.value[0])
                    $('input[name="max_price"]').val(ev.value[1])

                    $('#product-form').submit()
                });
        </script>
@endsection
