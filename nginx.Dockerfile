FROM nginx:1.24-alpine

FROM nginx:1.24-alpine AS build

RUN apk add --no-cache \
    gcc g++ make \
    musl-dev \
    linux-headers \
    libmaxminddb-dev \
    curl \
    pcre-dev \
    zlib-dev \
    openssl-dev \
    git

WORKDIR /tmp
RUN curl -O http://nginx.org/download/nginx-1.24.0.tar.gz \
    && tar zxvf nginx-1.24.0.tar.gz \
    && git clone https://github.com/leev/ngx_http_geoip2_module.git

WORKDIR /tmp/nginx-1.24.0
RUN ./configure \
    --with-compat \
    --add-dynamic-module=../ngx_http_geoip2_module \
    --prefix=/etc/nginx \
    --conf-path=/etc/nginx/nginx.conf \
    --sbin-path=/usr/sbin/nginx \
    --modules-path=/etc/nginx/modules \
    && make modules

FROM nginx:1.24-alpine

RUN apk add --no-cache libmaxminddb

COPY --from=build /tmp/nginx-1.24.0/objs/ngx_http_geoip2_module.so /etc/nginx/modules/

COPY nginx.conf /etc/nginx/nginx.conf
COPY conf.d /etc/nginx/conf.d

RUN mkdir -p /etc/nginx/geoip
RUN wget -O /etc/nginx/geoip/GeoLite2-City.mmdb https://git.io/GeoLite2-City.mmdb

EXPOSE 80
CMD ["nginx", "-g", "daemon off;"]
