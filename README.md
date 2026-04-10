# Broadcasting learning project

This repository is a small Laravel app for learning **event broadcasting** (public and private channels, Pusher/Echo). Open the app in the browser with the **developer console** visible to see client-side logs when you fire events from the terminal.

---

## Artisan commands

| Command | Arguments | What it does |
|--------|-----------|----------------|
| `fire:public` | `{status}` | Dispatches `CreatedNotification` on the **public** channel. Watch the browser console after running it. |
| `fire:private` | `{userId} {status}` | Dispatches `CreatedPrivate` on a **private** channel for that user. Log in as that user in the browser to receive it. |
| `fire:notification` | `{userId} {message}` | Sends the `PrivateBroadcast` notification to that user (broadcast-only). Echo receives it on the user’s private channel via `.notification()` in `resources/js/app.js`. Log in as that user to see the message in the console. |
| `fire:private-share` | `{status}` | Dispatches `CreatedPrivateShare` (private channel flow used in this project). |
| `fire:presense` | `{roomId}` | Dispatches `CreatedPresense` for the presence-room flow (`chat.{roomId}`). |
| `post:crud` | `{userId}` | Creates a post for that user, then reads, updates, and deletes it (CRUD demo in the terminal). |
| `inspire` | — | Built-in demo command: prints an inspiring quote in the terminal. |

Examples:

```bash
php artisan fire:public "hello"
php artisan fire:private 1 "update for user 1"
php artisan fire:notification 1 "hello via notification"
php artisan fire:private-share "shared message"
php artisan fire:presense 1
php artisan post:crud 1
php artisan inspire
```

---

## Client events (whispers)

Server-side Artisan commands are not involved here. The app subscribes to the **presence** channel `chat.1` via `Echo.join` in `resources/js/app.js` and listens for the client event `typing` with `listenForWhisper`.

1. Log in and open the **Dashboard**.
2. Click **Send typing whisper**. That calls `whisper('typing', { userId })` on the same presence channel subscription.
3. Watch the browser console: other tabs or users in the same presence room should log the typing payload (and your own tab may log it too, depending on Pusher settings).

**Requirements:** In the Pusher dashboard, **Enable client events** must be on for your app, or whispers will not be delivered.

---

## Composer scripts

| Command | Purpose |
|---------|---------|
| `composer run setup` | Install PHP deps, ensure `.env` and app key, migrate, `npm install`, `npm run build`. |
| `composer run dev` | Runs server, queue listener, Pail, and Vite together via `concurrently`. |
| `composer run test` | Clears config cache and runs the test suite (`php artisan test`). |

---

## npm scripts

| Command | Purpose |
|---------|---------|
| `npm run dev` | Start the Vite dev server (HMR for assets). |
| `npm run build` | Production build of frontend assets. |

---

## Docker helpers

Start PHP-FPM and nginx (app at [http://localhost:8080](http://localhost:8080) by default):

```bash
docker compose up -d
```

| Script | Purpose |
|--------|---------|
| `./go-into-app` | Interactive shell inside the **`app`** container (`bash`). Requires `docker compose up -d`. |
| `./local-npm` | Runs `npm` inside the **`node`** container, e.g. `./local-npm install`, `./local-npm run build`. For **`npm run dev`** with Vite reachable on the host, publish ports: `LOCAL_NPM_PORTS=1 ./local-npm run dev -- --host 0.0.0.0` |

Optional long-running Node service:

```bash
docker compose --profile node up -d
```

Run Artisan inside Docker:

```bash
docker compose exec app php artisan fire:public "from docker"
docker compose exec app php artisan fire:notification 1 "from docker"
docker compose exec app php artisan post:crud 1
```
