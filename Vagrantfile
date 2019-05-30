Vagrant.configure(2) do |config|
    config.vm.box = "ubuntu/xenial64"
    config.vm.hostname = "develop.eemayshop.com"
    config.vm.network :private_network, ip:"192.168.33.11"
    config.vm.provision "shell", path: "provisioning/bootstrap.sh"
    config.vm.synced_folder ".", "/var/www/eemayshop", :mount_options => ["dmode=777","fmode=777"]
end
