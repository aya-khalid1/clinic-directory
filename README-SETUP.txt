1) Copy the folders in this zip (app, database, resources, routes) INTO your clinic-directory project, accepting "Replace" for routes/web.php and DatabaseSeeder.php.
2) In the project folder run:
     php artisan migrate:fresh --seed
3) Open http://clinic-directory.test
4) GitHub:
     git init            (skip if the project already has a .git folder)
     git add .
     git commit -m "Clinic Appointment Directory: Laravel + Blade"
     git branch -M main
     git remote add origin https://github.com/ahmadobaidatjo-droid/clinic-directory.git
     git push -u origin main
   (create an EMPTY repo named clinic-directory on github.com first)
