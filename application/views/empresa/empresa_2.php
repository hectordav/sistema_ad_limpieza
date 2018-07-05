<form name="form1" method="post" action="guardar"> 
  <p> 
    <div class="container">
    <div class="row">
      <input type="text" name="NOMBRE" id="inputNombre" class="form-control" required="required">
      <input type="text" name="RIF" id="inputRIF" class="form-control"  required="required" >
      <input type="text" name="DIRECCION" id="inputDIRECCION" class="form-control"required="required" >
     <input type="text" name="TELF1" id="inputTELF1" class="form-control"  required="required" >
     <input type="text" name="TELF-2" id="inputTELF1" class="form-control"  required="required">
    </div>
  </div>
<!--      <input onkeyup="if(form1.textfield2.value!=''){form1.textfield3.value = parseInt(this.value)+parseInt(form1.textfield2.value)} else {form1.textfield3.value =''}" name="nombre" type="text" size="8" maxlength="8"> 
     </p>  
     <p>  
     Numero 2: 
      <input onkeyup="if(form1.textfield2.value!=''){form1.textfield3.value = parseInt(this.value)+parseInt(form1.textfield1.value)} else {form1.textfield3.value =''}" name="nombre2" type="number" size="8" maxlength="8">
    
  </p> 
  <p>Resultado es: <input name="textfield3" type="text" size="10" maxlength="10" readonly="readonly"> 
</p>-->  <button type="submit" class="btn btn-sm btn-default">guardar</button>
</form> 