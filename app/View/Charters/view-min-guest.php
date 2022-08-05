
                                <div class="charterRow">
                                   <div class="container-row-column">
                                    <div class="row">
                                    <!-- Head charterer id -->
                                    
                                   
                                  
                                      <section class="rowm-md-mob-resize">

                                       

                                      <div class="md-row-h-12"> 
                                        <label>Title</label> 
                                            <?php echo $this->Form->input("salutation",array("id" => "headCharterSalutation", "label"=>false,'name' => 'salutation[]','options' => $salutationList,'class'=>'form-control form-two tinput rowInput validateInput','default' => $charterData['CharterGuest']['salutation'])); ?>
                                        </div>

                                         <div class="md-row-h-10"> 
                                            <label>First Name</label>  
                                            <input type="text" class="form-control tinput rowInput" name="first_name[]" value="<?php echo $charterData['CharterGuest']['first_name']; ?>" readonly="true"></div>
                                        <div class="md-row-h-10"> 
                                            <label>Last Name</label> 
                                            <input type="text" class="form-control tinput rowInput" name="last_name[]" value="<?php echo $charterData['CharterGuest']['last_name']; ?>" readonly="true" ></div>
                                    

                                              </section>
                                        
                                </div></div>                                        </div>
                            <?php 
                            $i = 2;
                            //echo "<pre>"; print_r($charterAssocData); exit;
                            foreach ($charterAssocData as $charterAssoc) { ?>  
                                <!-- Existing Guest associates -->
                                <div class="charterRow">
                                <div class="container-row-column">
                                <div class="row">
                                    
                                       
                                    
                                        <!-- <div class="td-cnt"><?php echo $i; ?></div> -->
                                        <!-- <td class="td-cnt td-check"><input class="cbox-sz isHeadCharterer" type="checkbox" name="is_head_charterer" <?php //echo ($charterAssoc['CharterGuestAssociate']['is_head_charterer']) ? "checked" : ""; ?>></td> -->
                                         <section class="rowm-md-mob-resize">
                                         <div class="md-row-h-12">
                                        <label>Title</label>
                                        
                                  
                                            <?php echo $this->Form->input("salutation",array("label"=>false,'name' => 'salutation[]','options' => $salutationList,'class'=>'form-control tinput rowInput validateInput','default' => $charterAssoc['CharterGuestAssociate']['salutation'])); ?>
                                        </div>
                                        <div class="md-row-h-10">
                                            <label>First Name</label>
                                            <input type="text" class="form-control tinput rowInput validateInput" name="first_name[]" value="<?php echo $charterAssoc['CharterGuestAssociate']['first_name']; ?>"></div>
                                        <div class="md-row-h-10">
                                          <label>Last Name</label>
                                            <input type="text" class="form-control tinput rowInput validateInput" name="last_name[]" value="<?php echo $charterAssoc['CharterGuestAssociate']['last_name']; ?>"></div>
                                  
                                          </section>
                                               
                                </div> </div> </div>
                            <?php 
                                $i++;
                            } 
                            ?>
                             
                           