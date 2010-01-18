<link rel="stylesheet" type="text/css" href="../styles/autocomplete.css" />
<script type="text/javascript">
function lookup(inputString) {	
if(inputString.length == 0) {
		// Hide the suggestion box.
		$('#suggestions').hide();
	} else {
		$.post("<?php base_url();?>/kassa/application/models/autocomplete.php", {queryString: ""+inputString+""}, function(data){
			if(data.length >0) {
				$('#suggestions').show();
				$('#autoSuggestionsList').html(data);
				$('#alert').html(data);
				$('#alert').hide();
			}			
		});
	}

} // lookup
var check = function(){	
	$("#inputString").blur(function(){
				if($('#alert').html() === "Sorry, de opgegeven klant bestaat niet."){
					$('#alert').css("color","red").show();
				}else{
					$('#alert').hide();
				}
				});
	
}	
function fill(thisValue) {
	$('#inputString').val(thisValue);
	setTimeout("$('#suggestions').hide();", 200);
}
</script>

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
	check();	
	$('#test').hide(); //eerste rij verbergen (later is oplossen op betere manier)
});
</script>
	<div id="page-wrap">
		<div id="header">MAAK FACTUUR</div>
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
            <span id="customer-title">Tip klantnaam</span>
	<?php echo '<form  method="post" action="'.base_url().'welcome/factureer">';?>		
				<div style="clear:both"></div>
				<span>
					<input type="text" size="30" value="" name="naam[]" id="inputString" onkeyup="lookup(this.value);" onblur="fill();" />
					<input type="text" size="30" value="" name="naam[]" id="inputString" onkeyup="lookup(this.value);" onblur="fill();" />
				<span id="alert"></span>
				</span>
				<div class="suggestionsBox" id="suggestions" style="display: none;">
						<img src="../img/upArrow.png" style="position: relative; top: -12px; left: 30px;" alt="upArrow" />
						<div class="suggestionList" id="autoSuggestionsList">
							&nbsp;
						</div>
				</div>
		
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

		  <tr>
		      <th>Code</th>
		      <th>Omschrijving</th>
		      <th>Eenheidsprijs</th>
		      <th>Hoeveelheid</th>
		      <th>Prijs</th>
		  </tr>
		  <div >
		  <tr id="test" class="item-row">
		      <td class="item-name"><div class="delete-wpr"><textarea name="code1" class="code"></textarea></div></td>
		      <td class="description1"><span></span></td>
		      <td><textarea class="cost1" ></textarea></td>
		      <td><textarea class="qty1"></textarea></td>
		      <td><span class="price1"></span></td>
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
		  <tr>
	 		 <td colspan="5" align="center"><input type="submit" value="Factureren" name="send" class="submit"/></td>
 		 </tr>
		</table>	
		
<?php 

?>
		</form>
	</div>

			<div id="terms">
		  <h5>How to use</h5>
		 Gebruik <span style="color:red">w1, k1 of abc"</span> als code en druk op TAB. Voor Klantnaam kan je kristof,maarten,tine,kevin, ... gebruiken.<br />
		 User <span style="color:red">w1, k1 of abc"</span> as code and hit TAB. For clientnames you can use kristof,maarten,tine,kevin.
		</div>

