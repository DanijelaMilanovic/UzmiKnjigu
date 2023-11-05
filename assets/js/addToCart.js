let price = 0;
let number = 0;

function getBookmarks() {
    fetch(BASE + 'api/bookmarks', { credentials: 'include' })
        .then(result => result.json())
        .then(data => {
            displayBookmarks(data.bookmarks);
        });
}

function addBookmark(bookId) {
    fetch(BASE + 'api/bookmarks/add/' + bookId, { credentials: 'include' })
        .then(result => result.json())
        .then(data => {
            if (data.error === 0) {
                getBookmarks();
            }
        });
}

function clearBookmarks() {
    fetch(BASE + 'api/bookmarks/clear', { credentials: 'include' })
        .then(result => result.json())
        .then(data => {
            if (data.error === 0) {
                getBookmarks();
            }
        });
}

function displayBookmarks(bookmarks) {

    const bookNumber = document.getElementById('number-of-items');
    bookNumber.innerHTML = '';

    const cartPrice = document.getElementById('price-of-items');
    if(cartPrice) {
        price = 0;
        for (bookmark of bookmarks) {
            price += Number(bookmark.price);
        }
        cartPrice.innerHTML = price + ".00 KM";

    }

    if (bookmarks.length != 0) {
        bookNumber.innerHTML = bookmarks.length + " stavke";
        number = bookmarks.length;
    }

}

addEventListener('load', getBookmarks);