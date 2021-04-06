## Displays task
####💻Steps to run:
1. copy `.env.example` content to `.env` and adjust `DB_*` variables as needed
2. run `composer install`
3. run `npm install`
4. run `php artisan migrate`
5. run `php artisan db:seed`
6. run `npm run dev`
7. run `php artisan serve`

####📑Comments
First of all I'd like to preface this by saying that this task was a great opportunity familiarize myself with even more
core Laravel features.
I made sure to explore and implement all the core functionalities in a way which
was (I believe) intended by the Laravel team.  

You will notice that I chose to implement an SPA app which consumes a .json API, so the endpoints return solely
.json responses. There is no specific reason why I did so this way, perhaps it was just out of habit. An idea that came
to mind during development was to handle both view (via blade templates) and .json responses depending on request type, 
but in the end I chose not to over-engineer the app. If you would like to see this implemented please let me know.

Any criticism and/or better practice suggestions are more than welcome. 🙂
