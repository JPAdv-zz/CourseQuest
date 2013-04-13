CourseQuest
-----------

CourseQuest is a simple website that enables search and discover courses from Coursera and Canvas.

Installation:
--------------

CourseQuest can easily be installed in your system. Simply follow the instructions (have
a terminal or command prompt opened):

*	Make sure that you have `git` installed.

		git -v

*	Go to any directory path in your computer.

		cd /to/myfavorite/location

*	Type the following command:

		git clone https://github.com/JPAdv/CourseQuest
		
*	Congrats! You should now be able to edit the project.

Edit:
-----

Forgot to mention that before editing, make sure you create a new branch by typing:

	git checkout -b myEdits

This allows you to make changes to the project without changing the *master* project
(the original downloaded project). This is also good practice and can save you large amounts of time.
Note: the name of the branch can be any name.
	
Make any additions to the project using your favorite text editor.

Pushing Changes:
----------------

Once you feel you have done enough and think you are ready to push your changes:

*	Add & commit your changes.

		git add	.
		git commit

	Commit will open a text editor. Type a brief summary of the changes you have made.

*	Go back to your *master* branch and merge your changes.

		git checkout master
		git merge myEdits

	This should merge the changes you made and you are ready to push.
*	Push your changes to the main repository.

		git push origin master

Make a pull request:
--------------------

Once you have done and you feel that your changes are noteworthy, make a pull request.
Your pull request will be viewed and be merged to this repository.

Alternatively:
--------------

You can use github's GUI client: 

-	[Mac Version](http://mac.github.com)
-	[Windows Version](http://windows.github.com)
-	Ubuntu Versions: There are a couple of open sourced projects. [Use Google](http://www.google.com)

What happens next?:
-------------------

Recursively do the same steps as you make changes. Let's make a great site!
