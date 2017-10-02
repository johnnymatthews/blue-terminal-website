# Terminal Blog
This is the public repository for the terminal-style design of [mohnjatthews.com](//www.mohnjatthews.com). Feel free to clone and play around with this repo as much as you want. If you're looking for the CMS that this is built off, you need [Terrible CMS](//www.github.com/mohnjatthews/terrrible-cms). Fair warning, it's terrible.

---

## Prerequisites (the stuff you need to install before running this repo)
 - LAMP (Ubuntu, Apache2, MySQL, PHP7)
 - Composer
 - SSH Access

---

# Installation
If you really wanna see what's going on here, you can view the [live version](//www.mohnjatthews.com), or install it using the steps below.

1. Clone this repo: `git clone https://github.com/mohnjatthews/terminal-portfolio.git`
1. Login to the MySQL shell: `mysql -uroot -p`
1. Enter your MySQL root password.
1. Run the migration script: `source terminal-portfolio/migrations/create.sql;`
1. Exit the MySQL shell: `exit`
1. Copy the example `.env` file: `cp .example-env .env`
1. Modify the contents of the newly created `.env` file to relfect your MySQL credentials.
1. Install all Composer dependencies: `composer install`

That's it!