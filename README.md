
# QuizWhiz

<p align="center"><img src="https://i.ibb.co/Y3HYytH/Screenshot-2023-05-28-030655.png" alt="Screenshot-2023-05-28-030655" border="0"></p>

A Laravel web application that will test your intellectual prowess. It allows user to create accounts and post their own quizzes which can be also taken by other users.

## Installation

1. Clone the repository.

```bash
git clone https://github.com/psub-bsit3a-ccit106-2023/auth-part2-final-group-1.git
```

2. Install the vendor files needed to run the application.

```bash
composer install
```

3. Download the node modules.

```bash
npm install
```

4. Copy the __.env.example__ to the same directory and rename it to __.env__.

    * For cmd, use:

        ```cmd
        copy .env.example .env
        ```

    * For git bash, use:

        ```bash
        cp .env.example .env
        ```

5. Generate the key for the laravel web application.

```bash
php artisan key:generate
```

6. Run the __dev__ script in package.json.

```bash
npm run dev
```

6. Run the QuizWhiz by entering the command:

```bash
php artisan serve
```

You can now visit the application in __http://localhost:8000__.
