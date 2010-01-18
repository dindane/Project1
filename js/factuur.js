
function roundNumber(number,decimals) {
  var newString;// The new rounded number
  decimals = Number(decimals);
  if (decimals < 1) {
    newString = (Math.round(number)).toString();
  } else {
    var numString = number.toString();
    if (numString.lastIndexOf(".") == -1) {// If there is no decimal point
      numString += ".";// give it one at the end
    }
    var cutoff = numString.lastIndexOf(".") + decimals;// The point at which to truncate the number
    var d1 = Number(numString.substring(cutoff,cutoff+1));// The value of the last decimal place that we'll end up with
    var d2 = Number(numString.substring(cutoff+1,cutoff+2));// The next decimal, after the last one we want
    if (d2 >= 5) {// Do we need to round up at all? If not, the string will just be truncated
      if (d1 == 9 && cutoff > 0) {// If the last digit is 9, find a new cutoff point
        while (cutoff > 0 && (d1 == 9 || isNaN(d1))) {
          if (d1 != ".") {
            cutoff -= 1;
            d1 = Number(numString.substring(cutoff,cutoff+1));
          } else {
            cutoff -= 1;
          }
        }
      }
      d1 += 1;
    } 
    if (d1 == 10) {
      numString = numString.substring(0, numString.lastIndexOf("."));
      var roundedNum = Number(numString) + 1;
      newString = roundedNum.toString() + '.';
    } else {
      newString = numString.substring(0,cutoff) + d1.toString();
    }
  }
  if (newString.lastIndexOf(".") == -1) {// Do this again, to the new string
    newString += ".";
  }
  var decs = (newString.substring(newString.lastIndexOf(".")+1)).length;
  for(var i=0;i<decimals-decs;i++) newString += "0";
  //var newNumber = Number(newString);// make it a number if you like
  return newString; // Output the result to the form field (change for your purposes)
}

function update_total() {
	// beginnen met 0
  var total = 0;
  // voor elke prijs per lijn 
  $('.price').each(function(i){
  	//euroteken vervangen door niks zodat we kunnen rekenen
    price = $(this).html().replace("\u20ac","");
    if (!isNaN(price)) total += Number(price);
  });
	// totaal afronden
  total = roundNumber(total,2);
//eurotekens erbijvoegen
  $('#subtotal').html("\u20ac"+total);
  $('#total').html("\u20ac"+total);
}

function update_price() {
	// de rij waar we inzitte
  var row = $(this).parents('.item-row');
  // prijs van de rij berekenen
  var price = row.find(".cost").val().replace("\u20ac","") * row.find('.qty').val();
  // prijs afronden
  price = roundNumber(price,2);
  isNaN(price) ? row.find('.price').html("N/A") : row.find('.price').html("\u20ac"+price);
  // het totaal terug berekenen aangezien prijs is veranderd in een lijn (dus weer loopen door alles)
  update_total();
}

function bind() {
  $(".cost").blur(update_price);
  $(".qty").blur(update_price);
}

$(document).ready(function() {
   // als we klikken dan toevoegen na de laatste rij
  $("#addrow").click(function(){
  	/*    $(".item-row:last").after('<tr class="item-row"><td class="item-name"><div class="delete-wpr"><input type="text" name="code" class="code"/><a class="delete" href="javascript:;" title="Remove row">X</a></div></td><td class="description"><span>Hier moet omschrijving komen</span></td><td><textarea class="cost">&#8364;</textarea></td><td><textarea class="qty"></textarea></td><td><span class="price">&#8364;0</span></td></tr>');*/
    $(".item-row:last").after('<tr class="item-row"><td class="item-name"><div class="delete-wpr"><textarea name="code" class="code"></textarea><a class="delete" href="javascript:;" title="Remove row">X</a></div></td><td class="description"></td><td><textarea disabled="disabled" id="disabled" name="cost[]" class="cost"></textarea></td><td><textarea class="qty" name="qty[]">1</textarea></td><td><span class="price">&#8364;0</span></td></tr>');
    if ($(".delete").length > 0) $(".delete").show();
    bind();
  });
  bind();
  // rij verwijderen + totaal terug berekenen -> rij verdwenen
  $(".delete").live('click',function(){
    $(this).parents('.item-row').remove();
    update_total();
    // ervoor zorgen dat er per factuur minstens 1 item aangekocht wordt
    if ($(".delete").length <1) $(".delete").hide();
  }); 
});