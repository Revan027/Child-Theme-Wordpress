$(document).ready(function(){

      $("#video").click(function(){
       

            if( !$(".sidebar-video").is(':animated')) {
        
                  if($(".sidebar-video").attr("class") == "sidebar-video active"){
                       $('iframe').attr('src', $('iframe').attr('src'));
                  }

                       
                  $(".sidebar-video").toggle( "slow");
                  $("body").toggleClass("stop");
                  $(".sidebar-video").toggleClass("active")
            }
           
      });

      $("#sound").click(function(){
       
            if( !$(".sidebar-sound").is(':animated')) {
                  if($(".sidebar-sound").attr("class") == "sidebar-sound active"){
                      
                  }
       
                  $(".sidebar-sound").toggle( "slow");

                  $(".sidebar-sound").toggleClass("active");
            }
      })
});

