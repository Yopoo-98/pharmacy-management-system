<?php
$conn = mysqli_connect("localhost", "root", "", "pharmacy");
$medicines = mysqli_query($conn, "SELECT * FROM medicine");
include "sidebar/new_sidebar.php"; // import sidebar
?>

<!-- Content -->
<div class="content">
    <h2>Create Sale Invoice</h2>
    <form method="POST" action="save_sale.php">
         <?php
                        if(isset($_GET['msg'])){
                        $msg = $_GET['msg'];
                        echo'<div class="alert alert-warning alert-dismissible fade show" role="alert">
                        '.$msg.'
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>';
                        }
                        ?>
        <div class="row mb-3">
            <div class="col-md-6">
                <label>Customer Name</label>
                <input type="text" name="customer_name" class="form-control" required>
            </div>
            <div class="col-md-6">
                <label>Payment Mode</label>
                <select name="payment_mode" class="form-control" required>
                    <option value="Cash">Cash</option>
                    <option value="Momo">Momo</option>
                    <option value="Cheque">Cheque</option>
                </select>
            </div>
        </div>

        <h4>Medicines</h4>
        <table class="table table-bordered" id="medicineTable">
            <thead>
                <tr>
                    <th>Medicine</th>
                    <th>Info</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
        <button type="button" class="btn btn-secondary" onclick="addMedicineRow()">+ Add Medicine</button>

        <div class="row mt-4">
            <div class="col-md-4">
                <label>Discount</label>
                <input type="number" id="discount" name="discount" class="form-control" value="0" onchange="updateTotal()">
            </div>
            <div class="col-md-4">
                <label>Grand Total (Before Discount)</label>
                <input type="number" name="grand_total" id="grand_total" class="form-control" readonly>
            </div>
            <div class="col-md-4">
                <label>Final Total (After Discount)</label>
                <input type="number" id="final_total" name="final_total" class="form-control" readonly>
            </div>
        </div>

        <button type="submit" class="btn btn-primary mt-3">Complete Sale</button>
    </form>
</div>

<script>
    let medicineData = {};

    <?php
    $medicines = mysqli_query($conn, "SELECT * FROM medicine");
    while ($row = mysqli_fetch_assoc($medicines)) { ?>
        medicineData[<?= $row['medicine_id'] ?>] = {
            name: "<?= $row['medicine_name'] ?>",
            price: <?= $row['selling_price'] ?>,
            stock: <?= $row['quantity'] ?>,
            generic: "<?= $row['generic_name'] ?>",
            batch: "<?= $row['batch_id'] ?>"
        };
    <?php } ?>

    function addMedicineRow() {
        let table = document.getElementById("medicineTable").getElementsByTagName("tbody")[0];
        let row = table.insertRow();
        
        let cell1 = row.insertCell(0);
        let select = document.createElement("select");
        select.className = "form-select";
        select.name = "medicine_id[]";
        select.onchange = function() { updateMedicineInfo(this); };
        select.innerHTML = "<option value=''>Select Medicine</option>";
        for (const id in medicineData) {
            select.innerHTML += "<option value='" + id + "'>" + medicineData[id].name + "</option>";
        }
        cell1.appendChild(select);

        row.insertCell(1).innerHTML = "<span class='drug-info'></span>";
        row.insertCell(2).innerHTML = "<input type='number' name='price[]' class='form-control price' readonly>";
        row.insertCell(3).innerHTML = "<input type='number' name='quantity[]' class='form-control qty' value='1' min='1' onchange='updateLineTotal(this)'>";
        row.insertCell(4).innerHTML = "<input type='number' name='line_total[]' class='form-control line-total' readonly>";
    }

    function updateMedicineInfo(select) {
        let row = select.closest("tr");
        let infoCell = row.querySelector(".drug-info");
        let priceInput = row.querySelector(".price");
        let qtyInput = row.querySelector(".qty");
        let lineTotal = row.querySelector(".line-total");

        let medicine = medicineData[select.value];
        if (medicine) {
            infoCell.innerHTML = "Batch: " + medicine.batch + " | Generic: " + medicine.generic + " | Stock: " + medicine.stock;
            priceInput.value = medicine.price;
            lineTotal.value = medicine.price * qtyInput.value;
        }
        updateTotal();
    }

    function updateLineTotal(qtyInput) {
        let row = qtyInput.closest("tr");
        let priceInput = row.querySelector(".price");
        let lineTotal = row.querySelector(".line-total");

        let price = parseFloat(priceInput.value || 0);
        let qty = parseInt(qtyInput.value || 0);
        lineTotal.value = price * qty;
        updateTotal();
    }

    function updateTotal() {
        let totals = document.querySelectorAll(".line-total");
        let sum = 0;
        totals.forEach(t => { sum += parseFloat(t.value || 0); });

        let discount = parseFloat(document.getElementById("discount").value || 0);
        let finalTotal = sum - discount;
        if (finalTotal < 0) finalTotal = 0;

        document.getElementById("grand_total").value = sum.toFixed(2);
        document.getElementById("final_total").value = finalTotal.toFixed(2);
    }
</script>
