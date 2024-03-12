function toggleMenu() {
    var menu = document.querySelector('.menu');
    menu.classList.toggle('active');
  }
  
  window.addEventListener('resize', function () {
    var menu = document.querySelector('.menu');
    if (window.innerWidth > 768) {
      menu.classList.remove('active');
    }
  });
  