<div>
    @if (session()->has('message')) <!-- message varsa yazıyo burası-->
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
        
    @endif
    <form class="review-form" wire:submit.prevent="store">
        <div class="form-group">
            <input class="input" wire:model="subject" type="text" placeholder="Subject" /> <!-- name ksımı yerine wire:model kullanıyoruz -->
            @error('subject') <span class="text-danger">{{$message}}</span>  @enderror
        </div>
        <div class="form-group">
            <textarea class="input" wire:model="review" type="text" placeholder="Your review"> </textarea>
            @error('review') <span class="text-danger">{{$message}}</span>  @enderror
        </div>
        <div class="form-group">
            <div class="input-rating">
                @error('rate') <span class="text-danger">{{$message}}</span>  @enderror
                <strong class="text-uppercase">Your Rating: </strong>
                <div class="stars">
                    <input type="radio" id="star5" wire:model="rate" value="5" /><label for="star5"></label>
                    <input type="radio" id="star4" wire:model="rate" value="4" /><label for="star4"></label>
                    <input type="radio" id="star3" wire:model="rate" value="3" /><label for="star3"></label>
                    <input type="radio" id="star2" wire:model="rate" value="2" /><label for="star2"></label>
                    <input type="radio" id="star1" wire:model="rate" value="1" /><label for="star1"></label>
                </div>
            </div>
        </div>
        @auth <!--login girişi var ise save butonu çıkıcak yok ise logine yollicak-->
            <input type="submit" class="btn btn-success" value="Save">
        @else
            <a href="/login" class="primary-btn">For Submit Your Review, Please Login</a>
        @endauth
        
    </form>
</div>
