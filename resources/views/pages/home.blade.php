@extends('layouts.app')

@section('header_styles')
    <link rel="stylesheet" href="{{ elixir('css/home.css') }}" />
@endsection

@section('content')
    <div class="Home">
    	<div class="Home__bg">
	        <div class="container">
	            <div class="row">
	            	<div class="col-md-12">
	                	<figure class="Hero Figure__reverse Figure--with-padding">
	                		<div class="Figure__right">
	                			<div class="Figure__content">
				                    <img src="/images/slide-watch.png" 
				                    	alt="Slide watch" 
				                    	title="Watch" 
				                    	class="img-responsive" />
			                    </div>
	                		</div>

	                		<figcaption class="Figure__left">
		                        <h3>Welcome to Longacee Brand</h3>
		                        <h2>Premium Watches For Men</h2>
		                        <p>
		                            Neque porro quisquam est qui dolorem ipsum quia tulaxianmi dolor sit amet, consectetur adipisci velit.
		                        </p>
		    
		                        <a href="/shop" class="btn btn-default action-button">Shop now</a>
	                		</figcaption>
	                	</figure>
	                </div>
	            </div>

	            <div class="row">
	                <div class="col-md-12">
	                	<figure>
	                		<div class="Figure__left">
		                		<img src="/images/Home-model-1.jpg" 
		                			alt="Model" 
		                			title="Model" 
		                			class="img-responsive" />
	                		</div>

	                		<figcaption class="Figure__right Figure--with-dark-bg">
	                			<div class="Figure__content">
				                    <h3>Here is our stories</h3>
				                    <h2>Find your perfect logan watch</h2>
				                    <p>
				                        Neque porro quisquam est qui dolorem ipsum quia tulaxianmi dolor sit amet, consectetur, adipisci velit. Neque porro quisqu teaam est qui dolorem ipsum quia tulaxianmi dolor sit amet, consectetur, adipisci velit.
				                    </p>

				                    <p>
				                        <a href="/shop" class="btn btn-default action-button">See more</a>
				                    </p>
			                    </div>
	                		</figcaption>
	                	</figure>
	                </div>
	            </div>

	            <div class="row">
	                <div class="col-md-12">
	                	<figure class="Figure__reverse">
	                		<div class="Figure__left">
	                    		<img src="/images/Home-hublot.jpg" alt="Hublot" title="Hublot" class="img-responsive" />
	                		</div>

	                		<figcaption class="Figure__right Figure--with-dark-bg">
	                			<div class="Figure__content">
				                    <h3>Discover the awesomes of Logancee</h3>
				                    <h2>Exquisite Beauty of Hublot</h2>

				                    <p>
				                        Neque porro quisquam est qui dolorem ipsum quia tulaxianmi dolor sit amet, consectetur, adipisci velit.
				                    </p>

				                    <p class="signature">
				                    	<img src="/images/signature.png" alt="Signature" title="Signature" class="img-responsive" />
				                    </p>
			                    </div>
	                		</figcaption>
	                	</figure>
	                </div>
	            </div>
	        </div>
        </div>

        <div class="container">
            <div class="row">
                <div class="col-md-12">
                	<figure>
                		<div class="Figure__left">
                    		<img src="/images/Home-model-2.jpg" alt="Model" title="Model" class="img-responsive" />
                		</div>
                		<figcaption class="Figure__right Figure--with-dark-bg">
                			<div class="Figure__content">
    			                <blockquote>
	    			                <p class="quote">
	    			                	Neque porro quisquam est qui dolor ipsum quia tulaxianmi dolor sit amet, sitpumlir consectetur, adipisci velit.
	    			                </p>

	    			                <h4 class="author">Logancee Art</h4>
	    			                <p class="designation">CEO</p>
    			                </blockquote>   
    	                    </div>
                		</figcaption>
                	</figure>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="Subpage__subtitle--container">
                        <h2 class="Subpage__subtitle">Featured products</h2>
                        <p class="Subpage__subtitle--small">We showcase things what you need</p>
                    </div>
                </div>
            </div>
        </div>

        <ul id="FeaturedItems" class="Cards">
        	@foreach($items as $item)
        		<li>
        			<div class="Card">
                        @if( $item->isNew())
            				<div class="Card__info Item--is-new">
            					<span>New</span>
            				</div>
                        @endif
                        @if( $item->isOnSale() )
            				<div class="Card__info Item--is-onsale">
            					<span>{{ $item->getDiscountPercentage() }}%</span>
            				</div>
                        @endif
        				<div class="Card_image">
        					<a href="{{ route('items.show', $item->slug) }}">
        						<img src="/images/watch.jpg" 
        							alt="{{ $item->name }}" 
        							title="{{ $item->name }}" 
        							class="img-responsive" />
        					</a>
        				</div>

        				<div class="Card__content">
        					<h3 class="Card__title">{{ $item->name }}</h3>
        					<div class="Card__price">
        						<h4 class="Card__price--new">AED {{ $item->price }}</h4>
                                @if( $item->price < $item->old_price )
        						  <h5 class="Card__price--old">AED {{ $item->old_price }}</h5>
                                @endif
        					</div>
        				</div>

        				<div class="Card__action">
        					<form method="POST" action="{{ route('cart.store') }}">
        						{{ csrf_field() }}
        						<input type="hidden" name="item_id" value="{{ $item->id }}" />
        						<div class="form-group">
        							<button class="btn btn-default">Add to cart</button>
        						</div>
        					</form>
        				</div>
        			</div>
        		</li>
        	@endforeach
        </ul>

        <div class="container">
            <div class="row">
            	<div class="col-md-12">
            		<div class="Subpage__subtitle--container">
            			<h2 class="Subpage__subtitle">Follow us on Instagram</h2>
            			<p class="Subpage__subtitle--small">Because why not?</p>
            		</div>
            	</div>
            </div>
        </div>
    </div>  
@endsection

@section('footer_scripts')
    <script src="{{ elixir('js/home.js') }}"></script>
@endsection