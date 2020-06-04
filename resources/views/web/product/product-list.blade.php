@extends('web.templet.master')

  {{-- @include('web.include.seo') --}}

  @section('seo')
  @endsection

  @section('content')
    <!-- HEADER END --> 

    <!-- BANNER STRAT -->
    <div class="banner inner-banner">
      <div class="container">
        <div class="bread-crumb mtb-10 center-xs">
          <div class="page-title">Product List</div>
          <div class="bread-crumb-inner right-side float-none-xs">
            <ul>
              <li><a href="{{route('web.index')}}">Home</a><i class="fa fa-angle-right"></i></li>
              <li><span>Product List</span></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
    <!-- BANNER END --> 

    <!-- CONTAIN START -->
  <section class="container pb-85 pt-55">
    <div class="row">
      <div class="col-md-12">
        <div class="shorting mb-30">
          <div class="row">
            <div class="col-md-9">
            <div class="main_title">
            </div>
            </div>
            <div class="col-md-3">
              <div class="short-by float-right-sm">
                <span>Sort By</span>
                <div class="select-item">
                  <select>
                    <option value="" selected="selected">Name (A to Z)</option>
                    <option value="">Name(Z - A)</option>
                    <option value="">price(low&gt;high)</option>
                    <option value="">price(high &gt; low)</option>
                    <option value="">rating(highest)</option>
                    <option value="">rating(lowest)</option>
                  </select>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="product-listing">
          <div class="row mlr_-20">
            <div class="col-md-3 col-xs-6 plr-20">
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
                    <span class="price">$80.00</span>
                    <del class="price old-price">$100.00</del>
                  </div>
                  <div class="rating-summary-block">
                    <div title="53%" class="rating-result">
                      <span style="width:53%"></span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-3 col-xs-6 plr-20">
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
                    <a href="product-page.html">Defyant Reversible Dot Shorts</a>
                  </div>
                  <div class="price-box">
                    <span class="price">$80.00</span>
                    <del class="price old-price">$100.00</del>
                  </div>
                  <div class="rating-summary-block">
                    <div title="53%" class="rating-result">
                      <span style="width:53%"></span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-3 col-xs-6 plr-20">
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
                    <span class="price">$80.00</span>
                    <del class="price old-price">$100.00</del>
                  </div>
                  <div class="rating-summary-block">
                    <div title="53%" class="rating-result">
                      <span style="width:53%"></span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-3 col-xs-6 plr-20">
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
                    <span class="price">$80.00</span>
                    <del class="price old-price">$100.00</del>
                  </div>
                  <div class="rating-summary-block">
                    <div title="53%" class="rating-result">
                      <span style="width:53%"></span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-3 col-xs-6 plr-20">
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
                    <span class="price">$80.00</span>
                    <del class="price old-price">$100.00</del>
                  </div>
                  <div class="rating-summary-block">
                    <div title="53%" class="rating-result">
                      <span style="width:53%"></span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-3 col-xs-6 plr-20">
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
                    <span class="price">$80.00</span>
                    <del class="price old-price">$100.00</del>
                  </div>
                  <div class="rating-summary-block">
                    <div title="53%" class="rating-result">
                      <span style="width:53%"></span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-3 col-xs-6 plr-20">
              <div class="product-item">
                <div class="product-image">
                  <a href="product-page.html">
                    <img src="{{asset('web/images/7.jpg')}}" alt="Streetwear">
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
                    <span class="price">$80.00</span>
                    <del class="price old-price">$100.00</del>
                  </div>
                  <div class="rating-summary-block">
                    <div title="53%" class="rating-result">
                      <span style="width:53%"></span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-3 col-xs-6 plr-20">
              <div class="product-item">
                <div class="product-image">
                  <a href="product-page.html">
                    <img src="{{asset('web/images/8.jpg')}}" alt="Streetwear">
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
                    <span class="price">$80.00</span>
                    <del class="price old-price">$100.00</del>
                  </div>
                  <div class="rating-summary-block">
                    <div title="53%" class="rating-result">
                      <span style="width:53%"></span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-3 col-xs-6 plr-20">
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
                    <span class="price">$80.00</span>
                    <del class="price old-price">$100.00</del>
                  </div>
                  <div class="rating-summary-block">
                    <div title="53%" class="rating-result">
                      <span style="width:53%"></span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-3 col-xs-6 plr-20">
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
                    <span class="price">$80.00</span>
                    <del class="price old-price">$100.00</del>
                  </div>
                  <div class="rating-summary-block">
                    <div title="53%" class="rating-result">
                      <span style="width:53%"></span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-3 col-xs-6 plr-20">
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
                    <span class="price">$80.00</span>
                    <del class="price old-price">$100.00</del>
                  </div>
                  <div class="rating-summary-block">
                    <div title="53%" class="rating-result">
                      <span style="width:53%"></span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-3 col-xs-6 plr-20">
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
                    <span class="price">$80.00</span>
                    <del class="price old-price">$100.00</del>
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
          <div class="row">
            <div class="col-xs-12">
              <div class="pagination-bar">
                <ul>
                  <li><a href="#"><i class="fa fa-angle-left"></i></a></li>
                  <li class="active"><a href="#">1</a></li>
                  <li><a href="#">2</a></li>
                  <li><a href="#">3</a></li>
                  <li><a href="#"><i class="fa fa-angle-right"></i></a></li>
                </ul>
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
