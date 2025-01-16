  <!-- Optional JavaScript -->
   <!-- jQuery first, then Popper.js, then Bootstrap JS -->
   <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
   <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
   <script type="text/javascript">
      
    if ("theme" in localStorage) 
    {   
        if(!document.body.classList.contains("dark-mode"))
        {
          document.body.classList.add("dark-mode")
        }
    }
      
    function darkModeTrigger ()
    {  
       document.body.classList.toggle("dark-mode")
      // bg-light
              
      if(document.body.classList.contains("dark-mode"))
      {
       localStorage.setItem("theme", "dark-mode") 
      }else
      {
       localStorage.removeItem("theme") 
      }
      
    }  

   </script>
  </body>
</html>