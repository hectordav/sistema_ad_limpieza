 <script type="text/javascript">

    //EVENTOS EN javascript

    function efectivo(id)

    {
        var total = document.getElementById('lbl_num_fact').value;
        var efectivo= document.getElementById('txt_efectivo').value;
        var resto= total-efectivo;
        if (resto>0) {
            alert('EL pago es menor al monto de la factura');
        }else{
       $("#efectivo_2").load("<?php echo $this->config->base_url();?>index.php/factura/imprimir/", { id: id });
        };

    }
    function cheque(id)
    {
        var total = document.getElementById('lbl_num_fact').value;
        var monto= document.getElementById('txt_monto').value;
        var efectivo= document.getElementById('txt_efectivo_2').value;
        var resto= total-monto-efectivo;
            if (resto>0)
            {
                alert('EL pago es menor al monto de la factura');
            }else{
              $("#cheque_2").load("<?php echo $this->config->base_url();?>index.php/factura/imprimir/", { id: id });
            };

    }
           function punto(id)
    {
        var total = document.getElementById('lbl_num_fact').value;
        var monto= document.getElementById('txt_monto_2').value;
        var efectivo= document.getElementById('txt_efectivo_3').value;
        var resto= total-monto-efectivo;
        if (resto>0) {
                alert('EL pago es menor al monto de la factura');
             }else{
              $("#enviar").load("<?php echo $this->config->base_url();?>index.php/factura/imprimir/", { id: id });
             };
    }
     function presupuesto(id)
    {
        $("#vaso").load("<?php echo $this->config->base_url();?>index.php/presupuesto/imprimir/", { id: id });
    }
    </script>
