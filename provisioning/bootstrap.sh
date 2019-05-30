# Set language
sudo update-locale LC_ALL=en_US.UTF-8 LANG=en_US.UTF-8

# Edit the following to change the name of the database user that will be created:
APP_DB_USER=eemayshop
APP_DB_PASSWORD=emma
# Edit the following to change the name of the database that is created
APP_DB_NAME=$APP_DB_USER

PROVISIONED_ON=/etc/vm_provision_on_timestamp

if [ -f "$PROVISIONED_ON" ]
  # Install necessary packages
  sudo apt-get update
  apt-get install python-software-properties
  sudo add-apt-repository ppa:ondrej/php
  sudo apt-get update
  # Apache
  sudo apt-get update
  sudo apt-get install -y apache2 libapache2-mod-php7.3 libapache2-mod-fastcgi php-pear
  # PHP
  sudo apt-get update
  sudo apt-get install -y php7.3 php7.3-pgsql php7.3-gd php7.3-mbstring php7.3-cli php7.3-fpm php7.3-common php7.3-xml php7.3-curl zip unzip php7.3-zip
  # Composer
  sudo apt-get update
  sudo apt-get install -y curl
  sudo curl -s https://getcomposer.org/installer | php
  sudo mv composer.phar /usr/local/bin/composer

  # Postgres
  PG_VERSION=9.6
  PG_REPO_APT_SOURCE=/etc/apt/sources.list.d/pgdg.list
  if [ ! -f "$PG_REPO_APT_SOURCE" ]
  then
    # Add PG apt repo:
    echo "deb http://apt.postgresql.org/pub/repos/apt/ trusty-pgdg main" > "$PG_REPO_APT_SOURCE"
    # Add PGDG repo key:
    wget --quiet -O - https://apt.postgresql.org/pub/repos/apt/ACCC4CF8.asc | apt-key add -
  fi

  sudo apt-get update
  sudo apt-get -y install "postgresql-$PG_VERSION" "postgresql-contrib-$PG_VERSION"

  PG_CONF="/etc/postgresql/$PG_VERSION/main/postgresql.conf"
  PG_HBA="/etc/postgresql/$PG_VERSION/main/pg_hba.conf"
  PG_DIR="/var/lib/postgresql/$PG_VERSION/main"

  # Edit postgresql.conf to change listen address to '*':
  sed -i "s/#listen_addresses = 'localhost'/listen_addresses = '*'/" "$PG_CONF"

  # Change peer to md5
  sudo sed -i -e "/^local.*all.*all.*peer$/s/peer/md5/" "$PG_HBA"

  # Explicitly set default client_encoding
  echo "client_encoding = utf8" >> "$PG_CONF"

  # Restart so that all new config is loaded:
  sudo service postgresql restart
  # Enable postgresql to run on startup
  sudo update-rc.d postgresql enable

  # Initialize database
cat << EOF | su - postgres -c psql
-- Create the database user:
CREATE USER $APP_DB_USER WITH PASSWORD '$APP_DB_PASSWORD';
-- Create the database:
CREATE DATABASE $APP_DB_NAME WITH OWNER=$APP_DB_USER
                                  LC_COLLATE='en_US.utf8'
                                  LC_CTYPE='en_US.utf8'
                                  ENCODING='UTF8'
                                  TEMPLATE=template0;
EOF

  # Overwrite the default hosted directory
  sudo cp /vagrant/provisioning/apache/000-default.conf /etc/apache2/sites-available/000-default.conf

  # Enable PHP 7.3 fpm and fast_cgi module.
  sudo a2enmod proxy_fcgi
  sudo a2enconf php7.3-fpm
  # Enable PHP rewrite module
  sudo a2enmod rewrite
  # Restart Apache 2
  sudo service apache2 restart

  # Tag the provision time:
  date > "$PROVISIONED_ON"
then
  echo "VM was provisioned at: $(cat $PROVISIONED_ON)"
fi
