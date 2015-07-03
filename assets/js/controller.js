$(function(){
  //drop down menu functionality
  $("ul.nav_top_list li div").hover(function(){ //When trigger is clicked...
    var parent = $(this).parent(); 
    //Following events are applied to the subnav itself (moving subnav up and down)
    parent.find("ul.subnav").slideDown('fast').show(); //Drop down the subnav on click

    parent.hover(function(){
        
      },function(){ 
        $(this).parent().find("ul.subnav").slideUp('fast'); //When the mouse hovers out of the subnav, move it back up
      }
    );
  //Following events are applied to the trigger (Hover events for the trigger)
  },function(){
    
  }).hover(function(){ //On Hover In
    $(this).addClass("subhover"); //On hover over, add class "subhover"
  },function(){ //On Hover Out
    $(this).removeClass("subhover"); //On hover out, remove class "subhover"
  });
  //UPDATE INFO
  $(".trackBox").each(function(){
    var trackBox = $(this);
    var provider = trackBox.find(".trackProvider").text();
    var trackingNumber = trackBox.find(".trackKey").text();
    var trackingID = trackBox.attr("trackID");
    var boxItem = trackBox.find(".trackInfo");
    $.ajax({
      url: "http://localhost/trakit/trakitclient.php",
      datatype: "html",
      type: "POST",
      data: {   // Data Sending With Request To Server
        provider: provider,
        tracknum: trackingNumber
      },
      success: function(data){
        boxItem.html(data);
        console.log("got reply from worker containing: "+data);
      }
    });//CLOSE Editor
    $('#trackingClose').click(function(){
      $("#editTrackingBG").fadeOut();
    });//EDIT
    trackBox.find('a.editbut').click(function(e){
      e.preventDefault();
      $("#editTrackingBG").fadeIn();
    });//DELETE
    trackBox.find('a.deletebut').click(function(e){
      e.preventDefault();
      $.post("http://localhost/trakit/tracking/removeKey/"+trackingID,function(data){
        console.log("Deleted Element" + data);
        trackBox.fadeOut(300,function(){trackBox.remove()});
      });
    });
    trackBox.find('a.refreshbut').click(function(e){
      e.preventDefault();
      boxItem.html('<img src="http://localhost/trakit/assets/img/ajax-loader.gif"/>');
      $.ajax({
        url: "http://localhost/trakit/trakitclient.php",
        datatype: "html",
        type: "POST",
        data: {   // Data Sending With Request To Server
          provider: provider,
          tracknum: trackingNumber
        },
        success: function(data){
          boxItem.html(data);
          console.log("got reply from worker containing: "+data);
        }
      });
    });
  });//EDIT SUBMIT
  $('#editTracking form').on('submit',function(e){
    e.preventDefault();
    $.ajax({
        url: "http://localhost/trakit/tracking/editKey/"+trackingID,
        datatype: "html",
        type: "POST",
        data: {   // Data Sending With Request To Server
          provider: provider,
          tracknum: trackingNumber
        },
        success: function(data){
          boxItem.html(data);
          console.log("got reply from worker containing: "+data);
        }
      });
  });
});