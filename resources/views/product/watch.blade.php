<div class="col-sm-9 padding-right">
    <div class="features_items"><!--features_items-->
        <h2 class="title text-center">Features Items</h2>
        @foreach($watches as $watch)
            {{--            {{dump($watch)}}--}}
            {{--            {{dd($watch->id)}}--}}
            <div class="col-sm-4">
                <a href="{{ route('product', ['watch_id' => $watch->id]) }}">
                    <div class="product-image-wrapper">
                        <div class="single-products">
                            <div class="productinfo text-center">
                                <img class="img" src="{{ $watch->images[0]['image'] }}" alt=""/>
                                <h2 class="price">{{ $watch->watch->price }} </h2>
                                <p class="title">{{ $watch->watch->title }}</p>
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

{{--@section('script')--}}

{{--    <script type="text/javascript">--}}
{{--        $.ajaxSetup({--}}
{{--            headers: {--}}
{{--                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')--}}
{{--            }--}}
{{--        });--}}

{{--        $(".form-check-input").click(function(e){--}}

{{--            e.preventDefault();--}}

{{--            let title = $("p[class=title]").val();--}}
{{--            let price = $("h2[class=price]").val();--}}
{{--            let img = $("img[class=img]").src();--}}

{{--            $.ajax({--}}
{{--                type:'POST',--}}
{{--                url:"{{ route('ajaxRequest.post') }}",--}}
{{--                data:{title:title, price:price, img:img},--}}
{{--                success:function(data){--}}
{{--                    $(".features_items").html(data);--}}
{{--                    console.log(data)--}}
{{--                }--}}
{{--            });--}}

{{--        });--}}
{{--@endsection--}}
