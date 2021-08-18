<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Product Details | E-Shopper</title>
@extends('layout.app')

    @section('content')
        <section>
    <div class="container">
        <div class="row">
            <div class="col-sm-3">
                <div class="left-sidebar">
                    <h2>filters</h2>
                    <div class="panel-group category-products" id="accordian"><!--category-products-->
                        @foreach($sidebar as $key=>$data)
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

                <!--/brands_products-->

                    <div class="price-range"><!--price-range-->
                        <h2>Price Range</h2>
                        <div class="well">
                            <input type="text" class="span2" value="" data-slider-min="0" data-slider-max="600"
                                   data-slider-step="5" data-slider-value="[250,450]" id="sl2" ><br />
                            <b>$ 0</b> <b class="pull-right">$ 600</b>
                        </div>
                    </div><!--/price-range-->

                    <div class="shipping text-center"><!--shipping-->
                        <img src="../images/home/shipping.jpg" alt="" />
                    </div><!--/shipping-->

                </div>
            </div>

            <div class="col-sm-9 padding-right">
                <div class="product-details"><!--product-details-->
                    <div class="col-sm-5">
                        <div class="view-product">
                            @foreach($watch as $watchData)
                                <img src="{{ $watchData->image }}" alt="" />
                                <h3>ZOOM</h3>
                            @endforeach
                        </div>
                        <div id="similar-product" class="carousel slide" data-ride="carousel">
                            <!-- Wrapper for slides -->
                                <div class="carousel-inner">
                                    @foreach($images as $image)
                                        <div class="item @if($loop->first) active @endif">
                                            @foreach($image as $url)
                                                <a href=""><img src="{{ $url }}" alt="" style="width: 70px; height: 80px;"></a>
                                            @endforeach
                                        </div>
                                    @endforeach
                                </div>

                            <!-- Controls -->
                            <a class="left item-control" href="#similar-product" data-slide="prev">
                                <i class="fa fa-angle-left"></i>
                            </a>
                            <a class="right item-control" href="#similar-product" data-slide="next">
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </div>


                    </div>
                    <div class="col-sm-7">
                        <div class="product-information"><!--/product-information-->
                            @foreach($watch as $watchData)
                                <img src="{{ asset('images/product-details/new.jpg') }}" class="newarrival" alt="" />
                                <h2>{{$watchData->title}}</h2>
                                <p>Web ID: {{$watchData->web_id}}</p>
                                <span>
                                        <span>{{ $watchData->price }}</span>
                                        <label>Quantity:</label>
                                        <input type="text" value="1" />
                                        <button type="button" class="btn btn-fefault cart" id="addToCart" value="cart" data-product-id="{{ $watchData->id }}">
                                            <i class="fa fa-shopping-cart"></i>
                                            В корзину
                                        </button>
                                    </span>
                                <p><b>Savings:</b>
                                    {{ $watchData->savings > 0 ? $watchData->savings : '' }}
                                </p>
                                <p><b>Condition:</b>
                                    {{$watchData->condition}}
                                </p>
                                <p><b>Brand:</b>
                                    {{$watchData->signatures}}
                                </p>
                            @endforeach
                        </div>
                    </div><!--/product-information-->
                    </div>
                </div><!--/product-details-->
            <div class="category-tab shop-details-tab"><!--category-tab-->
                <div class="col-sm-12">
                    <ul class="nav nav-tabs">
                        <li><a href="#details" data-toggle="tab">Description</a></li>
                        <li><a href="#companyprofile" data-toggle="tab">Additional Information</a></li>
                        <li><a href="#tag" data-toggle="tab">Shipping & Returns</a></li>
                        <li><a href="#reviews" data-toggle="tab">Guarantee</a></li>
                    </ul>
                </div>
                <div class="tab-content">
                    <div class="tab-pane fade" id="details" >
                        <div class="col-sm-3">
                            <div class="product-image-wrapper">
                                <div class="single-products">
                                    <div class="productinfo text-center">
                                        <img src="images/home/gallery1.jpg" alt="" />
                                        <h2>$56</h2>
                                        <p>Easy Polo Black Edition</p>
                                        <button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="product-image-wrapper">
                                <div class="single-products">
                                    <div class="productinfo text-center">
                                        <img src="images/home/gallery2.jpg" alt="" />
                                        <h2>$56</h2>
                                        <p>Easy Polo Black Edition</p>
                                        <button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="product-image-wrapper">
                                <div class="single-products">
                                    <div class="productinfo text-center">
                                        <img src="images/home/gallery3.jpg" alt="" />
                                        <h2>$56</h2>
                                        <p>Easy Polo Black Edition</p>
                                        <button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="product-image-wrapper">
                                <div class="single-products">
                                    <div class="productinfo text-center">
                                        <img src="images/home/gallery4.jpg" alt="" />
                                        <h2>$56</h2>
                                        <p>Easy Polo Black Edition</p>
                                        <button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="companyprofile" >
                        <div class="col-sm-3">
                            <div class="product-image-wrapper">
                                <div class="single-products">
                                    <div class="productinfo text-center">
                                        <img src="images/home/gallery1.jpg" alt="" />
                                        <h2>$56</h2>
                                        <p>Easy Polo Black Edition</p>
                                        <button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="product-image-wrapper">
                                <div class="single-products">
                                    <div class="productinfo text-center">
                                        <img src="images/home/gallery3.jpg" alt="" />
                                        <h2>$56</h2>
                                        <p>Easy Polo Black Edition</p>
                                        <button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="product-image-wrapper">
                                <div class="single-products">
                                    <div class="productinfo text-center">
                                        <img src="images/home/gallery2.jpg" alt="" />
                                        <h2>$56</h2>
                                        <p>Easy Polo Black Edition</p>
                                        <button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="product-image-wrapper">
                                <div class="single-products">
                                    <div class="productinfo text-center">
                                        <img src="images/home/gallery4.jpg" alt="" />
                                        <h2>$56</h2>
                                        <p>Easy Polo Black Edition</p>
                                        <button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="tag" >
                        <div class="col-sm-3">
                            <div class="product-image-wrapper">
                                <div class="single-products">
                                    <div class="productinfo text-center">
                                        <img src="images/home/gallery1.jpg" alt="" />
                                        <h2>$56</h2>
                                        <p>Easy Polo Black Edition</p>
                                        <button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="product-image-wrapper">
                                <div class="single-products">
                                    <div class="productinfo text-center">
                                        <img src="images/home/gallery2.jpg" alt="" />
                                        <h2>$56</h2>
                                        <p>Easy Polo Black Edition</p>
                                        <button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="product-image-wrapper">
                                <div class="single-products">
                                    <div class="productinfo text-center">
                                        <img src="images/home/gallery3.jpg" alt="" />
                                        <h2>$56</h2>
                                        <p>Easy Polo Black Edition</p>
                                        <button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="product-image-wrapper">
                                <div class="single-products">
                                    <div class="productinfo text-center">
                                        <img src="images/home/gallery4.jpg" alt="" />
                                        <h2>$56</h2>
                                        <p>Easy Polo Black Edition</p>
                                        <button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade active in" id="reviews" >
                        <div class="col-sm-12">
                            <ul>
                                <li><a href=""><i class="fa fa-user"></i>EUGEN</a></li>
                                <li><a href=""><i class="fa fa-clock-o"></i>12:41 PM</a></li>
                                <li><a href=""><i class="fa fa-calendar-o"></i>31 DEC 2014</a></li>
                            </ul>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>
                            <p><b>Write Your Review</b></p>

                            <form action="#">
										<span>
											<input type="text" placeholder="Your Name"/>
											<input type="email" placeholder="Email Address"/>
										</span>
                                <textarea name="" ></textarea>
                                <b>Rating: </b> <img src="images/product-details/rating.png" alt="" />
                                <button type="button" class="btn btn-default pull-right">
                                    Submit
                                </button>
                            </form>
                        </div>
                    </div>

                </div>
            </div><!--/category-tab-->

                <div class="recommended_items"><!--recommended_items-->
                    <h2 class="title text-center">recommended items</h2>

                    <div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
                        <div class="carousel-inner">
                            @foreach($watches as $watchesData)
                                <div class="item @if($loop->first) active @endif">
                                    @foreach($watchesData as $data)
                                        <div class="col-sm-4">
                                            <div class="product-image-wrapper">
                                                <div class="single-products">
                                                    <div class="productinfo text-center">
                                                        <img src="{{ $data->image }}" alt="" style="width: 200px; height: 180px;"/>
                                                        <h2>{{ $data->price }}</h2>
                                                        <p>{{ $data->title }}</p>
                                                        <button type="button" class="btn btn-fefault cart" id="addToCart" value="cart" data-product-id="#">
                                                            <i class="fa fa-shopping-cart"></i>Add to cart</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @endforeach
                        </div>
                        <a class="left recommended-item-control" href="#recommended-item-carousel" data-slide="prev">
                            <i class="fa fa-angle-left"></i>
                        </a>
                        <a class="right recommended-item-control" href="#recommended-item-carousel" data-slide="next">
                            <i class="fa fa-angle-right"></i>
                        </a>
                    </div>
                </div><!--/recommended_items-->

            </div>
        </div>
    </div>
</section>
@endsection

    @section('script')
        <script>
            $('#addToCart').on('click', function () {
                let productId = $(this).data('product-id');
                let route = "{{ route('add.cart', ['productId' => 'productIdToChange']) }}";

                $.ajax({
                    url: route.replace('productIdToChange', productId),
                    type: "POST",
                    data: {
                        '_token': "{{ csrf_token() }}"
                    },
                    success: function (data) {
                        if (data.success) {
                            $('#toCart').text(data.productCount);
                            alert('Product added to cart successfully!');
                        }else{
                            alert('The product add to cart was failed!');
                        }

                    },
                    error: function () {
                        alert("Something went wrong");
                    }
                });

            })
        </script>
@endsection

