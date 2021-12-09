
<div id="top"></div>



<!-- PROJECT LOGO -->
<br />
<div align="center">
  <a href="https://github.com/othneildrew/Best-README-Template">
    <img src="public/img/logo.png" alt="Logo" width="300">
  </a>

  <h3 align="center">Quick Overflow</h3>

  <p align="center">
    An awesome Stack Overflow type forum system to get your team to start contributing.
    <br />
    <a href="https://github.com/vidaldl/QuickOverflow"><strong>Explore the docs »</strong></a>
    <br />
    <br />
    <a href="http://quickoverflow.herokuapp.com/">View Demo</a>
    ·
    <a href="https://github.com/vidaldl/QuickOverflow/issues">Report Bug</a>
    ·
    <a href="https://github.com/vidaldl/QuickOverflow/issues">Request Feature</a>
  </p>
</div>



<!-- TABLE OF CONTENTS -->
<details>
  <summary>Table of Contents</summary>
  <ol>
    <li>
      <a href="#about-the-project">About The Project</a>
      <ul>
        <li><a href="#built-with">Built With</a></li>
      </ul>
    </li>
    <li>
      <a href="#getting-started">Getting Started</a>
      <ul>
        <li><a href="#prerequisites">Prerequisites</a></li>
        <li><a href="#installation">Installation</a></li>
      </ul>
    </li>
    <li><a href="#usage">Usage</a></li>
    <li><a href="#roadmap">Roadmap</a></li>
    <li><a href="#contributing">Contributing</a></li>
    <li><a href="#license">License</a></li>
    <li><a href="#contact">Contact</a></li>
    <li><a href="#acknowledgments">Acknowledgments</a></li>
  </ol>
</details>



<!-- ABOUT THE PROJECT -->
## About The Project

There are so many great forum type apps out there that finding a fully customizable one is possible, but finding a free fully customizable is not. That is why I created Quick Overflow. We wanted to make a bare bones forum system and release it as open source for anyone looking to customize it to their and their team needs. 

Here's what's great about it:
* You can have a simple and clean-looking forum system in 5 minutes by following our "Deploy to Heroku" instructions.
* You can clone and work on this system. Changing and updating whatever you think can be bettered.
* Custom collaboration developed using the vanguard of frameworks.


<p align="right">(<a href="#top">back to top</a>)</p>



### Built With

This section should list any major frameworks/libraries used to bootstrap your project. Leave any add-ons/plugins for the acknowledgements section. Here are a few examples.

* [Vue.js](https://vuejs.org/)
* [Laravel](https://laravel.com)
* [Bootstrap](https://getbootstrap.com)
* [JQuery](https://jquery.com)

<p align="right">(<a href="#top">back to top</a>)</p>



<!-- GETTING STARTED -->
## Getting Started

This are the steps required for deployment on Heroku which is a free service where you can easily work with a small team of up to 20 people without paying a dime.

### Prerequisites

This is an example of how to list things you need to use the software and how to install them.
* GitHub account -> [https://github.com](https://github.com)
* Heroku account -> [https://heroku.com/](https://heroku.com/)

### Installation

_Below are the steps to deploy the app using Heroku. Of course you are free to clone this project and deploy it to any server of your choosing._


#### I. Create a repository on your GitHub account.
1. Go to GitHub and create a new empty repository.
2. Once the repository is created click on "Import code" and paste: 
   ```sh
   https://github.com/vidaldl/QuickOverflow
   ```
3. Click on "Begin import".
   
   

#### II. Creating the Heroku App
1. Click on the "Deploy to Heroku" button down below. <br /><a target="_blank" href="https://heroku.com/deploy?template=https://github.com/vidaldl/QuickOverflow"><img src="https://www.herokucdn.com/deploy/button.svg" style="margin-right: 30px;" alt="Deploy"></a>
2. Choose a name for the app and click on "Deploy App".
3. Once the app is done deploying click on "Manage App".
4. Navigate to "Deploy" and select "GitHub" under "Deployment method"
5. Click on Connect to GitHub(If you've never connected your Heroku account to GitHub in the past)
7. Click on connect to the right of the repository you searched for.
8. go to settings -> buildpacks -> Click on "Add Buildpack" -> Select "nodejs" -> Click on "Save Changes"
9. navigate to your Heroku App and to Settings -> Click on "Reveal Config Vars"
10. Add the following vars (Values in quotes("") can be customized):
    ```
    APP_DEBUG => false
    APP_ENV => "production"
    APP_NAME => YourCustomAppName
    APP_URL => (The URL you get when clicking "Open App" on Heroku App Settings)
    ```
  
  
#### III. Configuring the App Key
1. Go to More -> Run console, and paste the following:
    ```sh
    php artisan key:generate --show
    ```
2. Copy the line that starts with base64:... 
3. Navigate to Settings -> On Config Vars click on Reveal Config Vars -> Add a new Config Var:
   ```
   APP_KEY => Value Paste the base64:... line.
   ```


#### IV. Setup Database and Config Vars
1. Navigate to resources -> search for "Heroku Postgres" -> Select plan -> Submit Order Form.
2. Navigate to Resources and click on "Heroku Postgres".
3. In the new page that opens up Navigate to Settings.
4. Under Database Credentials click on "View Credentials"
5. With the information now displaying navigate to your Heroku App and to Settings -> Click on "Reveal Config Vars".
6. Add the following vars (The values of these vars are from the "View Credentials" on the "Heroku Postgres" resource):
    ```
    DATABASE_URL => URI (THIS ONE IS AUTOMATICALLY CREATED)
    DB_CONNECTION => pgsql
    DB_DATABASE => Database(value on "View Credentials" page)
    DB_HOST => Host(value on "View Credentials" page)
    DB_PASSWORD => Password(value on "View Credentials" page)
    DB_PORT => Port(value on "View Credentials" page)
    DB_USERNAME => User(value on "View Credentials" page)
    ```
7. go to More -> Run console, and paste the following "php artisan migrate --seed" (This will create the database and put some dummy data in)
8. input "yes" when prompted.


#### V. Manually Deploy
1. Navigate to Deploy -> Select "master" under "Manual deploy" and click on "Deploy Branch"



<p align="right">(<a href="#top">back to top</a>)</p>



<!-- USAGE EXAMPLES -->
## Usage

QuickOverflow is an app/ website made to function as a forum for developers, in the same manner as other sites like Reddit or Stackoverflow. 
The way we submit a question is we first create a login for the site, then after that we click on the big green button that says "ask a question". You then want to type your question into the text box there, and you are able to submit your question to be seen by users on the app. Other users can then answer the question, whether it be a coding problem or a basic question, others can help you out. You can also see your posts from before, and whether they have been answered or not.


<p align="right">(<a href="#top">back to top</a>)</p>



<!-- LICENSE -->
## License

Distributed under the MIT License. See `LICENSE.txt` for more information.

<p align="right">(<a href="#top">back to top</a>)</p>



<!-- CONTACT -->
## Contact

David Vidal - vidaldl@outlook.com

Project Link: [https://github.com/vidaldl/QuickOverflow](https://github.com/vidaldl/QuickOverflow)

<p align="right">(<a href="#top">back to top</a>)</p>


