## FileInvite - Booking System

#### Requirements
The website was built using SPA (Single Page Application) using Laravel for API and VueJs

#### Development Setup
- [Laravel Homestead](https://laravel.com/docs/8.x/homestead#introduction) is an official development environment in Laravel.
It might take a while to setup an environment using Laravel Homestead if this is your first time. 
But everything will become very handy and easy once you finish setting up your first project 
- Clone the code from github: `git clone git@github.com:paengski13/booking-system-fileinvite.git`
- Create a database in MySQL
- Rename .env.example to .env. Update the DB credentials accordingly.
- I have created a bash script that contains bunch of composer and laravel commands: `./deploy-dev.sh`
- Enter the IP address into your browser to try to access your local.
- In addition, you can also edit your /etc/hosts and mask your local IP to booking-system-fileinvite.local.local
- Access https://booking-system-fileinvite.local.local. Congrats, if you are able to see this!
![Alt text](FileInvite_Booking_System.png?raw=true)


#### Unit Test
- Due to limited time, I was not able to put any unit test

#### List of API's
 - Registration: `/api/register` This is to create your user before calling any API that requires valid bearer token. (This is just an alternative to test API via postman)
 - Login: `/api/login` Use your email and password used to register to retrieve a token. (This is just an alternative to test API via postman)
 - Book a room: `/api/bookings`
 - Get All bookings: `/api/bookings/<booking_id>`
 - Update a specific Booking: `/api/bookings/<booking_id>`
 - Delete a specific Booking: `/api/bookings/<booking_id>`

#### Postman
Postman collection and environment are available in the repo `postman/`

#### Limitations
There are few limitations that I was not able to complete:
 - Unsupported search filters in the frontend.
 - Unsupported to display validation error in the frontend.