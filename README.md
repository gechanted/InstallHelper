InstallHelper

This Helper is made to easier install scripts. 

The program assumes you need to fill a settings file in this script,  
as well as making other things, like making a bd connection, to test the incoming info  

The install-helper auto fills arguments with:
 - incoming params
 - the prior set settings 
 - the default, if  available
 - request automatically, if all prior could not be applied  
 
Let me rephrase this:
 - the user inputs some params
 - the defaults add some more
 - the helper ask the user to enter the rest
 - you save the params in the settings
 
 2nd time they execute the script
 - the user inputs the params he want to change
 - the settings add the rest of the params
 - you can still ask the user if he wants to change more
 

