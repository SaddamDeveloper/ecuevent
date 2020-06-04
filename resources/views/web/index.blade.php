@extends('web.templet.master')

  {{-- @include('web.include.seo') --}}

  @section('seo')
  @endsection

  @section('content')
    <!-- HEADER END --> 

    <!-- BANNER STRAT -->
    <section>
      <div class="banner">
        <div class="main-banner">
          @if(isset($sliders) && !empty($sliders))
            @foreach($sliders as $slider)
            <div class="banner-1"> 
              <img src="{{asset('shopping/slider/'.$slider->slider_image)}}" alt="Streetwear"> 
              <div class="banner-detail">
                <div class="row">
                  <div class="col-md-6 col-sm-6 col-xs-6"></div>
                  <div class="col-md-6 col-sm-6 col-xs-6">
                    <div class="banner-detail-inner">
                      <span class="offer">{{$slider->offer}}</span>
                      <h1 class="banner-title">{{$slider->banner_title}}</h1>
                      <h1 class="banner-subtitle">{{$slider->banner_subtitle}}</h1>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            @endforeach
          @endif
        </div>
      </div>
    </section>
    <!-- BANNER END --> 

    <!--  Featured Products Slider Block Start  -->
    <section class="container">
      <div class="ptb-50">
        <div class="product-slider owl-slider">          
          <div class="row">
            <div class="col-xs-12">
              <div class="heading-part align-center mb-40">
                <h2 class="main_title">New Products</h2>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-3 col-lg-2 col-xs-12">
              <div class="heading-part align-center mb-40">
                <div id="tabs" class="category-bar mt-60">
                  <ul class="tab-stap">
                    <li><a class="tab-step1 selected" title="step1">Products</a></li>
                    <li><a class="tab-step2" title="step2">Services</a></li>
                    <li><a class="tab-step3" title="step3">Educations</a></li>
                  </ul>
                </div>
              </div>
            </div>
            <div class="col-sm-9 col-lg-10 col-xs-12">
              <div class="row">
                <div id="items">
                  <div class="tab_content pro_cat">
                    <ul>
                      <li>
                        <div id="data-step1" class="items-step1 selected product-slider-main position-r" data-temp="tabdata">
                          @if(isset($products) && !empty($products))
                            @foreach ($products as $product)
                            <div class="col-md-3 col-xs-6 plr-20 mb-20">
                              <div class="product-item">
                                <div class="product-image">
                                  <a href="product-page.html">
                                    <img src="{{asset('shopping/product/'.$product->main_image)}}" alt="Streetwear">
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
                                    <a href="product-page.html">{{$product->name}}</a>
                                  </div>
                                  <div class="price-box">
                                    <span class="price">₹{{number_format($product->price, 2)}}</span>
                                    <del class="price old-price">₹{{number_format($product->mrp, 2)}}</del>
                                  </div>
                                </div>
                              </div>
                            </div>
                            {{-- <div class="col-md-3 col-xs-6 plr-20 mb-20">
                              <div class="product-item">
                                <div class="product-image">
                                  <a href="product-page.html">
                                    <img src="{{asset('web/images/2.jpg')}}" alt="Streetwear">
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
                                    <a href="product-page.html">Ecu Stylish Backpack</a>
                                  </div>
                                  <div class="price-box">
                                    <span class="price">₹550.00</span>
                                    <del class="price old-price">₹750.00</del>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="col-md-3 col-xs-6 plr-20 mb-20">
                              <div class="product-item">
                                <div class="product-image">
                                  <a href="product-page.html">
                                    <img src="{{asset('web/images/3.jpg')}}" alt="Streetwear">
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
                                    <a href="product-page.html">Ecu Stylish Backpack</a>
                                  </div>
                                  <div class="price-box">
                                    <span class="price">₹296.00</span>
                                    <del class="price old-price">₹500.00</del>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="col-md-3 col-xs-6 plr-20 mb-20">
                              <div class="product-item">
                                <div class="product-image">
                                  <a href="product-page.html">
                                    <img src="{{asset('web/images/4.jpg')}}" alt="Streetwear">
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
                                    <a href="product-page.html">Ecu Stylish Backpack</a>
                                  </div>
                                  <div class="price-box">
                                    <span class="price">₹330.00</span>
                                    <del class="price old-price">₹550.00</del>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="col-md-3 col-xs-6 plr-20 mb-20">
                              <div class="product-item">
                                <div class="product-image">
                                  <a href="product-page.html">
                                    <img src="{{asset('web/images/5.jpg')}}" alt="Streetwear">
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
                                    <a href="product-page.html">Ecu Stylish Backpack</a>
                                  </div>
                                  <div class="price-box">
                                    <span class="price">₹90.00</span>
                                    <del class="price old-price">₹120.00</del>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="col-md-3 col-xs-6 plr-20 mb-20">
                              <div class="product-item">
                                <div class="product-image">
                                  <a href="product-page.html">
                                    <img src="{{asset('web/images/6.jpg')}}" alt="Streetwear">
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
                                    <a href="product-page.html">Ecu Wallet</a>
                                  </div>
                                  <div class="price-box">
                                    <span class="price">₹250.00</span>
                                    <del class="price old-price">₹400.00</del>
                                  </div>
                                </div>
                              </div>
                            </div> --}}
                            @endforeach
                          @endif
                        </div>
                      </li>
                      <li>
                        <div id="data-step2" class="items-step2 product-slider-main position-r" data-temp="tabdata">
                          <div class="col-md-3 col-xs-6 plr-20 mb-20">
                            <h2>COMING SOON</h2>
                          </div>
                          <!--<div class="col-md-3 col-xs-6 plr-20 mb-20">
                            <div class="product-item">
                              <div class="product-image">
                                <a href="product-page.html">
                                  <img src="{{asset('web/images/9.jpg')}}" alt="Streetwear">
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
                                  <a href="product-page.html">ECU Ladies Bag</a>
                                </div>
                                <div class="price-box">
                                  <span class="price">₹80.00</span>
                                  <del class="price old-price">₹100.00</del>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="col-md-3 col-xs-6 plr-20 mb-20">
                            <div class="product-item">
                              <div class="product-image">
                                <a href="product-page.html">
                                  <img src="{{asset('web/images/10.jpg')}}" alt="Streetwear">
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
                                  <a href="product-page.html">ECU Ladies Purse</a>
                                </div>
                                <div class="price-box">
                                  <span class="price">₹80.00</span>
                                  <del class="price old-price">₹100.00</del>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="col-md-3 col-xs-6 plr-20 mb-20">
                            <div class="product-item">
                              <div class="product-image">
                                <a href="product-page.html">
                                  <img src="{{asset('web/images/11.jpg')}}" alt="Streetwear">
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
                                  <a href="product-page.html">ECU Ladies Bag</a>
                                </div>
                                <div class="price-box">
                                  <span class="price">₹80.00</span>
                                  <del class="price old-price">₹100.00</del>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="col-md-3 col-xs-6 plr-20 mb-20">
                            <div class="product-item">
                              <div class="product-image">
                                <a href="product-page.html">
                                  <img src="{{asset('web/images/12.jpg')}}" alt="Streetwear">
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
                                  <a href="product-page.html">ECU Ladies Bag</a>
                                </div>
                                <div class="price-box">
                                  <span class="price">₹80.00</span>
                                  <del class="price old-price">₹100.00</del>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="col-md-3 col-xs-6 plr-20 mb-20">
                            <div class="product-item">
                              <div class="product-image">
                                <a href="product-page.html">
                                  <img src="{{asset('web/images/9.jpg')}}" alt="Streetwear">
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
                                  <a href="product-page.html">ECU Ladies Bag</a>
                                </div>
                                <div class="price-box">
                                  <span class="price">₹80.00</span>
                                  <del class="price old-price">₹100.00</del>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="col-md-3 col-xs-6 plr-20 mb-20">
                            <div class="product-item">
                              <div class="product-image">
                                <a href="product-page.html">
                                  <img src="{{asset('web/images/10.jpg')}}" alt="Streetwear">
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
                                  <a href="product-page.html">ECU Ladies Purse</a>
                                </div>
                                <div class="price-box">
                                  <span class="price">₹80.00</span>
                                  <del class="price old-price">₹100.00</del>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="col-md-3 col-xs-6 plr-20 mb-20">
                            <div class="product-item">
                              <div class="product-image">
                                <a href="product-page.html">
                                  <img src="{{asset('web/images/11.jpg')}}" alt="Streetwear">
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
                                  <a href="product-page.html">ECU Ladies Bag</a>
                                </div>
                                <div class="price-box">
                                  <span class="price">₹80.00</span>
                                  <del class="price old-price">₹100.00</del>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="col-md-3 col-xs-6 plr-20 mb-20">
                            <div class="product-item">
                              <div class="product-image">
                                <a href="product-page.html">
                                  <img src="{{asset('web/images/12.jpg')}}" alt="Streetwear">
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
                                  <a href="product-page.html">ECU Ladies Bag</a>
                                </div>
                                <div class="price-box">
                                  <span class="price">₹80.00</span>
                                  <del class="price old-price">₹100.00</del>
                                </div>
                              </div>
                            </div>
                          </div>-->
                        </div>
                      </li>
                      <li>
                        <div id="data-step3" class="items-step3 product-slider-main position-r" data-temp="tabdata">
                          <div class="col-md-3 col-xs-6 plr-20 mb-20">
                            <h2>COMING SOON</h2>
                          </div>
                          <!--<div class="col-md-3 col-xs-6 plr-20 mb-20">
                            <div class="product-item">
                              <div class="product-image">
                                <a href="product-page.html">
                                  <img src="{{asset('web/images/3.jpg')}}" alt="Streetwear">
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
                              </div>
                            </div>
                          </div>
                          <div class="col-md-3 col-xs-6 plr-20 mb-20">
                            <div class="product-item">
                              <div class="product-image">
                                <a href="product-page.html">
                                  <img src="{{asset('web/images/4.jpg')}}" alt="Streetwear">
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
                              </div>
                            </div>
                          </div>
                          <div class="col-md-3 col-xs-6 plr-20 mb-20">
                            <div class="product-item">
                              <div class="product-image">
                                <a href="product-page.html">
                                  <img src="{{asset('web/images/5.jpg')}}" alt="Streetwear">
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
                              </div>
                            </div>
                          </div>
                          <div class="col-md-3 col-xs-6 plr-20 mb-20">
                            <div class="product-item">
                              <div class="product-image">
                                <a href="product-page.html">
                                  <img src="{{asset('web/images/6.jpg')}}" alt="Streetwear">
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
                              </div>
                            </div>
                          </div>
                          <div class="col-md-3 col-xs-6 plr-20 mb-20">
                            <div class="product-item">
                              <div class="product-image">
                                <a href="product-page.html">
                                  <img src="{{asset('web/images/9.jpg')}}" alt="Streetwear">
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
                              </div>
                            </div>
                          </div>
                          <div class="col-md-3 col-xs-6 plr-20 mb-20">
                            <div class="product-item">
                              <div class="product-image">
                                <a href="product-page.html">
                                  <img src="{{asset('web/images/10.jpg')}}" alt="Streetwear">
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
                              </div>
                            </div>
                          </div>
                          <div class="col-md-3 col-xs-6 plr-20 mb-20">
                            <div class="product-item">
                              <div class="product-image">
                                <a href="product-page.html">
                                  <img src="{{asset('web/images/11.jpg')}}" alt="Streetwear">
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
                              </div>
                            </div>
                          </div>
                          <div class="col-md-3 col-xs-6 plr-20 mb-20">
                            <div class="product-item">
                              <div class="product-image">
                                <a href="product-page.html">
                                  <img src="{{asset('web/images/12.jpg')}}" alt="Streetwear">
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
                              </div>
                            </div>
                          </div>-->
                        </div>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>          
          </div>   
        </div>
      </div>
    </section>
    <!--  Featured Products Slider Block End  -->

    <!-- perellex-banner Start -->
    <section>
      <div class="perellex-banner align-center">
        <div class="container">
          <div class="perellex-delail ptb-85">
            <div class="row">
              <div class="col-sm-4">
                <div class="footer-static-block">
                  <div class="footer-static-block-inner">
                    <h3 class="title">Information</h3>
                    <ul class="footer-block-contant link">
                      <li><a>Mission & Vision</a></li>
                      <li><a>About Us</a></li>
                      <li><a>Contact Us</a></li>
                      <li><a>Why ECU ?</a></li>
                    </ul>
                  </div>
                </div>
              </div>
              <div class="col-sm-4">
                <div class="footer-static-block">
                  <div class="footer-static-block-inner">
                    <h3 class="title">Addtional</h3>
                    <ul class="footer-block-contant link">
                      <li><a>Privacy Policy</a></li>
                      <li><a>Terms &amp; Conditions</a></li>
                    </ul>
                  </div>
                </div>
              </div>
              <div class="col-sm-4">
                <div class="footer-static-block">
                  <div class="footer-static-block-inner">
                    <h3 class="title">Follow us</h3>
                    <ul class="footer-block-contant link">
                      <li><a>Facebook</a></li>
                      <li><a>Youtube</a></li>
                      <li><a>Instagram</a></li>
                      <li><a>Twitter</a></li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- perellex-banner Start -->
    
    <!-- FOOTER START -->
	@endsection
	
	@section('script')
	@endsection
    
