# TIVIX recruitment application

This project consists of two parts:
- REST API served to: register new user, log in as authenticated user, get various positions lists
from OMD. 
- Very simple and ugly-coded frontend part available on: http://tivix-app.local/

Application was running with [Laradock](https://laradock.io/)

## Run application
- create directory for project and go into
- `git clone https://github.com/krzysztofchadynka/tivix-app-api`
- `git clone https://github.com/laradock/laradock`
- `cd laradock`
- `cp .env.example .env`
- make changes in `.env` file:
    - set `APP_CODE_PATH_HOST` as absolute path to directory with `tivix-app-api `project on your host
    - set `APP_CODE_PATH_CONTAINER` with value: `/var/www/tivix-app`
    - set `MYSQL_VERSION` as `5.7`
- go inside `nginx/sites` directory, change name of `default.conf` file to `tivix-app.local`;
Change `server_name` value to `tivix-app.local` and `root` to `/var/www/tivix-app/public`
- **For Mac OS users:**
  - go inside `mysql` directory and make changes in `Dockerfile`: 
  change line `FROM mysql:${MYSQL_VERSION}` to `FROM --platform=linux/amd64 mysql:${MYSQL_VERSION}` 
- Edit your local `/etc/hosts` file adding line: `127.0.0.1 tivix-app.local`
- `docker-compose up -d nginx mysql workspace`
- `docker-compose exec workspace bash`
- `sh build-dev.sh`

Then front part of application should be available on `http://tivix-app.local/` and API
should be available on `http://tivix-app.local/api`.

Sample log in data are:
email: test-user@tivix.com
password: test1234
