<?php //print_r($templetId); ?>
<style>
    
    /*Ra*/
.modal-backdrop {
    position: fixed;
    top: 0;
    right: 0;
    bottom: 0;
    left: 0;
    z-index: 1030;
    background-color: rgba(0, 0, 0, 0.42);
}
.card-box {
    padding: 20px;
    border: 1px solid rgba(54, 64, 74, 0.05);
    -webkit-border-radius: 5px;
    border-radius: 5px;
    -moz-border-radius: 5px;
    background-clip: padding-box;
    margin-bottom: 20px;
    background-color: #ffffff;
}
.mx-box {
    max-height: 184px;
    min-height: 180px;
    overflow-y: scroll;
}
.inbox-widget .inbox-item {
    border-bottom: 1px solid #f1f1f1;
    overflow: hidden;
    padding: 10px 0;
    position: relative;
}
.inbox-widget .inbox-item .inbox-item-author {
    display: inline-block;
    margin: 0;
    color: #000000;
    font-size: 12px;
    font-weight: 600;
    min-width: 85px;
}
.inbox-widget .inbox-item .inbox-item-text {
    color: #a0a0a0;
    display: inline-block;
    font-size: 12px;
    margin-left: 24px;
}
.chat-inputbar {
    padding-left: 30px;
    margin-top: 14px;
}
.chat-send {
    margin-top: 13px;
}
.btn-warning:hover {
  color: #fff;
  background-color: #ec971f !important;
  border-color: #d58512 !important;
}
/*Ra*/
    </style>
<div class="card-box">
    <div class="inbox-widget nicescroll mx-box">
                    <?php //$news= array();
                    if(isset($news) && !empty($news)){
                    foreach($news as $comments){ 
                        //  if($comments['CruisingMapComment']['user_type'] == "OBA" || $comments['CruisingMapComment']['user_type'] == "HOD" || $comments['CruisingMapComment']['user_type'] == "Superadmin" || $comments['CruisingMapComment']['user_type'] == "Crew Member" ){
                    	// 	$backgroundcolor = "#F2F2F2 !important;";
                    	// }else{
                    	// 	$backgroundcolor = "#E5F6FC !important;";
                    	// }
                        //if($comments['CruisingMapComment']['fleet_newlyaddedcomment'] == 1 || $comments['CruisingMapComment']['crew_newlyaddedcomment'] == 1){
                            $clickcommentdiv = "clicknewsdiv";
                            $pointer = "pointer;";
                            if($comments['CharterProgramNew']['guest_read'] == "NULL" || $comments['CharterProgramNew']['guest_read'] =='' ){
                                $clickcommentdiv = "";
                                $pointer = "default;";
                            }
                        if($comments['CharterProgramNew']['guest_read'] == 'unread'){
                            $backgroundcolor = "#e5f6fc;";
                            $selectedcommentdiv = "selectedcomment";
                        }else{
                            $backgroundcolor = "#ffffff;";
                            $selectedcommentdiv = "";
                        }
                        $id = $comments['CharterProgramNew']['id'];
                        //#E5F6FC
                        ?>
        <div class="inbox-item <?php echo $clickcommentdiv; ?> <?php echo $selectedcommentdiv; ?>" id="<?php echo $id; ?>"  style="background-color:<?php echo $backgroundcolor; ?>;cursor:<?php echo $pointer; ?>">
            <div class="col-md-12">
                <!-- <p class="inbox-item-author"><?php echo $comments['CharterProgramNew']['user_name']; ?> : <br> -->
                <?php echo date('jS F Y  h:i A', strtotime($comments['CharterProgramNew']['created'])); ?> </p>
            </div>
            <div class="col-md-12" style="padding: 0px;">

            <p class="inbox-item-text pull-left">
                <?php 
                if(isset($comments['CharterProgramNew']['comment'])){
                    $commentsCruisingMap = htmlspecialchars($comments['CharterProgramNew']['comment']);
                }
                echo nl2br($commentsCruisingMap);
                 ?></p>
            </div>
        </div>
                    <?php } }else{?>
                        <p style="color:grey;"><?php echo "There is no news at this time." ?></p>
                        <?php } ?>
    </div>
    <!-- <div class="row">
        <div class="col-sm-9 chat-inputbar">
            <textarea type="text" style="background: #eee !important;color: #000!important;border: solid 1px rgb(243 243 243 / 70%)!important;height: 94px;" id="Cruising_crew_comment" class="form-control chat-input" cols="10" rows="4" placeholder="Enter your text"></textarea>
        </div>
        <div class="col-sm-3 chat-send">
            <button id="CruisingCommentSave" style="font-size: 12px;padding: 10px 12px;" class="btn btn-md btn-info btn-block CruisingCommentSave" data-id='' data-activity_name='' data-UserType='' data-UserName="" data-type="" data-yachtid="">Send</button>
            
        </div>
    </div> -->

</div>