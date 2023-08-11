## Basic Centrometal Rest Service

* Login in portal.centrometal.hr
* Get PHPSESSID Cookie value.
* Update .env and set CENTROMETAL_SESSION_ID //mandatory variable
    * update .env and set CENTROMETAL_INSTALLATION_ID to escape extra requests for installationId //optional variable
* composer install
* composer update

## Result in home assistant
![Alt text](/storage/home-assistant-result.png?raw=true "Home Assitant Card")

## JSON Result
* Humanized data in controller: /centrometal/status/humanized
  ![Alt text](/storage/json-example.png?raw=true "Home Assitant Card")

## Available requests
* /centrometal/installation
* /centrometal/installation/data
* /centrometal/status
* /centrometal/status/humanized
* /centrometal/wdata
* /centrometal/user
* /centrometal/errors
