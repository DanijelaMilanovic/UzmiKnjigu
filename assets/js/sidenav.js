/**
 * skripta za sidenav
 */
var menu_btn = document.querySelector("#menu-btn");
var sidebar = document.querySelector("#sidebar");
var container = document.querySelector(".my-container");
const toggleBtn = document.querySelector("#toggleBtn");

/* dugme show sidebar*/
menu_btn.addEventListener("click", () => {
  sidebar.classList.toggle("active-nav");
  container.classList.toggle("active-cont");
  
  //prvo da se poništi desna ikonica pa onda lijeva 
  toggleBtn.classList.toggle("bi-caret-right-fill");
  toggleBtn.classList.toggle("bi-caret-left-fill");
  
  if(!sidebar.classList.contains("active-nav")) { 
    $("main").css("visibility", "visible");
    return;
  }

  /* sakrij ako je velicina ekrana manja od 466*/
  if($(window).width() > 466 ) return;

  $("main").css("visibility", "hidden");
});

/* u pocetnom stanju  */
/*
$(document).ready(function() {
  if($(window).width() >= 466 && ($("main").css('visibility') === 'hidden')) {
    $("main").css("visibility", "visible");
  }
  if($(window).width() < 466 && ($("main").css('visibility') === 'visible') && sidebar.classList.contains("active-nav")) {
    $("main").css("visibility", "hidden");
  }
});*/

/* u slucaju resize a uklanjanje sakrivanje knjiga */
$(window).resize(function() {
  /* ako je velicina ekrana veća od 466 i knjige sklonjene prikaži ih*/
  if($(window).width() >= 466) {
    if(($("main").css('visibility') === 'hidden')) {
      $("main").css("visibility", "visible");
    }
    return;
  }
  /* ako je velicina ekrana manja od 466, knjige prikazane i otvoren side bar skloni ih*/
  if(($("main").css('visibility') === 'visible') && sidebar.classList.contains("active-nav")) {
    $("main").css("visibility", "hidden");
  }
});
