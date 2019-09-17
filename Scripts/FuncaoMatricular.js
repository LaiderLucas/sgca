(function($) {
   var a = 2; 
  RemoveTableRow = function(handler) {
    var tr = $(handler).closest('tr');

    tr.fadeOut(400, function(){ 
      tr.remove(); 
    }); 

    return false;
  };
  
  AddTableRow = function() {
      
      var newRow = $("<tr>");
      var cols = "";
      b = a++;
      
      cols +='<td style="display:none;" ><input value="'+b+'" name="controle" ></td>';
      cols += '<td><input class="col-sm-10" type="number" name="matricula'+b+'" required ></td>';

      cols += '<td><input class="col-sm-12" type="text" name="nome'+b+'" required></td>'; 

      cols += '<td><input type="checkbox" name="instituicao'+b+'" value="1" checked ="checked" required>IFMT - PL/FO</td>'; 
      
      cols += '<td class="actions">';
      cols += '<button class="btn btn-large btn-danger" onclick="RemoveTableRow(this)" type="button">Remover</button>';
      cols += '</td>';
      
      newRow.append(cols);
      
      $("#products-table").append(newRow);
    
      return false;
  };
  

})(jQuery);