@extends('web.templet.master')

  {{-- @include('web.include.seo') --}}

  @section('seo')
  @endsection

  @section('content')
    <!-- HEADER END --> 

    <!-- BANNER STRAT -->
    <!-- <div class="banner inner-banner">
      <div class="container">
        <div class="bread-crumb mtb-10 center-xs">
          <div class="page-title">Login</div>
          <div class="bread-crumb-inner right-side float-none-xs">
            <ul>
              <li><a href="{{route('web.index')}}">Home</a><i class="fa fa-angle-right"></i></li>
              <li><span>Login</span></li>
            </ul>
          </div>
        </div>
      </div>
    </div> -->
    <!-- BANNER END --> 

    <!-- CONTAIN START -->
  <section class="container">
    <div class="pro-page pt-55">
      <div class="row">
        <div class="col-md-3 col-sm-3 mb-xs-30">
          <div class="fotorama" data-nav="thumbs" data-allowfullscreen="native">
            <a href="#"><img src="{{asset('web/images/1.jpg')}}" alt="Streetwear"></a>
            <a href="#"><img src="{{asset('web/images/2.jpg')}}" alt="Streetwear"></a>
            <a href="#"><img src="{{asset('web/images/3.jpg')}}" alt="Streetwear"></a>
            <a href="#"><img src="{{asset('web/images/4.jpg')}}" alt="Streetwear"></a>
            <a href="#"><img src="{{asset('web/images/5.jpg')}}" alt="Streetwear"></a>
            <a href="#"><img src="{{asset('web/images/6.jpg')}}" alt="Streetwear"></a>
            <a href="#"><img src="{{asset('web/images/4.jpg')}}" alt="Streetwear"></a>
            <a href="#"><img src="{{asset('web/images/5.jpg')}}" alt="Streetwear"></a>
            <a href="#"><img src="{{asset('web/images/6.jpg')}}" alt="Streetwear"></a>
          </div>
        </div>
        <div class="col-md-9 col-sm-9">
          <div class="row">
            <div class="col-xs-12">
              <div class="product-detail-main">
                <div class="product-item-details">
                  <h1 class="product-item-name">Cross Colours Camo Print Tank half mengo</h1>
                  <div class="price-box">
                    <span class="price">₹80.00</span>
                    <del class="price old-price">₹100.00</del>
                  </div>
                  <div class="product-info-stock-sku">
                    <div>
                      <label>Availability: </label>
                      <span class="info-deta">In stock</span>
                    </div>
                    <div>
                      <label>SKU: </label>
                      <span class="info-deta">20MVC-18</span>
                    </div>
                  </div>
                  <p>Proin lectus ipsum, gravida et mattis vulputate, tristique ut lectus. Sed et lorem nunc. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Aenean eleifend laoreet congue. Vivamus adipiscing nisl ut dolor dignissim semper. Nulla luctus malesuada </p>
                  <div class="mb-40">
                    <div class="product-qty">
                      <label for="qty">Qty:</label>
                      <div class="custom-qty">
                        <button onclick="var result = document.getElementById('qty'); var qty = result.value; if( !isNaN( qty ) &amp;&amp; qty &gt; 1 ) result.value--;return false;" class="reduced items" type="button"> <i class="fa fa-minus"></i> </button>
                        <input type="text" class="input-text qty" title="Qty" value="1" maxlength="8" id="qty" name="qty">
                        <button onclick="var result = document.getElementById('qty'); var qty = result.value; if( !isNaN( qty )) result.value++;return false;" class="increase items" type="button"> <i class="fa fa-plus"></i> </button>
                      </div>
                    </div>
                    <div class="bottom-detail cart-button">
                      <ul>
                        <li class="pro-cart-icon">
                          <form>
                            <button title="Add to Cart" class="btn-black"><span></span>Add to Cart</button>
                          </form>
                        </li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>


  <section class="container">
    <div class="ptb-85">
      <div class="product-detail-tab flipInX">
        <div class="row">
          <div class="col-md-12">
            <div id="tabs">
              <ul class="nav nav-tabs">
                <li><a class="tab-Description selected" title="Description">Description</a></li>
              </ul>
            </div>
            <div id="items">
              <div class="tab_content">
                <ul>
                  <li>
                    <div class="items-Description selected">
                      <div class="Description"> <strong>The standard Lorem Ipsum passage, used since the 1500s</strong><br />
                        <p>Proin lectus ipsum, gravida et mattis vulputate, tristique ut lectus. Sed et lorem nunc. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Aenean eleifend laoreet congue. Vivamus adipiscing nisl ut dolor dignissim semper. Nulla luctus malesuada Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy  took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets</p>
                        <p>Tristique ut lectus. Sed et lorem nunc. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Aenean eleifend laoreet congue. Vivamus adipiscing nisl ut dolor dignissim semper. Nulla luctus malesuada Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p></div>
                    </div>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="container">
    <div class="pb-85">
      <div class="product-slider owl-slider">
        <div class="row">
          <div class="col-xs-12">
            <div class="heading-part align-center mb-40">
              <h2 class="main_title">Related Products</h2>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="product-slider-main position-r">
            <div class="owl-carousel pro_cat_slider">
              <div class="item">
                <div class="product-item">
                  <div class="product-image">
                    <a href="product-page.html">
                      <img src="{{asset('web/images/1.jpg')}}" alt="Streetwear">
                    </a>
                    <div class="product-detail-inner">
                      <div class="detail-inner-left align-center">
                        <ul>
                          <li class="pro-cart-icon">
                            <form>
                              <button title="Add to Cart"><span></span></button>
                            </form>
                          </li>
                        </ul>
                      </div>
                    </div>
                  </div>
                  <div class="product-item-details">
                    <div class="product-item-name">
                      <a href="product-page.html">Defyant Reversible Dot Shorts</a>
                    </div>
                    <div class="price-box">
                      <span class="price">₹80.00</span>
                      <del class="price old-price">₹100.00</del>
                    </div>
                    <div class="rating-summary-block">
                      <div title="53%" class="rating-result">
                        <span style="width:53%"></span>
                      </div>
                      <span class="label-review"><span>( 2 review )</span></span>
                    </div>
                  </div>
                </div>
              </div>
              <div class="item">
                <div class="product-item">
                  <div class="product-image">
                    <a href="product-page.html">
                      <img src="{{asset('web/images/2.jpg')}}" alt="">
                    </a>
                    <div class="product-detail-inner">
                      <div class="detail-inner-left align-center">
                        <ul>
                          <li class="pro-cart-icon">
                            <form>
                              <button title="Add to Cart"><span></span></button>
                            </form>
                          </li>
                        </ul>
                      </div>
                    </div>
                  </div>
                  <div class="product-item-details">
                    <div class="product-item-name">
                      <a href="product-page.html">Defyant Reversible Dot Shorts</a>
                    </div>
                    <div class="price-box">
                      <span class="price">₹80.00</span>
                    </div>
                    <div class="rating-summary-block">
                      <div title="53%" class="rating-result">
                        <span style="width:53%"></span>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="item">
                <div class="product-item">
                  <div class="product-image">
                    <a href="product-page.html">
                      <img src="{{asset('web/images/3.jpg')}}" alt="">
                    </a>
                    <div class="product-detail-inner">
                      <div class="detail-inner-left align-center">
                        <ul>
                          <li class="pro-cart-icon">
                            <form>
                              <button title="Add to Cart"><span></span></button>
                            </form>
                          </li>
                        </ul>
                      </div>
                    </div>
                  </div>
                  <div class="product-item-details">
                    <div class="product-item-name">
                      <a href="product-page.html">Defyant Reversible Dot Shorts</a>
                    </div>
                    <div class="price-box">
                      <span class="price">₹80.00</span>
                    </div>
                    <div class="rating-summary-block">
                      <div title="53%" class="rating-result">
                        <span style="width:53%"></span>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="item">
                <div class="product-item">
                  <div class="product-image">
                    <a href="product-page.html">
                      <img src="{{asset('web/images/4.jpg')}}" alt="">
                    </a>
                    <div class="product-detail-inner">
                      <div class="detail-inner-left align-center">
                        <ul>
                          <li class="pro-cart-icon">
                            <form>
                              <button title="Add to Cart"><span></span></button>
                            </form>
                          </li>
                        </ul>
                      </div>
                    </div>
                  </div>
                  <div class="product-item-details">
                    <div class="product-item-name">
                      <a href="product-page.html">Defyant Reversible Dot Shorts</a>
                    </div>
                    <div class="price-box">
                      <span class="price">₹80.00</span>
                    </div>
                    <div class="rating-summary-block">
                      <div title="53%" class="rating-result">
                        <span style="width:53%"></span>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="item">
                <div class="product-item">
                  <div class="product-image">
                    <a href="product-page.html">
                      <img src="{{asset('web/images/5.jpg')}}" alt="">
                    </a>
                    <div class="product-detail-inner">
                      <div class="detail-inner-left align-center">
                        <ul>
                          <li class="pro-cart-icon">
                            <form>
                              <button title="Add to Cart"><span></span></button>
                            </form>
                          </li>
                        </ul>
                      </div>
                    </div>
                  </div>
                  <div class="product-item-details">
                    <div class="product-item-name">
                      <a href="product-page.html">Defyant Reversible Dot Shorts</a>
                    </div>
                    <div class="price-box">
                      <span class="price">₹80.00</span>
                    </div>
                    <div class="rating-summary-block">
                      <div title="53%" class="rating-result">
                        <span style="width:53%"></span>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="item">
                <div class="product-item">
                  <div class="product-image">
                    <a href="product-page.html">
                      <img src="{{asset('web/images/6.jpg')}}" alt="">
                    </a>
                    <div class="product-detail-inner">
                      <div class="detail-inner-left align-center">
                        <ul>
                          <li class="pro-cart-icon">
                            <form>
                              <button title="Add to Cart"><span></span></button>
                            </form>
                          </li>
                        </ul>
                      </div>
                    </div>
                  </div>
                  <div class="product-item-details">
                    <div class="product-item-name">
                      <a href="product-page.html">Defyant Reversible Dot Shorts</a>
                    </div>
                    <div class="price-box">
                      <span class="price">₹80.00</span>
                    </div>
                    <div class="rating-summary-block">
                      <div title="53%" class="rating-result">
                        <span style="width:53%"></span>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="item">
                <div class="product-item">
                  <div class="product-image">
                    <a href="product-page.html">
                      <img src="{{asset('web/images/7.jpg')}}" alt="">
                    </a>
                    <div class="product-detail-inner">
                      <div class="detail-inner-left align-center">
                        <ul>
                          <li class="pro-cart-icon">
                            <form>
                              <button title="Add to Cart"><span></span></button>
                            </form>
                          </li>
                        </ul>
                      </div>
                    </div>
                  </div>
                  <div class="product-item-details">
                    <div class="product-item-name">
                      <a href="product-page.html">Defyant Reversible Dot Shorts</a>
                    </div>
                    <div class="price-box">
                      <span class="price">₹80.00</span>
                    </div>
                    <div class="rating-summary-block">
                      <div title="53%" class="rating-result">
                        <span style="width:53%"></span>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
    
    <!-- CONTAINER END --> 

    <!-- FOOTER START -->
	@endsection
	
	@section('script')
	@endsection
