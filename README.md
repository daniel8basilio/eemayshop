# eemayshop

### System Requirements

- Vagrant 2.1.5
- PHP 7.3 and above
- Apache 2.4
- Postgresql 9.6
- Composer
- Used framework: Symfony 3.4

### Environment setup

Run the following commands:

```
$ git clone git@github.com:devanyabasilio/eemayshop.git
$ cd eemayshop/
$ vagrant up
```

After successfully running `vagrant up`, enter the virtual machine and install the libraries needed

```
$ vagrant ssh
$ cd /var/www/eemayshop
$ composer install
```

*Additional setup for Windows*

- Add the server name to host file
`192.168.33.12 develop.eemayshop.com`


If setup is done you should be able to access the page `https:\\develop.eemayshop.com`

### Database

- Login in to database
  - **database name:** eemayshop
  - **username:** eemayshop
  - **password:** emma

```
$ vagrant ssh
$ psql -U eemayshop
```
