/**
 * helper skripta za responsive korpu
 */
jQuery(document).ready(function($) {
    $(document).ready(function() {
            if ($(window).width() < 769) {
                $(`<button id="nav-cart" class="navbar-toggler" type="button">
                  <a href="${BASE}cart"><img src="${BASE}assets/img/ShoppingCartNav.png"/></a>
                  <span id="number-of-items">${number}</span>
                </button>`).appendTo($("nav>div").first());
            };
            if ($(window).width() > 769) {
                $(`<div id="cart">
                    <a  href="${BASE}cart">
                      <img src="${BASE}assets/img/ShoppingCartPC.png" />
                    </a>
                    <div>
                      <div><span id="number-of-items">${number}</span></div>
                      <div id="price-of-items">${price}</div>
                    </div>
                </div>`).appendTo($("div").first());
            };
        });
    $(window).resize(function() {
        if ($(window).width() < 769) {
            if($("#cart").length > 0) {
                $("#cart").remove();   
            }
            if($("#nav-cart").length === 0) {
                $(`<button id="nav-cart" class="navbar-toggler" type="button">
                  <a href="${BASE}cart"><img src="Assets/img/ShoppingCartNav.png"/></a>
                  <span id="number-of-items">${number}</span>
                </button>`).appendTo($("nav>div").first());
            }
        };
        if ($(window).width() > 769) {   
            if($("#nav-cart").length > 0) {
                $("#nav-cart").remove();
            }
            if($("#cart").length === 0) {
                $(`<div id="cart">
                  <a  href="${BASE}cart">
                    <img src="Assets/img/ShoppingCartPC.png" />
                  </a>
                  <div>
                    <div><span id="number-of-items">${number}</span> stavke</div>
                    <div id="price-of-items">${price}<span id="price-of-items"></span>.00 KM</div>
                  </div>
                </div>`).appendTo($("div").first());
            }
        };
    });
});

