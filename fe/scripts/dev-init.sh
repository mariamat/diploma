#!/usr/bin/env bash

# Check if node_modules directory exists
if [ ! -d /usr/src/app/node_modules ]; then
    echo "node_modules dir is missing, creating..."
    mkdir -p /usr/src/app/node_modules
fi

# Find out if node_modules directory is populated
filesInDirectory=$(ls -l /usr/src/app/node_modules | wc -l)
filesInDirectory=$(($filesInDirectory - 1))
if [ $filesInDirectory -eq 0 ]; then
    echo "Node Modules are missing, installing..."
    yarn install
#    npm install
    echo "Install completed!"
else
    echo "Node Modules are OK, updating..."
    yarn # upgrade makes a full scan of packages every time and slow down the startup process
#    npm update
    echo "Update completed"
fi

#cp /run/secrets/diploma-fe-secrets /usr/src/app/src/app/secrets.json
#cp /run/secrets/diploma-fe-localConfigs /usr/src/app/src/app/localConfigs.json

echo "Init complete"

# Run dev server
#ng serve --host 10.168.10.50 --public-host inspirle.eu --ssl --proxy-config proxy_configs/proxy-for-dev-server.conf.json
ng serve --host 0.0.0.0 --port 80 --public-host diploma.eu --live-reload false

# Print notification message
echo "Angular server Ready!"