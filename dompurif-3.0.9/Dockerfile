FROM node:20.12.0-alpine3.18

WORKDIR /usr/src/app

RUN mkdir -p ./uploads
RUN mkdir -p ./styles
RUN mkdir -p ./js

COPY ./app/js/dompurify-3.0.9.js ./js/dompurify-3.0.9.js
COPY ./app/styles/bootstrap-5.3.3.min.css ./styles/bootstrap-5.3.3.min.css
COPY ./app/app.js ./
COPY ./app/index.html ./
COPY ./app/package.json ./

RUN npm install

EXPOSE 3000

CMD ["npm", "start"]