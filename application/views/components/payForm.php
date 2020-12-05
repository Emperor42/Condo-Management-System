<?php if($_SESSION['loggedUser']==0):?>
    <div id="newPay" class="postMain"> 
    <h3>Pay Something</h3>
    <form action="<?php echo BASEURL; ?>/main/addPayment" method="post" 
    enctype="multipart/form-data">
    TO: <input required name="to" type="text" value=""><br>
    FROM: <input required name="from" type="text" value=""><br>
    DEPOSIT ($): <input required name="pay" type="text" value=""><br>
    TOTAL: ($)<input required name="total" type="text" value=""><br>
    CLASS: <input required name="class" type="text" value=""><br>
    MEMO: <input required name="memo" type="text" value=""><br>
    <input type="reset" value="Clear Post"><br>
    <input type="submit" value="Submit"><br>
    </form> 
    </div>
<?endif;?>