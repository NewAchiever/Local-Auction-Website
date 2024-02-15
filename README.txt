There are a few things that you should know before reviewing the application.

1) There are a few dependencies which requires this app to be put inside "xampp/htdocs/gec-auction/index.php".

2) Create the db into phpmyadmin by importing the given "auction.sql" file. (Which has to entries for users table, DO NOT remove those entries)

2) Registration of a new user requires verification of the account. For which an email is sent to the user's email id from my own account which is "nsp4898@gmail.com". I have disabled this features as it was putting my account security at risk.

3) For accessing the application, I have created two accounts with user credentials:
	email: nsp48981@gmail.com
	password: neel4898

	email: nilkumarpatel48@gmail.com
	password: neel4898

4) To test the chatting facility, you need to sign in two times with different accounts (mentioned above).

Note: I have added a folder called "Images (disabled feature)" for you to view the verification-mail and webpage that handles this operation.

==============================================================================================================================

If you want to check out the registration feature and e-mail verification then you need to add your email and password to "$uname" and "$passw" respectively in "send_mail.php". (Line 41 and 42).

You will also have to go to your google account settings' security tab and turn on access for "less secure apps". (not recommended, same reason why I removed my info from send_mail.php).