<script type="text/javascript">
var calculate = function(){	
  	$('#loading').hide(); // ladenprentje verstoppe bij t begin
	$(".code").live("keypress", function(e){
  	if (e.keyCode == 9 ) {
  		// rij waarin we zitte zoeken en opslaan
  		var row = $(this).closest(".item-row"),
  		// code die we ingeven
		code = row.find(".code").val();
  		if (code != ""){	
		$.getJSON("../js/producten.js", function(json) {	
			// door het fileke loopen producten.js
			$.each(json.channel.items,function(i,item) {
				// als het item in de array items[i] overeenkomt met de naam dat ik opgeef
				if(json.channel.items[i].code == code) {
					 GezochtePrijs = json.channel.items[i].prijs;
					 GezochteOmschrijving = json.channel.items[i].omschrijving;
					 row.find(".cost").html("&#8364;"+GezochtePrijs);
 		 		     	row.find(".description").html(GezochteOmschrijving);
					// alert("DEBUG: Item werd gevonden");	
					var price = parseFloat(GezochtePrijs) * parseFloat(row.find('.qty').eq(0).val());
					row.find('.price').html(isNaN(price) ? 'N/A' : price.toString());
					update_total() ;
				}
			});	 // end each json
		});// end json		
		//end if code
		}else{
			alert("gelieve code op te geven");
		}
	}	// end if keycode 
   }); // end function   			
};
 
$(document).ready(function() {
	calculate();
	$('#test').hide();
});
</script>
	<div id="page-wrap">

		<div id="header">FACTUUR</div>
		<div id="identity">		
            <div id="address">
			Kristof s<br/>
			Straatnaam 132<br/>
			1000 Brussel<br/>
			</div>
		<div id="logo">
	      <img src="../img/kapper.jpg" alt="logo" />
        </div>
		</div>
		
		<div style="clear:both"></div>
		
		<div id="customer">
            <span id="customer-title">Klantnaam</span>

            <table id="meta">
                <tr>
                    <td class="meta-head"><strong>Factuur #</strong></td>
                    <td><span>000123</span></td>
                </tr>
                <tr>
                    <td class="meta-head"><strong>Datum</strong></td>
                    <td><span id="date"><?php echo date("j/m/Y");  ?></span></td>
                </tr>

            </table>
		
		</div>		
		<table id="items">
<?php echo '<form name="factuur" method="post" id="factuur" action="'.base_url().'index.php/welcome/get_price">';?>		
		  <tr>
		      <th>Code</th>
		      <th>Omschrijving</th>
		      <th>Eenheidsprijs</th>
		      <th>Hoeveelheid</th>
		      <th>Prijs</th>
		  </tr>
		  <div >
		  <tr id="test" class="item-row">
		      <td class="item-name"><div class="delete-wpr"><textarea name="code" class="code"></textarea></div></td>
		      <td class="description"><span></span></td>
		      <td><textarea class="cost" ></textarea></td>
		      <td><textarea class="qty"></textarea></td>
		      <td><span class="price"></span></td>
		  </tr>
		  </div>
  
		  <tr id="hiderow">
		    <td colspan="5"><a id="addrow" href="javascript:;" title="Add a row">(+) Voeg artikel toe</a></td>
		  </tr>
		  
		  <tr>
		      <td colspan="2" class="blank"> </td>
		      <td colspan="2" class="total-line"><strong>Subtotaal</strong></td>
		      <td class="total-value"><div id="subtotal">&#8364;0.00</div></td>
		  </tr>
		  <tr>

		      <td colspan="2" class="blank"> </td>
		      <td colspan="2" class="total-line"><strong>Totaal</strong></td>
		      <td class="total-value"><div id="total">&#8364;0.00</div></td>
		  </tr>
		 
		</table>	
<?php 

?>
		</form>
	</div>
			<div id="terms">
		  <h5>How to use</h5>
		 Use <span style="color:red">w1, k1 or abc"</span> as code and hit TAB.
		</div>
