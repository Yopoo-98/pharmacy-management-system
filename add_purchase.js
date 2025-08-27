function cal_quantity(value){

    let quantity = parseInt(document.querySelector("#quantity").value);
    let mrp = parseInt(document.querySelector("#mrp").value);
    
    let amount = quantity * mrp;

    document.querySelector('#amount').value=amount;
    
}
function cal_mrp(value){

    let quantity = parseInt(document.querySelector("#quantity").value);
    let mrp = parseInt(document.querySelector("#mrp").value);
    
    let amount = quantity * mrp;

    document.querySelector('#amount').value=amount;

    
}