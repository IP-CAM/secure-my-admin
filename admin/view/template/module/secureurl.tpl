<?php echo $header; ?>
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
      <h1><img src="view/image/module.png" alt="" /> <?php echo $heading_title; ?></h1>
      <div class="buttons"><a onclick="$('#form').submit();" class="button"><?php echo $button_save; ?></a><a href="<?php echo $cancel; ?>" class="button"><?php echo $button_cancel; ?></a></div>
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
               <input type="text" name="secure_key" value="<?php  if(isset($modules['secure_key'])) { echo $modules['secure_key'] ;  } ?>"  /></td>
		
              </tr>
           <tr>
              <td class="left">Secure Value</td><td>
               <input type="text" name="secure_value" value="<?php  if(isset($modules['secure_value'])) { echo $modules['secure_value'] ;  } ?>"  /></td>
		
              </tr>
	
        </table>




      </form>
    </div>
  </div>
</div>
<?php echo $footer; ?>