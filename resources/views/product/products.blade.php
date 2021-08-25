@extends('layout.app')

@section('title') Product Details | E-Shopper @endsection
@section('content')
    <style>
        div.panel-body div:nth-child(n+7) {
            display: none;
        }
    </style>
    <section>
        </div><!--/category-products-->
        <div class="container">
            <div class="row">
                <div class="col-sm-3">
                    <div class="left-sidebar">
                        <h2>Category</h2>
                        <div class="panel-group category-products" id="accordian"><!--category-productsr-->
                            @foreach($sidebar as $key=>$data)
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                            <a data-toggle="collapse" data-parent="#accordian"
                                               href="#{{'category_' . $newKey = str_replace(" ", "", $key)}}">
                                                <span class="badge pull-right"><i class="fa fa-plus"></i></span>
                                                {{$key}}
                                            </a>
                                        </h4>
                                    </div>
                                    <div id="{{ 'category_' . $newKey = str_replace(" ", "", $key) }}"
                                         class="panel-collapse collapse">
                                        <div class="panel-body">
                                            @foreach($data as $value)
                                                <div class="form-group full-width" data-category="{{$key}}">
                                                    <input type="checkbox" name="filters" class="form-check-input"
                                                           data-value-id="{{ $value }}">
                                                    <label class="form-check-label"
                                                           for="exampleCheck1">{{$value}}</label>
                                                </div>
                                            @endforeach
                                            @if(count($data) > 8)
                                                <a class="see-more"><span>See more</span></a>
                                                <a class="see-less hide"><span>See Less</span></a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <!--/brands_products-->

                        <div class="price-range"><!--price-range-->
                            <h2>Price Range</h2>
                            <div class="well">
                                <div class="span2" value="" data-slider-min="0" data-slider-max="600"
                                     data-slider-step="5"
                                     data-slider-value="[{{ request('min_price', 0) }},{{ request('max_price', 600) }}]"
                                     id="sl2"></div>
                                <br/>
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
                                                <img class="img" src="{{ $watch->image }}" alt=""/>
                                                <h2 class="price">${{ $watch->price }} </h2>
                                                <p class="title">{{ $watch->title }}</p>
                                                <a href="{{ route('product', ['watch_id' => $watch->id]) }}"
                                                   class="btn btn-default add-to-cart"><i
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
            .on('slideStop', function (ev) {
                $('input[name="min_price"]').val(ev.value[0])
                $('input[name="max_price"]').val(ev.value[1])

                $('#product-form').submit()
            });

        $(function () {
            $('.see-more').click(function () {
                $('.panel-body div:hidden').slice(0, 6).show();
                if ($('#category_Brands div').length - 1 == $('.panel-body div:visible').length) {
                    $('.see-more').hide();
                    $('.see-less').show();
                }
            });
        });

        $('input[type=checkbox]').change(function () {
            let selected;

            if (this.checked) {
                let checked = new Array();
                $("input:checkbox[name=filters]:checked").each(function () {
                    let key = $(this).parent().data('category');
                    let value = $(this).data('value-id');
                    let obj = {};
                    obj[key] = value;
                    checked.push(obj);
                });
                selected = checked;
                let stringSelected = JSON.stringify(selected)

                let route = "{{ route('filters', ['stringSelected' => 'stringSelectedToChange']) }}";

                $.ajax({
                    url: route.replace('stringSelectedToChange', stringSelected),
                    type: "POST",
                    data: {
                        _token: '{{ csrf_token() }}',
                    },
                    success: function (data) {
                        $(".features_items").html(data.html);
                    }
                });
            } else {
                let checked = new Array();
                $("input:checkbox[name=filters]:checked").each(function () {
                    let key = $(this).parent().data('category');
                    let value = $(this).data('value-id');
                    let obj = {};
                    obj[key] = value;
                    checked.push(obj);
                });
                selected = checked;
                let stringSelected = JSON.stringify(selected)

                let route = "{{ route('filters', ['stringSelected' => 'stringSelectedToChange']) }}";

                $.ajax({
                    url: route.replace('stringSelectedToChange', stringSelected),
                    type: "POST",
                    data: {
                        _token: '{{ csrf_token() }}',
                    },
                    success: function (data) {
                        $(".features_items").html(data.html);
                    }
                });
            }
        });
    </script>
@endsection
