		<!-- BOOTSTRAP CORE JS ============ -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
		<script src="js/jquery-3.1.0.min.js"></script>
		<script src="http://stripe.github.io/jquery.payment/lib/jquery.payment.js"></script>
		<script src="js/main.js"></script>
		<script src="js/bootstrap.js"></script>
		<script>		
			$('.carousel').carousel({
			  interval: 2000
			});
			$('input.cc-num').payment('formatCardNumber').on("keyup change", function(){
			  var type = $.payment.cardType( $(this).val() );
			  if(type == "visa"){
			    $(".company").html("VISA");
			    $(".card").attr("data-type", "visa");
			  } else if(type == "mastercard"){
			    $(".company").html("<div></div><div></div>");
			    $(".card").attr("data-type", "mastercard");
			  }else{
			    $(".card").attr("data-type", "unknown");
			    $(".company").html("CARD");
			  }
			});
			$('input.cc-exp').payment('formatCardExpiry');
			$('input.cc-cvc').payment('formatCardCVC');
			$(".button.flip").click(function(){
			  $(".card").toggleClass("flip");
			});
		</script>
		 <!-- Modules -->
		<script src="js/app.js"></script>
		<!-- Controllers -->
		<script src="js/controllers/productsController.js"></script>
		     <!-- Services -->
		<script src="js/services/products.js"></script>
	</body>
</html>