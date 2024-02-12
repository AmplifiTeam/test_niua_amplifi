<?php
$i=1;
if(isset($allDocuments) && !empty($allDocuments)) {
foreach ($allDocuments as $allDocumentsDetails){
   $doc=base_url('assets/uploads/question_documents/').$allDocumentsDetails['document'];
?>
<tr>
<td scope="row"><?php echo $i; ?></td>
<td class="size-1" class="text-center d-none"><?php echo $allDocumentsDetails['doc_original_name']; ?></td>
<td class="text-center"><a href="<?php echo $doc; ?>" target="_blank" ><i class="bi bi-download"></i></a></td>
<td><button onclick="deleteQuestionDocument('<?php echo $allDocumentsDetails['id']; ?>','<?php echo $allDocumentsDetails['Survey_ID']; ?>','<?php echo $allDocumentsDetails['sector_id']; ?>','<?php echo $allDocumentsDetails['QB_ID']; ?>');" type="button" class="btn btn-primary cancel1">Delete</button></td>
</tr>
<?php $i++;}}else{ ?>
	<tr><td colspan="4" class="text-center"><span style="color:red;">No document found!</span></td></tr>
<?php } ?>