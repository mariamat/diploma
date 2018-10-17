# base image
FROM node:10.9.0-alpine

# set working directory
RUN mkdir -p /usr/src/app
WORKDIR /usr/src/app

# add `/usr/src/app/node_modules/.bin` to $PATH
ENV PATH /usr/src/app/node_modules/.bin:$PATH

# install angular globally
RUN npm install -g @angular/cli@6.2.1

# Run entry script
CMD ["sh", "/usr/src/app/scripts/dev-init.sh"]