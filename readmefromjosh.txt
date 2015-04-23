Notes From Josh

1st Update - Actually, you guys might not have laravel at all. You can probably 
access it if you use the /home/s4315062/.composer/vendor/bin/laravel, but I doubt it 
because that's my home directory :P The only problem here is that everytime you 
close Putty and the session (or whatever terminal you are using), it resets your 
$PATH variable, which means that everytime you want to use laravel, you will need to
either modify your PATH variable again or calling laravel with /home/s4315062/....
Neither are good options so I have to modify the "/etc/profile" file which 
sets up the $PATH variable for everyone. However, this file only has write permissions
to root and no one else, so I can't do anything. Even if I use sudo, it's probably 
not a good idea because there is a reason why /etc/profile is read only (making sure 
that no students mess it up). Anyways, if that's the case, what you will need to do 
is do the following:

vim ~/.bash_profile

then add the following at the bottom of the line:

PATH=$PATH:/home/s4315062/.composer/vendor/bin/
export PATH

That way, everytime you log in to our zone using your account, you should 
be able to access laravel. 
