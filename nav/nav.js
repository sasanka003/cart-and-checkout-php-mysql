$(document).ready(function () {
    // Add 'active' class on click for all nav-items except 'cart' item
    $(".navbar-nav .nav-item:not(.cart)").on("click", function () {
      $(".navbar-nav .nav-item").removeClass("active");
      $(this).addClass("active");
    });
  
    // Remove 'active' class when cart is clicked
    // $(".navbar-nav .cart").on("click", function () {
    //   $(".navbar-nav .nav-item").removeClass("active");
    // });

    var excludedPages = ['','products', 'about', 'contact'];
    var currentPath = window.location.pathname.split('/').pop(); // Get the current page from the URL
  
    if (excludedPages.indexOf(currentPath) === -1) {
      $(".navbar-nav .nav-item").removeClass("active");
    }
  
  $("#sidebarCollapse").on("click", function () {
    $("#sidebar").addClass("active");
  });

  $("#sidebarCollapseX").on("click", function () {
    $("#sidebar").removeClass("active");
  });

  $("#sidebarCollapse").on("click", function () {
    if ($("#sidebar").hasClass("active")) {
      $(".overlay").addClass("visible");
      console.log("it's working!");
    }
  });

  $("#sidebarCollapseX").on("click", function () {
    $(".overlay").removeClass("visible");
  });
});