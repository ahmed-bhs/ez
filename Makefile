DC='PROJECTNETWORKNAME=ahmedezplatformtest PROJECTPORTPREFIX=42 PROJECTCOMPOSEPATH=../../ PROVISIONINGFOLDERNAME=provisioning HOST_COMPOSER_CACHE_DIR=/home/ahmed/.composer/cache DEV_UID=1000 DEV_GID=1000 COMPOSER_CACHE_DIR=/var/www/composer_cache PROJECTMAPPINGFOLDER=/var/www/html/project BLACKFIRE_CLIENT_ID= BLACKFIRE_CLIENT_TOKEN= BLACKFIRE_SERVER_ID= BLACKFIRE_SERVER_TOKEN= DOCKER_HOST= DOCKER_CERT_PATH= DOCKER_TLS_VERIFY= PATH=/usr/local/sbin:/usr/local/bin:/usr/sbin:/usr/bin:/sbin:/bin:/usr/games:/usr/local/games:/snap/bin:/home/ahmed/.antigen/bundles/robbyrussell/oh-my-zsh/lib:/home/ahmed/.antigen/bundles/robbyrussell/oh-my-zsh/plugins/git:/home/ahmed/.antigen/bundles/robbyrussell/oh-my-zsh/plugins/heroku:/home/ahmed/.antigen/bundles/robbyrussell/oh-my-zsh/plugins/pip:/home/ahmed/.antigen/bundles/robbyrussell/oh-my-zsh/plugins/lein:/home/ahmed/.antigen/bundles/robbyrussell/oh-my-zsh/plugins/command-not-found:/home/ahmed/.antigen/bundles/zsh-users/zsh-autosuggestions:/home/ahmed/.antigen/bundles/zsh-users/zsh-syntax-highlighting docker-compose -p ahmedezplatformtest -f /home/ahmed/Projets/ezplatform_test/provisioning/dev/docker-compose.yml'

EZ=docker-compose
RUN=$(EZ) run --rm
EXEC=$(EZ) exec
ENV?=dev

##
## Project setup
##---------------------------------------------------------------------------

start:          ## Install and start the project
start: 


install:        ## Install the whole project
install: start node_modules


node_modules: ezplatform/package.json
	@echo "Installing client dependencies"
	@$(RUN) yarn install
