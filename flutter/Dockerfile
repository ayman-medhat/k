FROM ghcr.io/cirruslabs/flutter:3.27.0 AS build

WORKDIR /app
COPY . .

ARG API_URL=/api
ENV API_URL=$API_URL

RUN flutter pub get && flutter build web --dart-define=API_URL=$API_URL --release

FROM nginx:alpine
COPY --from=build /app/build/web /usr/share/nginx/html
COPY nginx.conf /etc/nginx/conf.d/default.conf
EXPOSE 80
CMD ["nginx", "-g", "daemon off;"]
