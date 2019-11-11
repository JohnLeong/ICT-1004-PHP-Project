function filter_items() {
    var i, h, j = 0; //declaring variables for filtering loop
    var filtered = document.getElementsByClassName("filterItem");
    var checked = document.getElementsByClassName("form-check-input");
    
    for (j = 0; j < filtered.length; j++) { //sets all elements to block display
        filtered[j].style.display = "block";
    }
    for (i = 0; i < filtered.length; i++) { //for every product
        for (h = 0; h < checked.length; h++) { //for all brands & types 
            console.log(checked[h].id);
            if (checked[h].checked == false) //if brand/type is not selected, skip
                continue;
            if (filtered[i].classList.contains(checked[h].id)) {
                break; //if brand/type is selected
            }
            filtered[i].style.display = "none"; //hide the product
        }
    }

}
