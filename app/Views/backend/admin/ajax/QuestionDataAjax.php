<!-- <div class="card-body1 sectorID-<?=$questionDetail['Sector_ID']?> QuestionCard Question_id_<?=trim($questionDetail['QB_ID'])?>" >
    <div class="d-flex">
        <div class="card-icon2">
            <div class="down-top-er1"> <a href="javascript:void(0);"> <i class="bi bi-chevron-down"></i> </a> </div> 
            <div class="down-top-er1"> <input class="form-check-input flexCheckDefaultClass" type="checkbox" value="<?=trim($questionDetail['QB_ID'])
        ?>" > </div>
            <div class="down-top-er1"> <a href="javascript:void(0);"> <i class="bi bi-chevron-up"></i> </a> </div>
        </div>
        <div class="total-nu1 ps-3 col-lg-10">
            <span> <span class="updateSequence">1</span>. <?=$questionDetail['Description']?></span> 
            <div class="value1">
              <input type="password" disabled class="form-control" placeholder="" id="inputPassword">
            </div>                     
        </div>
        <div class="remove">
            <div class="rem" id="removeSigleQuestion" data-qid="<?=trim($questionDetail['QB_ID'])
        ?>"> <a href=""> <i class="bi bi-trash"></i> Remove </a> </div>                   
        </div>                   
    </div>
</div> -->



<div class="accordion-item card-body1 pad-3 sectorID-<?=$questionDetail['Sector_ID']?> toBeRemovedCheck QuestionCard Question_id_<?=trim($questionDetail['QB_ID'])?>">
                    <h2 class="accordion-header d-flex align-items-center">

                        <div class="card-icon2">
                        <div class="down-top-er1"> 
                          <input class="form-check-input flexCheckDefaultClass" type="checkbox" value="<?=trim($questionDetail['QB_ID'])?>" >
                        </div>
                      </div>


                      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse<?=trim($questionDetail['QB_ID'])?>" aria-expanded="false" aria-controls="flush-collapse<?=trim($questionDetail['QB_ID'])?>">
                        <span class="updateSequence"></span>.&nbsp;&nbsp;<span class="w-80"><?=$questionDetail['Description']?></span>   &nbsp;
                        
                      </button>


                      <div class="rem-2 d-flex ms-2" style="width: 15%;" id="removeSigleQuestion" data-qid="<?=trim($questionDetail['QB_ID'])
                            ?>"><a href=""> <i class="bi bi-trash"></i> Remove </a> </div>


                    </h2>
                    <div id="flush-collapse<?=trim($questionDetail['QB_ID'])?>" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                        <div class="accordion-body">
                          <div class="d-flex">
                            
                        <div class="questionUOMtypeDataAdminSide">
                            <?php
                            $uomDetail=getQuestionUnitOfMeasurement(trim($questionDetail['UOM_ID']));
                             if(trim($questionDetail['UOM_ID'])==1){ //Number ?>
                                <div class="total-nu1 ps-3 col-lg-10">
                                
                                <div class="value1"><input value="" oncopy="return false" onpaste="return false" qb-id="<?php echo $questionDetail["QB_ID"] ?>" type="text" class="form-control numberOnly textBoxInput" placeholder="<?php echo $questionDetail["question_placeholder"]; ?>">&nbsp;&nbsp;<?php echo ucfirst($uomDetail["UOM"]); ?></div>
                                <span class="error_msg err" style="color: red;"></span> 
                                </div>
                                <?php } else if(trim($questionDetail['UOM_ID'])==2){ //Number In Cr ?>
                                <div class="total-nu1 ps-3 col-lg-10">
                                
                                <div class="value1"><input value="" qb-id="<?php echo $questionDetail["QB_ID"] ?>" oncopy="return false" onpaste="return false" type="text" class="form-control numberOnly textBoxInput" placeholder="<?php echo $questionDetail["question_placeholder"]; ?>">&nbsp;&nbsp;<?php echo ucfirst($uomDetail["UOM"]); ?></div>
                                <span class="error_msg err" style="color: red;"></span> 
                                </div>
                                <?php } else if(trim($questionDetail['UOM_ID'])==3){ //Number In Rupees  ?>
                                <div class="total-nu1 ps-3 col-lg-10">
                                
                                <div class="value1"><input value="" qb-id="<?php echo $questionDetail["QB_ID"] ?>" oncopy="return false" onpaste="return false" type="text" class="form-control numberOnly textBoxInput" placeholder="<?php echo $questionDetail["question_placeholder"]; ?>">&nbsp;&nbsp;<?php echo ucfirst($uomDetail["UOM"]); ?></div>
                                <span class="error_msg err" style="color: red;"></span> 
                                </div> 
                                <?php } else if(trim($questionDetail['UOM_ID'])==4){ //Percentage  ?>
                                <div class="total-nu1 ps-3 col-lg-10">
                                
                                <div class="value1"><input value="" qb-id="<?php echo $questionDetail["QB_ID"] ?>" oncopy="return false" onpaste="return false" type="text" class="form-control numberOnly textBoxInput" placeholder="<?php echo $questionDetail["question_placeholder"]; ?>">&nbsp;&nbsp;<?php echo ucfirst($uomDetail["UOM"]); ?></div>
                                <span class="error_msg err" style="color: red;"></span> 
                                </div> 
                                <?php } else if(trim($questionDetail['UOM_ID'])==5){ //Mega Watt Hr  ?>
                                <div class="total-nu1 ps-3 col-lg-10">
                                
                                <div class="value1"><input value="" qb-id="<?php echo $questionDetail["QB_ID"] ?>" oncopy="return false" onpaste="return false" type="text" class="form-control textBoxInput" placeholder="<?php echo $questionDetail["question_placeholder"]; ?>">&nbsp;&nbsp;<?php echo ucfirst($uomDetail["UOM"]); ?></div>
                                <span class="error_msg err" style="color: red;"></span> 
                                </div> 
                                <?php } else if(trim($questionDetail['UOM_ID'])==6){ //SQ Km  ?>
                                <div class="total-nu1 ps-3 col-lg-10">
                                
                                <div class="value1"><input value="" qb-id="<?php echo $questionDetail["QB_ID"] ?>" oncopy="return false" onpaste="return false" type="text" class="form-control textBoxInput" placeholder="<?php echo $questionDetail["question_placeholder"]; ?>">&nbsp;&nbsp;<?php echo ucfirst($uomDetail["UOM"]); ?></div>
                                <span class="error_msg err" style="color: red;"></span> 
                                </div> 
                                <?php } else if(trim($questionDetail['UOM_ID'])==7){ //Micro gm/cu.m ?>
                                <div class="total-nu1 ps-3 col-lg-10">
                                
                                <div class="value1"><input value="" qb-id="<?php echo $questionDetail["QB_ID"] ?>" oncopy="return false" onpaste="return false" type="text" class="form-control textBoxInput" placeholder="<?php echo $questionDetail["question_placeholder"]; ?>">&nbsp;&nbsp;<?php echo ucfirst($uomDetail["UOM"]); ?></div>
                                <span class="error_msg err" style="color: red;"></span> 
                                </div> 
                                <?php } else if(trim($questionDetail['UOM_ID'])==8){ //Select One Option ?>
                                <div class="total-nu1 ps-3 col-lg-10">
                                
                                <div class="value1">
                                <?php
                                $options=getQuestionAllOptions($questionDetail["QB_ID"]);
                                if(!empty($options)){
                                foreach($options as $option_detail){
                                ?>
                                <div class="form-check-inline col-12">
                                <label class="customradio">
                                <span class="radiotextsty"><?php echo ucfirst($option_detail["options"]); ?></span>
                                <input  qb-id="<?php echo $questionDetail["QB_ID"] ?>" class="radioInput" type="radio" name="radio_option_<?php echo $questionDetail["QB_ID"] ?>" value="<?php echo trim($option_detail["options"]); ?>" />
                                <span class="checkmark"></span>
                                </label>
                                </div>
                                <?php }}else{ ?>
                                <div class="form-check-inline col-12">
                                <label class="customradio">
                                <span class="radiotextsty">Yes</span>
                                <input  qb-id="<?php echo $questionDetail["QB_ID"] ?>" class="radioInput" type="radio" name="radio_option_<?php echo $questionDetail["QB_ID"] ?>" value="Yes" />
                                <span class="checkmark"></span>
                                </label>

                                <label class="customradio">
                                <span class="radiotextsty">No</span>
                                <input qb-id="<?php echo $questionDetail["QB_ID"] ?>" class="radioInput" type="radio" name="radio_option_<?php echo $questionDetail["QB_ID"] ?>" value="No" />
                                <span class="checkmark"></span>
                                </label>
                                </div>
                                <?php } ?>
                                </div>
                                </div>
                                <?php } else if(trim($questionDetail['UOM_ID'])==9){ //Km ?>
                                <div class="total-nu1 ps-3 col-lg-10">
                                
                                <div class="value1"><input value="" qb-id="<?php echo $questionDetail["QB_ID"] ?>" oncopy="return false" onpaste="return false" type="text" class="form-control textBoxInput" placeholder="<?php echo $questionDetail["question_placeholder"]; ?>">&nbsp;&nbsp;<?php echo ucfirst($uomDetail["UOM"]); ?></div>
                                <span class="error_msg err" style="color: red;"></span> 
                                </div> 
                                <?php } else if(trim($questionDetail['UOM_ID'])==10){ //Ipcd ?>
                                <div class="total-nu1 ps-3 col-lg-10">
                                
                                <div class="value1"><input value="" qb-id="<?php echo $questionDetail["QB_ID"] ?>" oncopy="return false" onpaste="return false" type="text" class="form-control textBoxInput" placeholder="<?php echo $questionDetail["question_placeholder"]; ?>">&nbsp;&nbsp;<?php echo ucfirst($uomDetail["UOM"]); ?></div>
                                <span class="error_msg err" style="color: red;"></span> 
                                </div>
                                <?php } else if(trim($questionDetail['UOM_ID'])==11){ //MLD ?>
                                <div class="total-nu1 ps-3 col-lg-10">
                                
                                <div class="value1"><input value="" qb-id="<?php echo $questionDetail["QB_ID"] ?>" oncopy="return false" onpaste="return false" type="text" class="form-control textBoxInput" placeholder="<?php echo $questionDetail["question_placeholder"]; ?>">&nbsp;&nbsp;<?php echo ucfirst($uomDetail["UOM"]); ?></div>
                                <span class="error_msg err" style="color: red;"></span> 
                                </div>
                                <?php } else if(trim($questionDetail['UOM_ID'])==12){ //Number(Score & Rating) ?>
                                <div class="total-nu1 ps-3 col-lg-10">
                                
                                <div class="value1"><input value="" qb-id="<?php echo $questionDetail["QB_ID"] ?>" oncopy="return false" onpaste="return false" type="text" class="form-control textBoxInput" placeholder="<?php echo $questionDetail["question_placeholder"]; ?>">&nbsp;&nbsp;<?php echo ucfirst($uomDetail["UOM"]); ?></div>
                                <span class="error_msg err" style="color: red;"></span> 
                                </div>
                                <?php } else if(trim($questionDetail['UOM_ID'])==13){ //Number(In Year) ?>
                                <div class="total-nu1 ps-3 col-lg-10">
                                
                                <div class="value1"><input value="" qb-id="<?php echo $questionDetail["QB_ID"] ?>" oncopy="return false" onpaste="return false" type="text" class="form-control numberOnly textBoxInput" placeholder="<?php echo $questionDetail["question_placeholder"]; ?>">&nbsp;&nbsp;<?php echo ucfirst($uomDetail["UOM"]); ?></div>
                                <span class="error_msg err" style="color: red;"></span> 
                                </div>
                                <?php } else if(trim($questionDetail['UOM_ID'])==14){ //Detail ?>
                                <div class="total-nu1 ps-3 col-lg-10">
                                
                                <div class="value1"><textarea qb-id="<?php echo $questionDetail["QB_ID"] ?>" rows="3" cols="50" class="form-control textBoxInput"></textarea>&nbsp;&nbsp;<?php echo ucfirst($uomDetail["UOM"]); ?></div>
                                <span class="error_msg err" style="color: red;"></span> 
                                </div>
                                <?php } else if(trim($questionDetail['UOM_ID'])==15){ //Number(In Days) ?>
                                <div class="total-nu1 ps-3 col-lg-10">
                                
                                <div class="value1"><input value="" qb-id="<?php echo $questionDetail["QB_ID"] ?>" oncopy="return false" onpaste="return false" type="text" class="form-control numberOnly textBoxInput" placeholder="<?php echo $questionDetail["question_placeholder"]; ?>">&nbsp;&nbsp;<?php echo ucfirst($uomDetail["UOM"]); ?></div>
                                <span class="error_msg err" style="color: red;"></span> 
                                </div>
                                <?php } else if(trim($questionDetail['UOM_ID'])==16){ //Number(In Meters) ?>
                                <div class="total-nu1 ps-3 col-lg-10">
                                
                                <div class="value1"><input value="" qb-id="<?php echo $questionDetail["QB_ID"] ?>" oncopy="return false" onpaste="return false" type="text" class="form-control numberOnly textBoxInput" placeholder="<?php echo $questionDetail["question_placeholder"]; ?>">&nbsp;&nbsp;<?php echo ucfirst($uomDetail["UOM"]); ?></div>
                                <span class="error_msg err" style="color: red;"></span> 
                                </div>
                                <?php } else if(trim($questionDetail['UOM_ID'])==17){ //Text ?>
                                <div class="total-nu1 ps-3 col-lg-10">
                                
                                <div class="value1"><input value="" qb-id="<?php echo $questionDetail["QB_ID"] ?>" type="text" class="form-control textBoxInput" placeholder="<?php echo $questionDetail["question_placeholder"]; ?>">&nbsp;&nbsp;<?php echo ucfirst($uomDetail["UOM"]); ?></div>
                                <span class="error_msg err" style="color: red;"></span> 
                                </div>
                                <?php } else if(trim($questionDetail['UOM_ID'])==18){ //kW ?>
                                <div class="total-nu1 ps-3 col-lg-10">
                                
                                <div class="value1"><input value="" qb-id="<?php echo $questionDetail["QB_ID"] ?>" oncopy="return false" onpaste="return false" type="text" class="form-control textBoxInput" placeholder="<?php echo $questionDetail["question_placeholder"]; ?>">&nbsp;&nbsp;<?php echo ucfirst($uomDetail["UOM"]); ?></div>
                                <span class="error_msg err" style="color: red;"></span> 
                                </div>
                                <?php } else if(trim($questionDetail['UOM_ID'])==19){ //kWh ?>
                                <div class="total-nu1 ps-3 col-lg-10">
                                
                                <div class="value1"><input value="" qb-id="<?php echo $questionDetail["QB_ID"] ?>" oncopy="return false" onpaste="return false" type="text" class="form-control textBoxInput" placeholder="<?php echo $questionDetail["question_placeholder"]; ?>">&nbsp;&nbsp;<?php echo ucfirst($uomDetail["UOM"]); ?></div>
                                <span class="error_msg err" style="color: red;"></span> 
                                </div>
                                <?php } else if(trim($questionDetail['UOM_ID'])==20){ //kl ?>
                                <div class="total-nu1 ps-3 col-lg-10">
                                
                                <div class="value1"><input value="" qb-id="<?php echo $questionDetail["QB_ID"] ?>" oncopy="return false" onpaste="return false" type="text" class="form-control textBoxInput" placeholder="<?php echo $questionDetail["question_placeholder"]; ?>">&nbsp;&nbsp;<?php echo ucfirst($uomDetail["UOM"]); ?></div>
                                <span class="error_msg err" style="color: red;"></span> 
                                </div>
                                <?php } else if(trim($questionDetail['UOM_ID'])==21){ //Sq.m ?>
                                <div class="total-nu1 ps-3 col-lg-10">
                                
                                <div class="value1"><input value="" qb-id="<?php echo $questionDetail["QB_ID"] ?>" oncopy="return false" onpaste="return false" type="text" class="form-control textBoxInput" placeholder="<?php echo $questionDetail["question_placeholder"]; ?>">&nbsp;&nbsp;<?php echo ucfirst($uomDetail["UOM"]); ?></div>
                                <span class="error_msg err" style="color: red;"></span> 
                                </div>
                                <?php } else if(trim($questionDetail['UOM_ID'])==22){ //Ratio ?>
                                <div class="total-nu1 ps-3 col-lg-10">
                                
                                <div class="value1"><input value="" qb-id="<?php echo $questionDetail["QB_ID"] ?>" oncopy="return false" onpaste="return false" type="text" class="form-control textBoxInput" placeholder="<?php echo $questionDetail["question_placeholder"]; ?>">&nbsp;&nbsp;<?php echo ucfirst($uomDetail["UOM"]); ?></div>
                                <span class="error_msg err" style="color: red;"></span> 
                                </div>
                                <?php } else if(trim($questionDetail['UOM_ID'])==23){ //Persons Per Sq KM ?>
                                <div class="total-nu1 ps-3 col-lg-10">
                                
                                <div class="value1"><input value="" qb-id="<?php echo $questionDetail["QB_ID"] ?>" oncopy="return false" onpaste="return false" type="text" class="form-control textBoxInput" placeholder="<?php echo $questionDetail["question_placeholder"]; ?>">&nbsp;&nbsp;<?php echo ucfirst($uomDetail["UOM"]); ?></div>
                                <span class="error_msg err" style="color: red;"></span> 
                                </div>
                                <?php } else if(trim($questionDetail['UOM_ID'])==24){ //Public Transport Unit (PTU) per 1000 people ?>
                                <div class="total-nu1 ps-3 col-lg-10">
                                
                                <div class="value1"><input value="" qb-id="<?php echo $questionDetail["QB_ID"] ?>" oncopy="return false" onpaste="return false" type="text" class="form-control textBoxInput" placeholder="<?php echo $questionDetail["question_placeholder"]; ?>">&nbsp;&nbsp;<?php echo ucfirst($uomDetail["UOM"]); ?></div>
                                <span class="error_msg err" style="color: red;"></span> 
                                </div>
                                <?php } else if(trim($questionDetail['UOM_ID'])==25){ //Select Multiple ?>
                                <div class="total-nu1 ps-3 col-lg-10">
                                
                                <div class="checkbox">
                                <?php
                                $options=getQuestionAllOptions($questionDetail["QB_ID"]);
                                if(!empty($options)){
                                foreach($options as $option_detail){
                                ?>
                                <div class="form-check-inline col-12">
                                <input  value="<?php echo trim($option_detail["options"]); ?>" qb-id="<?php echo $questionDetail["QB_ID"] ?>" class="form-check-input multiSelect" type="checkbox" name="checkbox_options_<?php echo $questionDetail["QB_ID"] ?>">&nbsp;&nbsp;<?php echo ucfirst($option_detail["options"]); ?>
                                <span class="error_msg err" style="color: red;"></span>
                                </div>
                                <?php }} ?>
                                </div>
                                </div>
                                <?php } else if(trim($questionDetail['UOM_ID'])==27){ //Rating ?>
                                <div class="total-nu11 ps-3 col-lg-10">
                                
                                <div class="mt-2">
                                <span class="rat-star1"><i qb-id="<?php echo $questionDetail["QB_ID"] ?>" data-value="1" style="cursor: pointer;" data-starIndex="1" class="ratingUOM bi bi-star "></i></span> 
                                <span class="rat-star1"><i qb-id="<?php echo $questionDetail["QB_ID"] ?>" data-value="2" style="cursor: pointer;" data-starIndex="2" class="ratingUOM bi bi-star "></i></span> 
                                <span class="rat-star1"><i qb-id="<?php echo $questionDetail["QB_ID"] ?>" data-value="3" style="cursor: pointer;" data-starIndex="3" class="ratingUOM bi bi-star "></i></span> 
                                <span class="rat-star1"><i qb-id="<?php echo $questionDetail["QB_ID"] ?>" data-value="4" style="cursor: pointer;" data-starIndex="4" class="ratingUOM bi bi-star "></i></span>
                                <span class="rat-star1"><i qb-id="<?php echo $questionDetail["QB_ID"] ?>" data-value="5" style="cursor: pointer;" data-starIndex="5" class="ratingUOM bi bi-star "></i></span>

                                </div>
                                <span class="error_msg err" style="color: red;"></span> 
                                </div>
                                <?php } else if(trim($questionDetail['UOM_ID'])==28){ //Audio
                                $audio_ext=getQuestionAllOptions($questionDetail["QB_ID"]);
                                ?>
                                <div class="total-nu1 ps-3 col-lg-10">
                                
                                <div class="value"><input qb-id="<?php echo $questionDetail["QB_ID"] ?>" type="file" class="form-control fileInput"><a href="" download><i title="Download File" class="fa fa-download mt-2"></i></a></div>
                                <span class="audio_note question_note" style=""><b>Note :</b> Allowed extensions : <?php echo $audio_ext[0]["file_extension"]; ?></span>
                                <span class="error_msg err" style="color: red;"></span> 
                                </div>
                                <?php } else if(trim($questionDetail['UOM_ID'])==29){ //Video
                                $video_ext=getQuestionAllOptions($questionDetail["QB_ID"]);
                                ?>
                                <div class="total-nu1 ps-3 col-lg-10">
                                
                                <div class="value"><input qb-id="<?php echo $questionDetail["QB_ID"] ?>" type="file" class="form-control fileInput"><a href="" download><i title="Download File" class="fa fa-download mt-2"></i></a></div>
                                <span class="video_note question_note" style=""><b>Note :</b> Allowed extensions : : <?php echo $video_ext[0]["file_extension"]; ?></span>
                                <span class="error_msg err" style="color: red;"></span> 
                                </div>
                                <?php } else if(trim($questionDetail['UOM_ID'])==30){ //File
                                $file_ext=getQuestionAllOptions($questionDetail["QB_ID"]);

                                ?>
                                <div class="total-nu1 ps-3 col-lg-10">
                                
                                <div class="value"><input qb-id="<?php echo $questionDetail["QB_ID"] ?>" type="file" class="form-control fileInput"><a href="" download><i title="Download File" class="fa fa-download mt-2"></i></a></div>
                                <span class="file_note question_note" style=""><b>Note :</b> Allowed extensions : <?php echo $file_ext[0]["file_extension"]; ?></span>
                                <span class="error_msg err" style="color: red;"></span> 
                                </div>
                                <?php } else if(trim($questionDetail['UOM_ID'])==31){ //Date With Range ?>
                                <div class="total-nu1 ps-3 col-lg-10">
                                
                                <div class="value"><input value="" qb-id="<?php echo $questionDetail["QB_ID"] ?>" oncopy="return false" onpaste="return false" type="text" class="form-control dateRange textBoxInput" placeholder="Select date range"></div>
                                <span class="error_msg err" style="color: red;"></span> 
                                </div>
                                <?php } else if(trim($questionDetail['UOM_ID'])==32){ //Date With Time ?>
                                <div class="total-nu1 ps-3 col-lg-10">
                                
                                <div class="value"><input value="" qb-id="<?php echo $questionDetail["QB_ID"] ?>" oncopy="return false" onpaste="return false" type="datetime-local" class="form-control dateWithTime textBoxInput"></div>
                                <span class="error_msg err" style="color: red;"></span> 
                                </div>
                                <?php } else if(trim($questionDetail['UOM_ID'])==33){ //Date ?>
                                <div class="total-nu1 ps-3 col-lg-10">
                                
                                <div class="value"><input value="" qb-id="<?php echo $questionDetail["QB_ID"] ?>" oncopy="return false" onpaste="return false" readonly type="text" class="form-control dateinput textBoxInput" placeholder="Select date"></div>
                                <span class="error_msg err" style="color: red;"></span> 
                                </div>
                                <?php } else if(trim($questionDetail['UOM_ID'])==34){ //E-mail ?>
                                <div class="total-nu1 ps-3 col-lg-10">
                                
                                <div class="value1"><input value="" oncopy="return false" onpaste="return false" qb-id="<?php echo $questionDetail["QB_ID"] ?>" type="Email" class="form-control textBoxInput" placeholder="Enter e-mail">&nbsp;&nbsp;<?php echo ucfirst($uomDetail["UOM"]); ?></div>
                                <span class="error_msg err" style="color: red;"></span> 
                                </div>
                                <?php } else if(trim($questionDetail['UOM_ID'])==35){ //Range
                                $range_options=getQuestionAllOptions($questionDetail["QB_ID"]);
                                ?>
                                <div class="total-nu1 ps-3 col-lg-10">
                                
                                <main class="cd__main">
                                <div class="range">
                                  <div class="sliderValue">
                                    <span class="rangeSelectedValue">0</span>
                                  </div>
                                  <div class="field">
                                    <div class="value left"><?php echo isset($range_options[0]["range_min_value"])?trim($range_options[0]["range_min_value"]):""; ?></div>
                                      <div class="value" style="width:100%" >
                                        <input qb-id="<?php echo $questionDetail["QB_ID"] ?>" class="rangeInput" type="range" min="<?php echo isset($range_options[0]["range_min_value"])?trim($range_options[0]["range_min_value"]):""; ?>" max="<?php echo isset($range_options[0]["range_max_value"])?trim($range_options[0]["range_max_value"]):""; ?>" value="" steps="1">
                                        <span class="selectedValue"></span>
                                      </div>
                                    <div class="value right"><?php echo isset($range_options[0]["range_max_value"])?trim($range_options[0]["range_max_value"]):""; ?></div>
                                  </div>
                                </div>
                                </main>
                                <span class="error_msg err" style="color: red;"></span> 
                                </div>
                                <?php } else if(trim($questionDetail['UOM_ID'])==36){ //Select Multiple Priority ?>
                                <div class="total-nu1 ps-3 col-lg-10">
                                
                                <div class="checkbox">
                                <?php
                                $options=getQuestionAllOptions($questionDetail["QB_ID"]);
                                if(!empty($options)){
                                foreach($options as $option_detail){
                                ?>
                                <div class="form-check-inline col-12">
                                <input value="<?php echo trim($option_detail["options"]); ?>" qb-id="<?php echo $questionDetail["QB_ID"] ?>" class="form-check-input multiSelect" type="checkbox" name="checkbox_options_<?php echo $questionDetail["QB_ID"] ?>">&nbsp;&nbsp;<?php echo ucfirst($option_detail["options"]); ?>
                                <span class="error_msg err" style="color: red;"></span>
                                </div>
                                <?php }} ?>
                                </div>
                                </div>
                                <?php }elseif(trim($questionDetail['UOM_ID'])==42){ //Parent Child Conditional ?>
<div class="total-nu1 ps-2">
<div class="value1 ParentChildConditionalCls">
<div class="yes_no">
<?php
$options=getQuestionAllOptions($questionDetail["QB_ID"]);
if(!empty($options)){
foreach($options as $option_detail){
?>
<div class="form-check-inline ">
<label class="customradio">
<span class="radiotextsty"><?php echo ucfirst($option_detail["options"]); ?></span>
<input qb-id="<?php echo $questionDetail["QB_ID"] ?>" class="ChildQuestionListDataShow radioInput" type="radio" name="radio_option_<?php echo $questionDetail["QB_ID"] ?>" id="radio_option_<?php echo $questionDetail["QB_ID"] ?>" value="<?php echo trim($option_detail["options"]); ?>" />
<span class="checkmark"></span>
</label>
</div>
<?php } ?>
</div> 
<?php
if($questionDetail['child_questions']!=''){
  $childQuestionsArray = json_decode($questionDetail['child_questions']);
}else{
  $childQuestionsArray = [];
}

if(!empty($childQuestionsArray)){
foreach($childQuestionsArray as $keyOption=>$childQuestion){
?>
<div class="ps-2" id="ParentQuestionOptionData_<?=$questionDetail['QB_ID']?>_<?=preg_replace('/[^a-zA-Z0-9_\[\]\\\-]/s', '',$keyOption)?>" style="display: none;">
<?php if(!empty($childQuestion)){
$child_i=1;
foreach($childQuestion as $qkey =>$child){
$childDetail = getQuestionDetail($child);
$childchildDetail = getQuestionUnitOfMeasurement($childDetail['UOM_ID']);
?>
<div class="show_childQuestion">
<span class="questiontitle"><?php echo $childDetail["Description"]; ?></span>
<div class="value1" style="pointer-events:none;">
<?php if($childchildDetail["UOM_ID"]==17){ //For Short text ?>
<input oncopy="return false" onpaste="return false" value="" style="width: 118px" type="text" class="form-control validtext_niua childTextBoxInput" placeholder="<?php echo $childDetail["question_placeholder"]; ?>">
<?php } if($childchildDetail["UOM_ID"]==1){ //For Integer ?>
<input oncopy="return false" onpaste="return false" value="" style="width: 118px" type="text" class="form-control numberOnly childTextBoxInput" placeholder="<?php echo $childDetail["question_placeholder"]; ?>">
<?php } if($childchildDetail["UOM_ID"]==8){ //For Select One Option
$parent_child_options=getQuestionAllOptions($childDetail["QB_ID"]);
if(!empty($parent_child_options)){
foreach($parent_child_options as $get_parent_child_option_detail){
?>
<div class="conditional_option_section">
<input style="cursor: pointer;" class="childTextBoxInput" type="radio" name="radio_option_<?php echo $childDetail["QB_ID"].$questionDetail["QB_ID"]; ?>" value="<?php echo trim($get_parent_child_option_detail["options"]); ?>" />
<span class="radiotextsty"><?php echo ucfirst($get_parent_child_option_detail["options"]); ?></span>
</div>
<?php }}} ?>
</div>
<span class="error_msg err" style="color: red;"></span>
</div>
<?php $child_i++;}} ?>
</div>
<?php }} ?>
</div>
<?php } ?>
</div>
                                <?php }elseif(trim($questionDetail['UOM_ID'])==43){ //Parent Child ?>
<div class="total-nu1 ps-2">
<div class="value1">
<?php
if($questionDetail['sub_question']!=''){
  $childQuestionsArray = json_decode($questionDetail['sub_question']);
}else{
  $childQuestionsArray = [];
}
if(!empty($childQuestionsArray)){
foreach($childQuestionsArray as $keyOption=>$childQuestion){

?>
<div class="ps-2" >
<?php if(!empty($childQuestion)){
$childDetail = getQuestionDetail($childQuestion);
$childchildDetail = getQuestionUnitOfMeasurement($childDetail['UOM_ID']);
?>
<div class="show_childQuestion">
<span class="questiontitle"><?php echo $childDetail["Description"]; ?></span>
<div class="value1" style="pointer-events:none;">
<?php if($childchildDetail["UOM_ID"]==17){ //For Short text ?>
<input oncopy="return false" onpaste="return false" value="" style="width: 118px" type="text" class="form-control validtext_niua childTextBoxInput" placeholder="<?php echo $childDetail["question_placeholder"]; ?>">
<?php } if($childchildDetail["UOM_ID"]==1){ //For Integer ?>
<input oncopy="return false" onpaste="return false" value="" style="width: 118px" type="text" class="form-control numberOnly childTextBoxInput" placeholder="<?php echo $childDetail["question_placeholder"]; ?>">
<?php } if($childchildDetail["UOM_ID"]==8){ //For Select One Option
$parent_child_options=getQuestionAllOptions($childDetail["QB_ID"]);
if(!empty($parent_child_options)){
foreach($parent_child_options as $get_parent_child_option_detail){
?>
<div class="conditional_option_section">
<input style="cursor: pointer;" class="childTextBoxInput" type="radio" name="radio_option_<?php echo $childDetail["QB_ID"].$questionDetail["QB_ID"]; ?>" value="<?php echo trim($get_parent_child_option_detail["options"]); ?>" />
<span class="radiotextsty"><?php echo ucfirst($get_parent_child_option_detail["options"]); ?></span>
</div>
<?php }}} ?>
</div>
<span class="error_msg err" style="color: red;"></span>
</div>
<?php } ?>
</div>
<?php }} ?>
</div>
</div>
<?php }elseif(trim($questionDetail['UOM_ID'])==41){$q_matrix=base_url('assets/uploads/').$questionDetail["question_matrix_barcode"]; //Question Matrix ?>
<div class="total-nu1 ps-2">
<div class="value"><a href="<?php echo $q_matrix; ?>" download><i title="Download File" class="bi bi-download mt-2"></i></a></div>
</div>
<?php }elseif(trim($questionDetail['UOM_ID'])==39){$barcode=base_url('assets/uploads/').$questionDetail["question_matrix_barcode"]; //Barcode ?>
<div class="total-nu1 ps-2">
<div class="value"><a href="<?php echo $barcode; ?>" download><i title="Download File" class="bi bi-download mt-2"></i></a></div>
</div>
<?php }elseif(trim($questionDetail['UOM_ID'])==40){ //Acknowledgement ?>
<div class="total-nu1 ps-2">
<div class="value1 acknowledgement_checkbox_sec"><input  class="acknowledgement_checkbox" type="checkbox">&nbsp;&nbsp;<input readonly oncopy="return false" onpaste="return false" type="text" class="form-control acknowledgement_input" placeholder=""></div>
</div> 
<?php }elseif(trim($questionDetail['UOM_ID'])==37){ //Time
$get_hour=1;
$get_second=0;
$get_ampm="";
?>
<div class="total-nu1 ps-2">
<div class="inputTimeSection">
<select class="form-control timeInput Timehour">
  <?php for($hour=1; $hour<=12; $hour++){ ?>
  <option value="<?php echo $hour; ?>"><?php echo $hour; ?></option>
 <?php } ?>
</select>

<select class="form-control timeInput Timesecond">
  <?php for($sec=0; $sec<=59; $sec++){ ?>
  <option value="<?php echo $sec; ?>"><?php echo $sec; ?></option>
 <?php } ?>
</select>

<select style="width:auto;" class="form-control am_pm_selection timeInput">
  <option value="">Select AM/PM</option>
  <option value="AM">AM</option>
  <option value="PM">PM</option>
</select>

</div>
</div>
<?php }else if(trim($questionDetail['UOM_ID'])==38){ //Decimal/Float ?>
<div class="total-nu1 ps-2">
<div class="value1"><input readonly oncopy="return false" onpaste="return false" type="text" class="form-control valid_decimal_niua textBoxInput" placeholder=""></div>
</div>
<?php }else if(trim($questionDetail['UOM_ID'])==44){ //Calculated Question
  if(!empty($getCityAnswer)){
    $calculatedFirstValue=trim($getCityAnswer["calculation_value1"]);
    $calculatedSecondValue=trim($getCityAnswer["calculation_value2"]);
  }else{
    $calculatedFirstValue="";
    $calculatedSecondValue="";
  }
?>
<div class="total-nu1 ps-2">
<div class="value1 calculatedQuestionSection" style="pointer-events:none;">
<?php
if($questionDetail['sub_question']!=''){
  $childQuestionsArray=json_decode($questionDetail['sub_question']);
}else{
  $childQuestionsArray=[];
}
if(!empty($childQuestionsArray)){
foreach($childQuestionsArray as $keyOption=>$childQuestion){
if(!empty($childQuestion)){
$childDetail=getQuestionDetail($childQuestion);
?>
<div>
<span class="questiontitle"> <?php echo $childDetail["Description"]; ?>&nbsp;&nbsp;<button type="button" class="btn" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" style="pointer-events: all;" onclick="questionDetail('<?php echo trim($childDetail["QB_ID"]); ?>')"><i class="bi bi-info-circle-fill"></i></button></span>
<div class="value1"><input readonly value="<?php if(($keyOption+1)==1){echo $calculatedFirstValue;}else{ echo $calculatedSecondValue;} ?>" style="width: 118px" type="text" class="numberOnly form-control calculatedQuestionTextBoxInput calculatedQuestionInput_<?=$keyOption+1?>" oncopy="return false" onpaste="return false" placeholder="<?php echo $childDetail["question_placeholder"]; ?>" data-calculation_action="<?php echo $questionDetail["calculation_type"]; ?>"></div>
<span class="error_msg err" style="color: red;"></span>
</div>
<?php }}} ?>

</div>
</div>
<?php } ?>
                        </div>
                            
                           
                            
                          </div>        
                        </div>
                      </div>
                    </div>