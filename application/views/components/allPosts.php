
<div id="wall" class="wall">
<!--Generate the posts from the messages as needed-->
<script>
function loadMessages() {
  // Declare variables
  var filter, table, tr, td, i, txtValue;//input
  //input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("messagesDataTable");
  tr = table.getElementsByTagName("tr");
  var entityTable = document.getElementById("entityDataTable");
  var etr = entityTable.getElementsByTagName("tr");

  var wallElement = document.getElementById("wall");

  // Loop through all table rows, and hide those who don't match the search query
  for (i = 0; i < tr.length; i++) {
    td = "mid:"+tr[i].getElementsByTagName("td")[0];
    var nameTo=null;
    var nameFrom=null;
    for (var ik=0;ik<etr.length;ik++){
      if(etr[ik].getElementsByTagName("td")[2]==tr[i].getElementsByTagName("td")[0]){
        nameTo = tr[i].getElementsByTagName("td")[1]+"("+tr[i].getElementsByTagName("td")[2]+" "+tr[i].getElementsByTagName("td")[3]+")";
      }
      if(etr[ik].getElementsByTagName("td")[3]==tr[i].getElementsByTagName("td")[0]){
        nameTo = tr[i].getElementsByTagName("td")[1]+"("+tr[i].getElementsByTagName("td")[2]+" "+tr[i].getElementsByTagName("td")[3]+")";
      }
      if(nameTo!=null && nameFrom!=null){
        break;//break the loop when you find both the values
      }
    }  
    //get the subject value and POST
    if(tr[i].getElementsByTagName("td")[4]=="POST"){
      //main card
      var postCard = document.createElement("div");
      postCard.setAttribute("id",td);//set the if to the one generated by mid
      postCard.setAttribute("class", "card");
      //the header on the card
      var postHeader = document.createElement("h3");
      postHeader.innerHTML = nameFrom +" -> "+nameTo;
      postCard.appendChild(postHeader);//append the to/from info to the card
      //the card text
      var postData = document.createElement("p");
      postData.innerHTML = tr[i].getElementsByTagName("td")[5];
      postCard.appendChild(postData);//append the post data to the card
      //the image if there is one
      if(tr[i].getElementsByTagName("td")[6]!=""){
        var postImage = document.createElement("img");
        postData.setAttribute("src",tr[i].getElementsByTagName("td")[6]);
        postCard.appendChild(postImage);//append the post data to the card
      }
      //this section lets me put everything into this single point when needed
      var postComments = document.createElement("details");
      postComments.setAttribute("id",td+"com");//set the if to the one generated by mid
      postComments.setAttribute("class", "card");
      var postCommentsSum = document.createElement("summary");
      postCommentsSum.innerHTML = "Comments On Post";
      postComments.appendChild(postCommentsSum);
      postCard.appendChild(postComments);//append the post data to the card
      // Create a clone of element with id ddl_1:
      var postNewComments = document.createElement("details");
      postNewComments.setAttribute("class", "card");
      var postNewCommentsSum = document.createElement("summary");
      postNewCommentsSum.innerHTML = "Comments On Post";
      postNewComments.appendChild(postNewCommentsSum);

/*
      let clone = document.getElementById("newPost").cloneNode( true );
      // Change the id attribute of the newly created element:
      clone.setAttribute( 'id', td+"posting" );
      postNewComments.appendChild(clone);

*/
<div id="newPost" class="postMain"> 
<h3>Say Something</h3>
<form action="<?php echo BASEURL; ?>/userPost/send" method="post" 
enctype="multipart/form-data">
  <input name="replyTo" id="newPostReplyTo" type="hidden" value="-1">
  <input name="msgTo" id="newPostMsgTo" type="hidden" value="-1">
  <input name="msgFrom" id="newPostMsgFrom" type="hidden" value="<?php echo $_SESSION['loggedUser'];?>">
  <input name="msgSubject" id="newPostMsgSubject" type="hidden" value="POST">
  <label for="newPostMsgText">Say Something To The Group: </label>
  <input type="text" id="newPostMsgText" name="msgText" value="">
  <label for="newPostFileToUpload">Upload a File: </label>
  <input type="file" name="msgAttach" id="newPostFileToUpload">

  <input type="reset" value="Clear Post">
  <input type="submit" value="Submit">
</form> 
</div>
      postCard.appendChild(postNewComments);
      //
      wallElement.appendChild(postCard);
    }
    //get the subject value and COMMENT
    if(tr[i].getElementsByTagName("td")[4]=="COMMENT"){
      //use replyTo to generate a temp element to bind the comment(s) to as we go along
      ttd = "mid:"+tr[i].getElementsByTagName("td")[1]+"com";
      //mainPost
      tCard = document.getElementById(ttd);
      //main card
      var postCard = document.createElement("div");
      postCard.setAttribute("id",td);//set the if to the one generated by mid
      postCard.setAttribute("class", "card");
      //the header on the card
      var postHeader = document.createElement("h3");
      postHeader.innerHTML = nameFrom +" -> "+nameTo;
      postCard.appendChild(postHeader);//append the to/from info to the card
      //the card text
      var postData = document.createElement("p");
      postData.innerHTML = tr[i].getElementsByTagName("td")[5];
      postCard.appendChild(postData);//append the post data to the card
      //the image if there is one
      if(tr[i].getElementsByTagName("td")[6]!=""){
        var postImage = document.createElement("img");
        postData.setAttribute("src",tr[i].getElementsByTagName("td")[6]);
        postCard.appendChild(postImage);//append the post data to the card
      }
      //this section lets me put everything into this single point when needed
      var postComments = document.createElement("details");
      postComments.setAttribute("id",td+"com");//set the if to the one generated by mid
      postComments.setAttribute("class", "card");
      var postCommentsSum = document.createElement("summary");
      postCommentsSum.innerHTML = "Comments On Post";
      postComments.appendChild(postCommentsSum);
      postCard.appendChild(postComments);//append the post data to the card
      // Create a clone of element with id ddl_1:
      var postNewComments = document.createElement("details");
      postNewComments.setAttribute("class", "card");
      var postNewCommentsSum = document.createElement("summary");
      postNewCommentsSum.innerHTML = "Comments On Post";
      postNewComments.appendChild(postNewCommentsSum);
      let clone = document.getElementById("newPost").cloneNode( true );
      // Change the id attribute of the newly created element:
      clone.setAttribute( 'id', td+"posting" );
      postNewComments.appendChild(clone);
      postCard.appendChild(postNewComments);
      //
      tCard.appendChild(postCard);
    }
    //USE AS REF...
    /*
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }
    */
  }
}
loadMessages();
</script>
</div>