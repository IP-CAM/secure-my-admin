=========================================================================================
SECURE MY ADMIN 
Author:Razorin Works 
Email :razorin.works@gmail.com
Website:https://code.google.com/p/secure-my-admin/

Thank you for supporting this extension and please don't forget to rate it ( Click 5 Stars )


This extension adds additional keys and value to the administrator login to prevent
people from accessing and hacking. 

The implementation of the plugin "SecureMyAdmin" does not prevent 100% penetration of
the opencart system. 

Razorin works does not bear any responsibility or liability for the actions of any SecureMyAdmin users.

The owner of the OC system must always use strong password and must not reveal 
the keys to anyone else.


INSTRUCTIONS for installation
===============================
1) You would need a minimum of vqmod  2.2 installed in your opencart system

2) Copy all the files into the OC directory. 

3) Install secureMyAdmin in the modules page.


How to install the module
===============================
1) Upload 2 folders admin & vqmod to your opencart main directory.

2) After that access the Extensions > Modules > Secure My Admin - Secure URL for Administrator Backend 

3) Click on the [Install] link, Upon successful installation you will see [Edit][Uninstall].

@thumbs up for sfkhan !
4) Go to System > Users > User Groups > Top Administrator ( Or any groups you would like to have access ) and click [Edit]

5) Find and Tick module/secureurl for both Access and modify permission.

6)Click on the [Edit] link and you will be redirected to the plugin page.

7) You will see status, Secure Key and Secure Value.

8) Select the status to enabled and key in your secure key and secure value.

**Please note that # and Symbols can NOT be used in your key and value. Only alphanumeric is allowed.

9) Upon entering both key and value, click on the save button.

**Please remember the key and value before saving, without them you can NOT access your url panel.


How to access the admin URL after setting the module
======================================================
To access your administrator panel after you set the securekey and secure value

www.yourstorename.com/admin/?securekey=securevalue



How to disable the admin URL after setting the module
======================================================
To disable the component, just rename the vqmod file from secureMyAdmin.xml to secureMyAdmin._xml

By doing this , you are temporarily uninstalling the plugin. To change the key and value, you would need
to access your database and retrieve the keys.

Query for disabling the internal status of the secureadmin module.

"UPDATE `DB_PREFIX_setting` SET `value` = '0' WHERE `group` = 'secureurl' and `key` = 'secure_status' ; "


For support, Please contact razorin.works@gmail.com

