# 📝 Blog CMS with Laravel

## 📖 Project Description

This project is a **powerful Content Management System (CMS)** built
with **Laravel**, designed for managing blogs and articles efficiently.\
It provides a strong structure for managing **users, posts, categories,
and comments**, with advanced authentication and relationships between
models.

------------------------------------------------------------------------

## 🚀 Key Features

-   **Role-Based Access Control (RBAC):** Supports `admin`, `author`,
    and `user` roles.\
-   **Admin Dashboard:** Detailed statistics for posts (published,
    draft, archived), comments (approved, pending), and monthly
    analytics.\
-   **Post Management:** Manage posts with statuses (`published`,
    `draft`, `archive`) and custom filter routes.\
-   **Category Management:** Hierarchical categories with restrictions
    on deleting parent categories, plus search functionality.\
-   **Comment Management:** Edit/review system for comments, with status
    control (`published`, `draft`).\
-   **Authentication System:** User registration, login, password reset,
    and email verification enabled.\
-   **Database Structure:** Clear model relations (Posts, Comments,
    Users, Categories) with polymorphic relations support.

------------------------------------------------------------------------

## ⚙️ Requirements

-   **PHP:** 8.2+\
-   **Composer:** PHP dependency manager\
-   **Database:** MySQL, PostgreSQL, or SQLite

------------------------------------------------------------------------

## 🛠️ Installation

``` bash
# Clone the repository
git clone [https://github.com/AbdalhalimSayed/blog.git]
cd [blog]

# Install dependencies
composer install

# Setup environment
cp .env.example .env
php artisan key:generate
# Update .env with your database credentials

# Run migrations
php artisan migrate

# Start development server
php artisan serve
```

------------------------------------------------------------------------

## 🌐 Main Routes

### Public Routes

------------------------------------------------------------------------------------
  Route                          Description                        Notes
------------------------------ ---------------------------------- ------------------
  `/`                            Homepage                           \-

  `/blogs`                       View all posts                     \-

  `/category/{category}/posts`   Posts under a category             \-

  `/post/{post}/read`            View single post                   \-

  `/post/store/comment`          Add comment                        Requires auth

  `Auth::routes()`               Authentication (Login, Register,   \-
                                 Reset Password, Verify)            
  ------------------------------------------------------------------------------------

### Admin Routes (`/admin`)

All routes require **Admin** access.

---------------------------------------------------------------------------------------
  Route                            Controller                     Function
-------------------------------- ------------------------------ -----------------------
  `/admin`                         AdminController                Dashboard with
                                                                  statistics

  `/admin/users`                   UserController                 Manage users (CRUD +
                                                                  search)

  `/admin/posts`                   PostController                 Manage posts (CRUD)

  `/admin/categories`              CategoryController             Manage categories
                                                                  (CRUD + search)

  `/admin/comments`                CommentController              Manage comments (CRUD,
                                                                  review)

  `/admin/posts/draft`             PostController                 List draft posts

  `/admin/posts/archive`           PostController                 List archived posts

  `/admin/comments/{id}/publish`   CommentController              Publish a comment

  `/admin/comments/{id}/draft`     CommentController              Set comment to draft
  ---------------------------------------------------------------------------------------

------------------------------------------------------------------------

## 📄 License

This project is licensed under the [MIT License](LICENSE).
