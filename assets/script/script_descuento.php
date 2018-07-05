 <script>

function fncSumar(){
var descuento = Number(document.getElementById("descuento").value);
var sub_total = Number(document.getElementById("sub_total").value);
var valor_descuento = Number(document.getElementById("descuento_2").value =  (descuento*sub_total)/100);
var sub_total_nuevo =sub_total-valor_descuento;
var iva= Number(document.getElementById("iva").value =((sub_total_nuevo*23)/100));
var total=Number(document.getElementById("total").value =((sub_total_nuevo+iva)));
document.getElementById("lbl_descuento").value =(descuento);
document.getElementById("lbl_sub_total").value =(sub_total);
document.getElementById("lbl_descuento_2").value =(valor_descuento);
document.getElementById("lbl_iva").value =(iva);
document.getElementById("lbl_total").value =(total);
}
</script>