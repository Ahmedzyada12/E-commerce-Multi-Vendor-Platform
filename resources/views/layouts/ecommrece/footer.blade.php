<footer class="bg-dark text-light py-4 mt-5 text-center text-lg-start">
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <h5>{{ __('customTranslate.About') }}</h5>
                <p>
                    {{ __('customTranslate.Leading the way in eco-friendly shopping, we offer a wide range of products that are good for you and the planet.') }}
                </p>
            </div>
            <div class="col-md-3 text-lg-start text-center">
                <h5> {{ __('customTranslate.Quick Links') }}</h5>
                <ul class="list-unstyled">
                    <li class="text-lg-start text-center">
                        <a href="#" class="text-light">{{ __('customTranslate.Home') }}</a>
                    </li>
                    <li class="text-lg-start text-center">
                        <a href="#" class="text-light">{{ __('customTranslate.Shop') }}</a>
                    </li>
                    <li class="text-lg-start text-center">
                        <a href="#" class="text-light">{{ __('customTranslate.About') }}</a>
                    </li>
                    <li class="text-lg-start text-center">
                        <a href="#" class="text-light">{{ __('customTranslate.Contact') }}</a>
                    </li>
                </ul>
            </div>
            <div class="col-md-3">
                <h5> {{ __('customTranslate.Contact Us') }}</h5>
                <p><i class="fas fa-envelope"></i> email@example.com</p>
                <p><i class="fas fa-phone"></i> +123 456 7890</p>
            </div>
            <div class="col-md-3">
                <h5> {{ __('customTranslate.Stay Connected') }}</h5>
                <div class="my-4">
                    <a href="#" class="text-light mr-2"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="text-light mx-4"><i class="fab fa-twitter"></i></a>
                    <a href="#" class="text-light mr-2"><i class="fab fa-instagram"></i></a>
                </div>
                <h5>{{ __('customTranslate.Newsletter') }}</h5>
                <form>
                    <div class="form-group">
                        <input type="email" name="e-mail" class="form-control" placeholder="Your Email" />
                        <button type="submit" class="btn btn-primary mt-3">
                            {{ __('customTranslate.Subscribe') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</footer>
