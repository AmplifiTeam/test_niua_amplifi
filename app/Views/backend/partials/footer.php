<!-- ======= Footer ======= -->
<footer id="footer" class="footer">
<div class="copyright"> © <?php echo date('Y'); ?> <span class="colr-n-1"> National Institute of Urban Affairs. </span>  All Rights Reserved.</div>
<div class="credits">
Maintained By <a href="https://niua.in/" target="_blank"> NIUA </a>
</div>
<p class="text-center" style="font-size: 11px;">Last Updated: <?php echo date('d/m/Y') ?></p>
</footer>
<!-- End Footer -->
<script src="<?=base_url('/assets/niua/js/jquery-3.5.1.min.js')?>"></script>
<script>
function scrollToTop() {
    $(window).scrollTop(0);
}

$(document).on('click','.markAllReadNotification',function(){
    $.ajax({
    type:'POST',
    url: '<?php echo base_url(); ?>admin/markAsReadNotification',
    data: {},
    dataType: "json",
       beforeSend: function(){
         $('.loadingSection').show();
       },
       complete: function(){
         $('.loadingSection').hide();
       },
    success: function(response){
        window.location.reload(); 
    }
    });
    
})
</script>