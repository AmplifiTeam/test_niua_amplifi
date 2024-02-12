 <?php if(!empty($jobDetails)){
    foreach($jobDetails as $jkey=>$job){ ?>
  <tr>
    <td class="tb-wid2" ><?=$job['job_id']?> </td>
    <td class="tb-wid2"><?=$job['created_on']?> </td>
    <td class="tb-wid2"><?=$job['sector_Name']?></td>
    <td class="tb-wid4"><?=implode(", ",$job['cityNameArray'])?></td>
    <td class="tb-wid8"> <progress style=""  value="<?=$job['total_v1_attempt']?>" max="<?=$job['total_QuestionCount']?>"></progress> <?=round(($job['total_v1_attempt']/$job['total_QuestionCount'])*100)?>% </td>
    <td class="tb-wid8"> <progress style=""  value="<?=$job['total_v2_attempt']?>" max="<?=$job['total_QuestionCount']?>"></progress><?=round(($job['total_v2_attempt']/$job['total_QuestionCount'])*100)?>% </td>
    <td class="tb-wid3"> <a href="<?=base_url('admin/validators-status/'.$job['job_id'])?>"> View Status </a>  </td>
  </tr>
<?php } }else{ ?>
  <tr>
    <td class="tb-wid2" ></td>
    <td class="tb-wid2" ></td>
    <td class="tb-wid2" ></td>
    <td class="tb-wid2" >No job found</td>
    <td class="tb-wid2" ></td>
    <td class="tb-wid2" ></td>
    <td class="tb-wid2" ></td>
    
  </tr>
<?php }?>