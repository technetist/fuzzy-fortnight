    </div>
    <!-- /#wrapper -->


	
	<!-- BOOTSTRAP CORE JS ============ -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
		<script src="../js/jquery-3.1.0.min.js"></script>
		<script src="../js/bootstrap.js"></script>
        
    <!-- Custom JavaScript -->
    <script src="js/scripts.js"></script>
		    <script>
    $(document).ready(function(){
        $(".delete_link").on('click', function(){
            var id = $(this).attr("rel");
            var delete_url = "products.php?delete=" + id +"";
            $(".modal_delete_link").attr("href", delete_url);
            $("#myModal").modal('show');
        });
    });
</script>

</body>

</html>