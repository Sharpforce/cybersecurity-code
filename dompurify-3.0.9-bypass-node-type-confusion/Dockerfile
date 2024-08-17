FROM node:20.12.0-alpine3.18

WORKDIR /usr/src/app

RUN apk add --no-cache shadow

RUN useradd --create-home --shell /bin/bash appuser

COPY package*.json ./
RUN npm install --omit=dev

RUN mkdir -p ./uploads
RUN mkdir -p ./styles
RUN mkdir -p ./js

COPY ./src/styles/bootstrap-5.3.3.min.css ./styles/bootstrap-5.3.3.min.css
COPY ./src/js/dompurify-3.0.9.js ./js/dompurify-3.0.9.js
COPY ./src/app.js ./
COPY ./src/index.html ./

RUN chown -R appuser:appuser /usr/src/app

EXPOSE 3000

USER appuser

CMD ["npm", "start"]