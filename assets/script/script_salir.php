<script language="javascript" type="text/javascript">
window.onbeforeunload = function (e) {
  var e = e || window.event;
  // For IE and Firefox
  if (e) {
    e.returnValue = '';
  }
  // For Safari
  alert("salir");
 // return 'Mensaje';
};
</script>