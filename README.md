# A-Level Coursework
This project of mine is an eCommerce website for Zed’s Galaxy which I submitted as coursework for the A-Level Computer Science Non-Exam Assessment with the AQA exam board.
This project was built using HTML, CSS, JavaScript (jQuery) & PHP with a MySQL database as the backend.

A showcase of my project on YouTube is available [here](https://youtube.com/playlist?list=PLoMhAx1hylZZJw7NuMwyvaeryQvakKA2b).

## Installation:

Create a new `public_html` folder.

Clone this repository into `public_html` using [Git](https://git-scm.com/) by running:

    $ git clone https://github.com/addsh727/a-level-coursework.git

...or alternatively, download the files and extract using [WinRAR](https://www.win-rar.com/start.html?&L=0) or [7zip](https://www.7-zip.org/).

---

Install [XAMPP](https://www.apachefriends.org/)  (Video tutorials can be found [here](https://www.youtube.com/results?search_query=xampp+installation)).

Navigate to the XAMMP directory folder, then locate the `htdocs` folder and drag the folder `public_html` into `htdocs`.

---

Start running the MySQL server in XAMPP.

Open a browser tab and open the following URL:

    http://localhost/phpmyadmin

On the sidebar to the left, click `New` to create a new database.

Nagivate to the `Import` tab on the horizontal navbar, then import the preset database `s2106630.sql`.

Paste the following URL into the browser:

    http://localhost/public_html

And you should now have access to the eCommerce website!

## Setup PayPal API for Payment:

Video tutorials can be found [here](https://www.youtube.com/results?search_query=paypal+payment+api).

For the PayPal API to process transactions correctly, you must first obtain a PayPal client ID by through PayPal Developer.

Once obtained, locate `checkout.php`, then search for `$token`. 

Paste your PayPal client ID therein which will connect the website's payment gateway to your PayPal Developer Dashboard.

## Super Admin Access:

You can login to both the customer and staff portals with these details.

Owner Account Login:

    s2106630@leyton.ac.uk

Password:

    password

## Emails:

To configure the email templates, nagivate to `public_html/php` folder.

Open the `send----.php` email templates. Edit the `$from` variables to the email address from which you wish to send emails from along with others if needed.

Video tutorials can be found [here](https://www.youtube.com/results?search_query=phpmailer+send+email).

## Features:
- Customers:
  - Login/Logout
  - Registration
  - Store Navigation
  - Contact Form
  - Product Viewing
  - Shopping Cart
  - Checkout
  - Payment Processing
  - Profile Editing
  - View Orders

- Staff:
  - Login/Logout
  - Dashboard Interface
  - Statistic Counter Cards / KPIs
  - Recent Orders & New Customers
  - Customer Profiles
  - Testimonials
  - Analytics
  - Products & Categories (+ Spreadsheet Exports)
  - Customer Orders (+ Spreadsheet Exports)
  - Invoices (+ PDF Exports)
  - Staff Profiles (Owner only)
  - Reports
  - Settings & Profile Editing
  - Bypass Payment Process During Checkout

## APIs Used:
The modules and libraries used in this project are as follows:
- PHP:
  - [PHPMailer](https://github.com/PHPMailer/PHPMailer)
  - [PHPOffice](https://github.com/PHPOffice/PhpSpreadsheet)
  - [fpdf185](https://www.fpdf.org/)

- JavaScript:
  - [jQuery](https://jquery.com/)
  - [SweetAlerts](https://sweetalert2.github.io/)
  - [ScrollReveal.js](https://scrollrevealjs.org/)
  - [SwiperJS](https://swiperjs.com/)
  - [numberAnimate.js](https://www.jqueryscript.net/animation/Number-Rolling-Animation-jQuery-numberAnimate.html)
  - [ipAPI.co](https://ipapi.co/)
  - [PayPal API](https://www.paypal.com/uk/home)
  - [ChartJS](https://www.chartjs.org/)


## License:
[GNU General Public License v3.0](https://choosealicense.com/licenses/gpl-3.0/)

NOT FOR COMMERCIAL USE!

If you intend to use this project of mine for any commercial use, please contact me below to get my permission first.

## Authors
- [Adib Shehab](https://github.com/addsh727)

[<img src='https://cdn.jsdelivr.net/npm/simple-icons@3.0.1/icons/github.svg' alt='github' height='40'>](https://github.com/addsh727) [<img src='https://cdn.jsdelivr.net/npm/simple-icons@3.0.1/icons/linkedin.svg' alt='linkedin' height='40'>](https://www.linkedin.com/in/AdibShehab/) [<img src='https://cdn.jsdelivr.net/npm/simple-icons@3.0.1/icons/youtube.svg' alt='YouTube' height='40'>](https://www.youtube.com/channel/UC5Oief_SNB3MVdNinsxNz3w)
