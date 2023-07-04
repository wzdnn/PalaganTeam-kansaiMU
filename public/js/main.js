// dashboard dropdown sub button

const menuBtn = document.getElementsByClassName('menu-btn');
const subBtn = document.getElementsByClassName('sub-btn');
const closeBtn = document.getElementsByClassName('close-btn');
const rotate = document.getElementsByClassName('rotate');
const dropdown = document.getElementsByClassName('dropdown');
const active = document.getElementsByClassName('active');

function sideBar() {
  $(subBtn).click(function () {
    $(this).next('.sub-menu').slideToggle();
    $(this).find('.dropdown').toggleClass('rotate');
  });
  $('.menu-btn').click(function () {
    $('.side-bar').addClass('active');
    $('.menu-btn').css('visibility', 'hidden');
  });

  $('.close-btn').click(function () {
    $('.side-bar').removeClass('active');
    $('.menu-btn').css('visibility', 'visible');
  });
}
