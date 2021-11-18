$(document).ready(function(){
    if (localStorage.getItem('cookieSeen') != 'shown') {
        $('.cookie-banner').delay(2000).fadeIn();
      };
      $('.close').click(function() {
        $('.cookie-banner').fadeOut();
        localStorage.setItem('cookieSeen','shown')
      })
})
