# ![RealWorld Example App](logo.png)

> ### Lumen codebase containing real world examples (CRUD, auth, advanced patterns, etc) that adheres to the [RealWorld](https://github.com/gothinkster/realworld) spec and API.


### [Demo](https://github.com/gothinkster/realworld) &nbsp;&nbsp;&nbsp;&nbsp; [RealWorld](https://github.com/gothinkster/realworld)


This codebase was created to demonstrate a fully fledged fullstack application built with **Lumen** including CRUD operations, authentication, routing, pagination, and more.

We've gone to great lengths to adhere to the **Lumen** community styleguides & best practices.

For more information on how to this works with other frontends/backends, head over to the [RealWorld](https://github.com/gothinkster/realworld) repo.


# How it works

> Describe the general architecture of your app here TODO

# Getting started

> npm install, npm start, etc. TODO

# Resources
- https://jwt-auth.readthedocs.io/en/develop/lumen-installation/
- https://www.positronx.io/laravel-jwt-authentication-tutorial-user-login-signup-api/

# Conventions

# Endpoints overview

| Verb | Endpoint | Description |
|----------|----------|----------|
| POST | /api/users/login | Authentication |
| POST | /api/users | Registration |
| GET | /api/user | Current User |
| PUT | /api/user | Update User |
| GET | /api/profiles/:username | Get Profile |
| POST | /api/profiles/:username/follow | Follow User |
| DELETE | /api/profiles/:username/follow | Unfollow User |
| GET | /api/articles | List Articles |
| GET | /api/articles/feed | Feed Articles |
| GET | /api/articles/:slug | Get Article |
| POST | /api/articles | Create Article |
| PUT | /api/articles/:slug | Update Article |
| DELETE | /api/articles/:slug | Delete Article |
| POST | /api/articles/:slug/comments | Add Comments to an Article |
| GET | /api/articles/:slug/comments | Get Comments from an Article |
| DELETE | /api/articles/:slug/comments/:id | Delete Comment |
| POST | /api/articles/:slug/favorite | Favorite Article |
| DELETE | /api/articles/:slug/favorite | Unfavorite Article |
| GET | /api/tags | Get Tags |
