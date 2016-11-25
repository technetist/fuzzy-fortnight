		<!-- BOOTSTRAP CORE JS ============ -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
		<script src="js/jquery-3.1.0.min.js"></script>
		<script src="node_modules/parsleyjs/dist/parsley.min.js"></script>
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

		  $(function () {
			  $('#demo-form').parsley().on('field:validated', function() {
			    var ok = $('.parsley-error').length === 0;
			    $('.bs-callout-info').toggleClass('hidden', !ok);
			    $('.bs-callout-warning').toggleClass('hidden', ok);
			  })
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