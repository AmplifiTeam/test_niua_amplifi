<?php if(!empty($surveyDetails)){ 
    foreach($surveyDetails as $sKey=>$surevyDetails){ ?>
      <tr>
        <td class="tb-wid4"><?=$surevyDetails['Survey_Name']?></td>
        <td class="tb-wid3"><?=$surevyDetails['City']?></td>
        <td class="tb-wid3"><?=date('d-m-Y H:i',strtotime($surevyDetails['submission_date']))?></td>
        <td class="tb-wid3"><?=count($surevyDetails['sectorList'])?></td>
        <td class="tb-wid8"> 
          <?php if(count($surevyDetails['sectorList']) > 0){
            foreach($surevyDetails['sectorList'] as $sctrKey =>$sector){?>
                <a class="<?= (isJobsCreated($surevyDetails['Survey_ID'],$sector['Sector_ID'],$surevyDetails['City_ID']))?'alreadyAssignedJob':'dem-but1'?>" href="#"><?=$sector['Sector']?></a>
          <?php  }
          } ?>
        </td>
      </tr>
 <?php } } else{ ?>
      <tr>
        <td class="tb-wid4"></td>
        <td class="tb-wid3"></td>
        <td class="tb-wid3">No record found</td>
        <td class="tb-wid3"></td>
        <td class="tb-wid8"></td>
      </tr>
 <?php  } ?>