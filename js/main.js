function filter_items() {
    var i, h, j = 0; //declaring variables for filtering loop
    var filtered = document.getElementsByClassName("filterItem");
    var checked = document.getElementsByClassName("form-check-input");
    
    for (j = 0; j < filtered.length; j++) { //sets all elements to block display
        filtered[j].style.display = "block";
    }
    for (i = 0; i < filtered.length; i++) { //for every product
        var found = false;
        var check = false;
        for (h = 0; h < checked.length; h++) { //for all brands & types 
            if (checked[h].checked == false) //if brand/type is not selected, skip
                continue;
            check = true;
            if (filtered[i].classList.contains(checked[h].id)) {
                found = true;
                break; //if brand/type is selected
            }
        }
        if (found == false && check == true) {
            filtered[i].style.display = "none"; //hide the product
        }
    }

}
