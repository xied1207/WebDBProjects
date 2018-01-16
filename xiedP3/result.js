/*In this file, define two functions. One is doing query suggestions. The other
one is search for record details when mouse into a record.
*/
$(document).ready(function(){
  //define a type-in query suggestion function
  $("#searchForm").keyup(function(){
    var $toSearch=$("#inputSearch").val();
    //pass search word using get method
    $.get("keyword-suggestions.php?search="+$toSearch,function(data,status){
      $("#suggestion").html(data);
    });
  });
  //define a mouseenter search function
  $(".searchResult").mouseenter(function(){
    var $record=$(this).find(".resultTitle").text();
    //pass search word using post method
    $.post("result-details.php",{search:$record},function(data,status){
      $("#detail").html(data);
    });
  });
});
