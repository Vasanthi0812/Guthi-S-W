<script src="js/jquery-3.5.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>

<!-- To Diable the Right Click. -->
<script> 
    $(document).ready(function()
    {
        $(document).bind("contextmenu",function(e)
        {
            return false;
        });

         // To Diable Back Button. 
         function disableBack() {window.history.forward()}
        window.onload = disableBack();
        window.onpageshow = function (evt) {if (evt.persisted) disableBack()}
        
        // To Move Page Top. 
        $("#btnTop").click(function()
        {
            //window.scrollTo({top: 0, behavior: 'smooth'});
            document.body.scrollTop = 0;
            document.documentElement.scrollTop = 0;
        });

    });
</script>