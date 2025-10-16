# send-url-google-indexer

## Tool for send URLs to Google Indexing API

Make API request to Google Index API with List of URLs.


### Prepare

1) Download repository https://github.com/googleapis/google-api-php-client
   - Code -> Download ZIP
   - Unpack ZIP-archive in folder
2) Open CLI and do following commands
   - `cd google-api-php-client-main`
   - `composer install` - will download the Libs that need for Google SDK
3) Prepare list of URLs
   - Add URL to file `urls.txt`

### Run Indexer
- Run in CLI `php indexer.php`
- Will return Status code of result. Normally `200`. If other code value - please check https://developers.google.com/search/apis/indexing-api/v3/core-errors
- Limit for send Links to API is `200` - this is default limit for Google Indexing API.
