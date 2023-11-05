/**
 * skripta za izlistavanje knjiga i upucivanje asinhronih zahtjeva
 */
window.addEventListener('load',main);

var next = document.getElementById('next');
var previous = document.getElementById('previous');
let numberOfPage = 1;

next.addEventListener('click', () => {
    if(next.disabled == true) {
        return;
    }
    numberOfPage++;
    console.log(numberOfPage);
    main();
    if(next.disabled != true) {
        $('html,body').scrollTop(0);
    }
});
previous.addEventListener('click', () => {
    if(previous.disabled == true) {
        return;
    }
    if(next.disabled == true) {
        next.disabled = false;
        next.classList.remove("disabled");
    }
    numberOfPage--;
    main();
    $('html,body').scrollTop(0);
});

/* funkcija koja upucuje asinhroni zahtjev */
function main() {
    console.log(books);
    //generateBookList(books.slice((10*(numberOfPage-1)), (10*numberOfPage)));
}

/* generisanje html a na osnovu liste knjiga */
function generateBookList(list) {
    let items = '';
    console.log(list.length);
    if(list.length !== 0) {
        for (let book of list) {
            items +=
                `<div class="col">
                <div class="card h-100 shadow-sm"> <img src="/assets/uploads/${book[0].image}" class="card-img-top" loading="lazy" alt="...">
                    <div class="card-body">
                        <div class="clearfix mb-3"> <span class="float-start badge rounded-pill bg-primary">${book[0].category}</span> <span class="float-end price-hp">${book[0].price} $</span> </div>
                        <h5 class="card-title">${book[0].title}</h5>
                        <div class="text-center my-4"> <a href="/book/${book[0].id}" class="btn btn-warning">Detaljnije</a> </div>
                    </div>
                </div>
            </div>`;
        }
        document.getElementById("bookList").innerHTML = items;
        if(numberOfPage == 1) {
            previous.disabled = true;
            previous.classList.add("disabled");
            return;
        }

        previous.disabled = false;
        previous.classList.remove("disabled");
    }
    else {
        next.disabled = true;
        next.classList.add("disabled");
    }

}
