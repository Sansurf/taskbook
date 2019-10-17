window.onload = function () {

    /**
     * Скрипт подгоняет генерируемый вид пагинации под новую версию bootstrap
     * @type {Element}
     */
    let ulPagination = document.getElementsByClassName('pagination')[0];

    ulPagination.classList.add('justify-content-center');

    let liElements = ulPagination.getElementsByTagName('li');
    for(let i=0; i<liElements.length; i++) {
        let li = liElements[i];
        li.classList.add('page-item');
        let issetElem = li.getElementsByTagName('a');

        if (!issetElem.length) {
            li.classList.add('disabled');
        }
        let liInner = li.innerHTML;
        let divInLi = document.createElement('div');
        divInLi.classList.add("page-link");
        divInLi.innerHTML = liInner;
        li.innerHTML = "";
        li.appendChild(divInLi);
    }
};