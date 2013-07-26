# jFileupload

jFileupload is just a test project to show how to implement [Sebastian Tschan's](https://blueimp.net/) jQuery Fileupload into [Laravel](http://laravel.com). I'm gonna give an overview of how It could be implemented on a real project.

[Official Website & Documentation](https://github.com/blueimp/jQuery-File-Upload/wiki)

## The project
This project shows how Sebastian's script could be implemented on a project to allow an admin user to create users and upload files to their folders. When a User is created a folder is created with his username and the script will upload files only to that folder.

There is no authentication module due this is just a test project but It could be extended very easily so the regular users can upload files to their folders too, it's only to take the idea.

**This is just a test project (and WIP) so CSS, Scripts, PHP files, etc are not perfect.**

## Steps

1. I decided to add it as a bundle so I created a folder inside bundles with the name 'jFileupload'.
2. Inside jFileupload bundle's folder I added the PHP Class you can grab from Sebastian's web and I renamed it to UploadHandler.php
3. Added the start.php:
```Autoloader::map(array('UploadHandler' => path('bundle').DS.'jfileupload'.DS.'UploadHandler'.EXT,));```
4. Added the bundle.php:
```return array('name' => 'jfileupload');```
5. Created a public folder with all the assets the script needs to work (js,css,imgs) and published them.
6. I Registered the bundle to the applications bundle array on /application/bundle.php.
7. Now you can choose if you want the php script work as a route or as a controller, I decided to create the controller upload.php to keep things clean on route.php
8. Due I needed dynamic paths to store the files I did not add jFileuplad to the IOC, I decided to initialize it every time I need and I do that on my upload.php controller.
9. That's it...!

## Test the project
The only thing you have to do to test the project is:

1. Download it
2. Add it to your htdocs folder or wherever you have your document root
3. Setup the /application/database.php config file
4. ```php artisan migrate:install```
5. ```php artisan migrate```
6. chmod -R 777 storage
7. mkdir /public/uploads/users
8. chmod 777 /public/uploads/users
9. Test it


## Final thoughts
First, I modifed slightly Sebastian's PHP Class and JS files so I could pass some parameters to the PHP Class (which by default were static), and the JS files in order to accept the styling I made to the HTML due I moved buttons from their default place and things like that.

Second, In order to work properlly clean urls must be used, the index.php must be removed from url, if not the script wont be able to delete files.


