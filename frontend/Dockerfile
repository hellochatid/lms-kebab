# develop stage
FROM node:lts-alpine as develop-stage
WORKDIR /app
COPY ./src/package*.json ./
RUN npm install
COPY ./src .

# build stage
FROM develop-stage as build-stage
RUN npm run generate

# production stage
FROM nginx:stable-alpine as production-stage
COPY --from=build-stage /app/dist /usr/share/nginx/html
EXPOSE 80
CMD ["nginx", "-g", "daemon off;"]