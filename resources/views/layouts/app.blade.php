
<!DOCTYPE html>
<html lang="en">
  <title>MySchool</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link href="{{ asset('css/styles.css') }}" rel="stylesheet" />
  @yield('style')

  <body>

    <!-- Navbar -->
    <div class="w3-top">
      <div class="w3-bar w3-black w3-card">
        <a class="w3-bar-item w3-button w3-padding-large w3-hide-medium w3-hide-large w3-right" href="javascript:void(0)" onclick="myFunction()" title="Toggle Navigation Menu"><i class="fa fa-bars"></i></a>
        <a href="/" class="w3-bar-item w3-button w3-padding-large">HOME</a>
        <a href="/contacts" class="w3-bar-item w3-button w3-padding-large w3-hide-small"><i class="fa fa-address-book"></i>&nbsp; CONTACTS</a>
        
        <a href="javascript:void(0)" class="w3-padding-large w3-hover-red w3-hide-small w3-right"><i class="fa fa-search"></i></a>

        @guest
        <a href="/contacts/create" class="w3-bar-item w3-button w3-padding-large w3-hide-small w3-right"><i class="fa fa-address-book-o"></i>&nbsp; ADD NEW CONTACT</a>
        @endguest
        
      </div>
    </div>

    <!-- Navbar on small screens (remove the onclick attribute if you want the navbar to always show on top of the content when clicking on the links) -->
    <div id="navDemo" class="w3-bar-block w3-black w3-hide w3-hide-large w3-hide-medium w3-top" style="margin-top:46px">
      @guest
      <a href="/contacts" class="w3-bar-item w3-button w3-padding-large"><i class="fa fa-address-book"></i>&nbsp; CONTACTS</a>
      <a href="/contacts/create" class="w3-bar-item w3-button w3-padding-large"><i class="fa fa-address-book-o"></i>&nbsp; ADD NEW CONTACT</a>
      @endguest
    </div>

    @yield('content')

    <script src="{{ asset('js/scripts.js') }}"></script>
    @yield('script')

    </body>
  </html>
  