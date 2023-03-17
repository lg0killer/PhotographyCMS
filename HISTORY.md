# Purpose
This file will serve as the main thinking and reasoning on items as well as steps that we execute during the creation of this project.

I intend to keep this up to date as much as possible so that anyone can go back and do what they want, when they want to this project.

## 17 March 2023

### Create Laravel application
I went over a couple of languages and frameworks and I decided to settle on Laravel with the VUE.js frontend purely because they seem to look the cleanest on the ui and in the code.

Started by creating the project with sail. Sail is a nice tool from the Laravel community that serves as a development environment. All you need to run it is docker!

```bash
curl -s "https://laravel.build/photographyCMS?with=mysql" | bash
```
This creates the default structure and allows me to only depend on mysql (The environment we are moving to does not have docker)

Once the application has been created you can cd into the directory (in this case photographyCMS)

`cd photographyCMS`

From here we can look at some of the basics.

### Controlling the Dev environment

With the environment created, we can start it up by running `./vendor/bin/sail up`. This will compile the containers and start the application.

Now to make this easier, create an alias for sail using `alias sail=vendor/bin/sail`. This way you can just say `sail up` to start the environment and `sail down` to stop and close the environment. 

To communicate any commands to the laravel environment, we usually do `php artisan`. Now since this is running in its own docker environment, we can't just run that command. Instead, we can use `sail` to communicate to Laravel `sail artisan`.

The same for installing packages using `npm` or `composer`, `sail npm install` and `sail composer require <pacakge_name>`


### Installing dependencies

Now that we have the basic environment created, lets start installing some components that we want to use. I mainly looked at using Laravel Jetstream since it has auth and user managment out the gate.

`sail composer require laravel/jetstream `

Next we need to install a version that suits our needs for the project. I'm going with the `--dark` option, purely because images look better on a darker screen.

`sail artisan jetstream:install inertia --dark`

This creates the default application for Jetstream.

Lets install the rest of the dependencies

```
sail npm instal
sail artisan migrate:fresh
sail npm run dev
```

Now our environment should be running the default Laravel application with a login/register option on the side.

Lets register and continue to the application
