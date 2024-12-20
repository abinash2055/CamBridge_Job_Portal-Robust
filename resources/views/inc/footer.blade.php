<footer>
  <div class="footer-main">
    <div class="container">
      <div class="row">
        <div class="col-sm-6 col-md-3">
          <div class="footer-links">
            <h5 class="lead footer-hdr">For Job Seekers</h5>
            <div class="line-divider"></div>
            <div class="footer-link-list">
              <a href="{{ route('register') }}" class="footer-links">Register <span class="badge badge-primary">Free</span></a>
              <a href="{{ route('login') }}" class="footer-links">Login</a>
              <a href="#" class="footer-links">Find jobs</a>
              <a href="{{ route('home.faqs') }}" class="footer-links">FAQ</a> 
            </div>
          </div>
        </div>
        <div class="col-sm-6 col-md-3">
          <div class="footer-links">
            <h5 class="lead footer-hdr">For Employers</h5>
            <div class="line-divider"></div>
            <div class="footer-link-list">
              <a href="{{ route('register') }}" class="footer-links">Register <span class="badge badge-primary">Free</span></a>
              <a href="{{ route('login') }}" class="footer-links">Login</a>
              <a href="{{ route('author.post.create') }}" class="footer-links">Vacancy Announcement</a>
              <a href="{{ route('home.faqs') }}" class="footer-links">FAQ</a> 
            </div>
          </div>
        </div>
        <div class="col-sm-6 col-md-3">
          <div class="footer-links">
            <h5 class="lead footer-hdr">Links</h5>
            <div class="line-divider"></div>
            <div class="footer-link-list">
              <a href="#" class="footer-links">Home</a>
              <a href="#" class="footer-links">About Us</a>
              <a href="#" class="footer-links">Advertise</a>
              <a href="{{ route('contact') }}" class="footer-links">Contact Us</a> 
              <a href="{{ route('home.faqs') }}" class="footer-links">FAQ</a> 
            </div>
          </div>
        </div>
        <div class="col-sm-6 col-md-3">
          <div class="footer-links">
            <h3 class="footer-brand mb-2">Cambridge Infotech</h3>
            <div class="footer-link-list">
              <a href="#" class="footer-links"><i class="fas fa-compass"></i> New Baneshwor, Kathmandu, Nepal</a>
              <a href="tel:98400001511" class="footer-links"><i class="fas fa-phone"></i> +977-1-4596122</a>
              <a href="mailto:info@cambridgeinfotech.com.np" class="footer-links"><i class="fas fa-envelope"></i> info@cambridgeinfotech.com.np</a>
              <div class="social-links">
                <a href="https://www.facebook.com/cambridgeinfotech.com.np" target="_blank" class="social-link"><i class="fab fa-facebook"></i></a>
                <a href="https://twitter.com/CambridgeNepal" target="_blank" class="social-link"><i class="fab fa-twitter"></i></a>
                <a href="https://goo.gl/maps/3KKDLKX7YVrXtLZq5" target="_blank" class="social-link"><i class="fab fa-google"></i></a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</footer>


@push('css')
<style>
  .footer-main {
    background-color: #313131;
    color: #ddd;
  }
  .footer-links {
    padding-top: 2rem;
    padding-bottom: 2rem;
  }
  .footer-links .footer-hdr {
    color: #ddd;
  }
  .footer-links .footer-link-list .footer-links {
    display: block;
    color: #ccc;
    padding: 3px 0; 
    margin: 0;
    font-size: .9rem;
  }
  .footer-links .footer-link-list .footer-links:hover {
    color: white;
  }
  .footer-main .social-links {
    margin: 20px 0;
  }
  .footer-main .social-links .social-link {
    background-color: white; 
    color: #333;
    padding: 8px 10px;
    border-radius: 50%;
    transition: all .3s ease;
  }
  .footer-main .social-links .social-link:hover {
    color: white;
    background-color: #0261A6;
  }
</style>
@endpush
