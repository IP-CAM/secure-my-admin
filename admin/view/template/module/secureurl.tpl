<?php echo $header;

$secKey = ((isset($modules['secure_key'])) ? $modules['secure_key'] : '' );
$secVal = ((isset($modules['secure_value'])) ? $modules['secure_value'] : '' );
?>

<script type="text/javascript">

function randomString() {
	var chars = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXTZabcdefghiklmnopqrstuvwxyz";
	var string_length = 10;
	var randomstring = '';
	for (var i=0; i<string_length; i++) {
		var rnum = Math.floor(Math.random() * chars.length);
		randomstring += chars.substring(rnum,rnum+1);
	}

	return randomstring;
	
}


function ChangeUrl() {
var url = document.URL.substring(0, document.URL.indexOf("index"))
url += "?" + $('[name="secure_key"]').val()
url += "=" + $('[name="secure_value"]').val()
$('#finalURL').html(url);
}


function GenerateKey(){
document.getElementById("secure_key").value=randomString();
ChangeUrl();
}

function GenerateVal(){
document.getElementById("secure_value").value=randomString();
ChangeUrl();
}

</script>


<div id="content">
  <div class="breadcrumb">
    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
    <?php echo $breadcrumb['separator']; ?><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a>
    <?php } ?>
  </div>
  <?php if ($error_warning) { ?>
  <div class="warning"><?php echo $error_warning; ?></div>
  <?php } ?>
	
  <div class="box">
    <div class="heading">
      <h1><img src="view/image/logo_secure.png" alt="" /> <?php echo $heading_title; ?></h1>
      <div class="buttons"><a  class="button" id="submit"><?php echo $button_save; ?></a><a href="<?php echo $cancel; ?>" class="button"><?php echo $button_cancel; ?></a></div>
    </div>
    <div class="content">
      <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form">
        <table id="module" class="list">
         <h3>Administrator Key</h3>
            <tr>
          
              <td class="left">Status</td>
		<td>
		 <select name="secure_status">
                  <?php if ($modules['secure_status']) { ?>
                  <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                  <option value="0"><?php echo $text_disabled; ?></option>
                  <?php } else { ?>
                  <option value="1"><?php echo $text_enabled; ?></option>
                  <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                  <?php } ?>
                </select></td>
	
              </tr>
           <tr>
              <td class="left">Secure Key</td><td>
               <input type="text" name="secure_key" id="secure_key" onchange="ChangeUrl();" value="<?php  echo $secKey;   ?>"  />
		<button type="button" style="margin-left:10px;" onclick="GenerateKey()">Generate Me!</button></td>
		
		
              </tr>
           <tr>
              <td class="left">Secure Value</td><td>
               <input type="text" name="secure_value" id="secure_value" onchange="ChangeUrl();" value="<?php  echo $secVal;  ?>"  />
		<button type="button" style="margin-left:10px;" onclick="GenerateVal()">Generate Me!</button>
		</td>
		
              </tr>
			   
        </table>
		
	  <h3>Your Secure URL Link</h3>	
		<h3 id="finalURL" style="color: blue;"></h3>
		<br/>
		<h3 id="warning_msg"  style="color: Red; display:None;">**Please Record down your secure URL Link before saving.</h3>
      </form>
	  <br><br>


  <div class="box" style="width: 90%; margin: 0 auto;">
    <div class="heading">
      <h1><img src="view/image/customer.png" alt="" /> <?php echo $heading_title_ip; ?></h1>
      <div class="buttons">
		<a onclick="location = '<?php echo $insert; ?>'" class="button"><?php echo $button_insert; ?></a>
		<a onclick="$('form').submit();" class="button" style="background: #AF0303;"><?php echo $button_delete; ?></a>
	  </div>
    </div>
    <div class="content" style="min-height: 100px;">
      <form action="<?php echo $delete; ?>" method="post" enctype="multipart/form-data" id="form">
        <table class="list">
          <thead>
            <tr>
              <td width="1" style="text-align: center;"><input type="checkbox" onclick="$('input[name*=\'selected\']').attr('checked', this.checked);" /></td>
              <td class="left"><?php if ($sort == 'ip') { ?>
                <a href="<?php echo $sort_ip; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_ip; ?></a>
                <?php } else { ?>
                <a href="<?php echo $sort_ip; ?>"><?php echo $column_ip; ?></a>
                <?php } ?></td>
              <td class="right"><?php echo $column_action; ?></td>
            </tr>
          </thead>
          <tbody>
            <?php if ($admin_whitelists) { ?>
            <?php foreach ($admin_whitelists as $admin_whitelist) { ?>
            <tr>
              <td style="text-align: center;"><?php if ($admin_whitelist['selected']) { ?>
                <input type="checkbox" name="selected[]" value="<?php echo $admin_whitelist['admin_ip_whitelist_id']; ?>" checked="checked" />
                <?php } else { ?>
                <input type="checkbox" name="selected[]" value="<?php echo $admin_whitelist['admin_ip_whitelist_id']; ?>" />
                <?php } ?></td>
              <td class="left"><?php echo $admin_whitelist['ip']; ?></td>
              <td class="right"><?php foreach ($admin_whitelist['action'] as $action) { ?>
                [ <a href="<?php echo $action['href']; ?>"><?php echo $action['text']; ?></a> ]
                <?php } ?></td>
            </tr>
            <?php } ?>
            <?php } else { ?>
            <tr>
              <td class="center" colspan="10"><?php echo $text_no_results; ?></td>
            </tr>
            <?php } ?>
          </tbody>
        </table>
      </form>
      <div class="pagination"><?php echo $pagination; ?></div>
    </div>
  </div>
	  
	  <div style="text-align:center; margin-top:50px;"><h5>version 1.0.5</h5></div>
    </div>
	
  </div>
  <h4>For assistance or bug issues , feel free to report in our google code page - <a href="https://code.google.com/p/secure-my-admin/" target="_blank">https://code.google.com/p/secure-my-admin/</a> </h4>

<script type="text/javascript">

$(function(){
	$('#submit').click(function(){
		if(confirm("Have you saved the secure url yet?")) {
   		  $('#form').submit();
  		}
	});
	$('select').change(function(){
		$('#warning_msg').show();
	});
});


$(document).ready(function() { ChangeUrl() });

</script>

  
</div>
<?php echo $footer; ?>