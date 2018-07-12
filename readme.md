# klink.asia website 

The K-Link.asia (https://klink.asia) Network website.

This reposiotry contains the website content and layout.
It is a static website, based on Markdown files and powered by [Jigsaw](http://jigsaw.tighten.co/).

- [Usage](#usage)
- [Configuration](#configuration)
- [Writing content](#writing-content)
- [Development](#development)

## Usage

The website is available as a Docker image. The Docker image build happens via the multi-stage approach.

To build the Docker image, after cloning the repository, run

```bash
docker build -t www-klink-asia --build-arg KLINK_URL=${KLINK_CONNECTION_URL} --build-arg KLINK_TOKEN=${KLINK_CONNECTION_TOKEN}  --build-arg APP_URL=${APP_URL} .
```

where

- `${KLINK_CONNECTION_URL}` is the URL of the K-Link for the search integration
- `${KLINK_CONNECTION_TOKEN}` is the authentication token for the website on the specified K-Link
- `${APP_URL}` the URL on which the website will be reachable

After the image is built, it can be used to deliver the website. By default the image exposes port `80`.

```bash
docker run --name klink-asia -d -p 80:80 www-klink-asia
```

## Configuration

The website configuration is located in the `config.php` and `config.production.php`.

To prevent secrets being published, the connection to a K-Link instance is configured using environment variables.

The variables are entered in a `.env` file. An example of the environment file is in `.env.example`

```bash
cp .env.example .env
```

#### K-Link connection

To enable the search experience, the connection to a K-Link instance must be configured.

The configuration can be achieved using two environment variables

- `KLINK_URL` The URL of the K-Link instance to connect to
- `KLINK_TOKEN` The authentication token to use the K-Link Api from the website

> Please consult the K-Link network administrator to obtain a valid token

#### Production URL

When building for production, the `APP_URL` variable should be set to the URL the users will use to browse the website, e.g. `https://klink.asia`

#### Analytics

The only analytics service supported is Matomo/Piwik and hosted on analytics.oneofftech.xyz

## Writing content

_to be written_



## Development

The website is powered by [Jigsaw](http://jigsaw.tighten.co/), a static site generator written in PHP.
The frontend is managed using [Laravel Mix](https://laravel.com/docs/5.6/mix) and powered by [TailwindCSS](https://tailwindcss.com/)

```bash
composer install --prefer-dist
yarn
# or npm install
yarn watch
# or npm run watch
```

This will build the local development version and expose it on localhost:3000. The website will be opened with 
your default browser with Browsersync.

> For more information refer to the [official building and previewing documentation](http://jigsaw.tighten.co/docs/building-and-previewing/)

## Contributing

All contributions are welcome!

If you want to contribute please submit a pull request based on the `master` branch.

