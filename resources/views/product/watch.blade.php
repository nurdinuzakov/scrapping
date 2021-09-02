<div class="features_items" id="replace"><!--features_items-->
    <h2 class="title text-center">Features Items</h2>
    @foreach($watches as $watch)
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




