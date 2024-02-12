<?php if(!empty($cityList)){
    foreach($cityList as $ckey=>$city){ ?>
<tr>
<td class="tb-wid2"><?=$city['City_ID']?></td>
<td class="tb-wid2"><?=$city['City']?></td>
<td class="tb-wid2"><?=$city['State']?></td>
<td class="tb-wid4  <?php if($city['surveyAnsweredQuest']==0){echo "red";}elseif($city['surveyAllQuestions'] > $city['surveyAnsweredQuest']){ echo "orange";}else{echo "green";}?>" >

    <?php if($city['surveyAnsweredQuest']==0){echo "Not Started";}elseif($city['surveyAllQuestions'] > $city['surveyAnsweredQuest']){ echo "Inprogress";}else{echo "Completed";}?>

    </td>
<td class="tb-wid4">   <progress class="overAllProgress" style="" value="<?=$city['surveyAnsweredQuest']?>" max="<?=$city['surveyAllQuestions']?>">
</progress>
<p class="text-center" style="font-weight: bold;"><?=round(($city['surveyAnsweredQuest'] / $city['surveyAllQuestions']) * 100)?>%</p>
</td>
</tr>
<?php }}?>