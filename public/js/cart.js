$(document).ready(function(){
    //btn plus
    $(".btn-plus").click(function(){
        $parentNode = $(this).parents("tr");
        $price = Number($parentNode.find("#pizzaPrice").html().replace("Ks",""));
        $qty = Number($parentNode.find("#qty").val());
        $total = $price * $qty;
        $parentNode.find("#total").html($total+" Ks");

        summaryCalculation();
    })

    //btn minus
    $(".btn-minus").click(function(){
        $parentNode = $(this).parents("tr");
        $price = Number($parentNode.find("#pizzaPrice").text().replace("Ks",""));
        $qty = Number($parentNode.find("#qty").val());
        $total = $price * $qty;
        $parentNode.find("#total").html($total+" Ks");

        summaryCalculation();
    })

    

    //subtotal summary
    function summaryCalculation()
    { 
        $totalPrice = 0;
        $("#dataTable tbody tr").each(function(index, row){//(index,row)
            $totalPrice += Number($(row).find("#total").text().replace("Ks",""));
        });
        $("#subTotalPrice").html(`${$totalPrice} Ks`);
        $("#finalPrice").html(`${$totalPrice + 3000} Ks`);
    }
})