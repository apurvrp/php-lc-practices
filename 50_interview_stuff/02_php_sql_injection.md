### What is SQL Injection in Laravel?

**SQL Injection** in Laravel is a security vulnerability where an attacker inserts malicious SQL code into database queries, potentially gaining unauthorized access to data or modifying the database. This happens when user inputs are not properly validated or sanitized before being used in raw SQL queries.

Laravel, being a modern PHP framework, provides built-in mechanisms to prevent SQL Injection by default.

---

### How Laravel Prevents SQL Injection

Laravel's Eloquent ORM and query builder automatically escape user inputs to protect against SQL Injection. When you use these features, Laravel treats user inputs as data, not executable SQL.

---

### Practical Examples of Preventing SQL Injection in Laravel

#### **Unsafe Code (Vulnerable to SQL Injection):**

If you use raw SQL queries with unescaped user inputs:

```php
<?php

$username = request('username');
$password = request('password');

// Vulnerable query
$user = DB::select("SELECT * FROM users WHERE username = '$username' AND password = '$password'");

if ($user) {
    return "Login successful!";
} else {
    return "Invalid credentials!";
}
```

An attacker could input `"' OR '1'='1"` as the username or password to bypass authentication.

---

#### **Safe Code Using Laravel Query Builder:**

The query builder automatically escapes inputs:

```php
<?php

$username = request('username');
$password = request('password');

// Secure query
$user = DB::table('users')
    ->where('username', $username)
    ->where('password', $password)
    ->first();

if ($user) {
    return "Login successful!";
} else {
    return "Invalid credentials!";
}
```

---

#### **Safe Code Using Eloquent ORM:**

Eloquent also protects against SQL Injection:

```php
<?php

$username = request('username');
$password = request('password');

// Secure query
$user = User::where('username', $username)
    ->where('password', $password)
    ->first();

if ($user) {
    return "Login successful!";
} else {
    return "Invalid credentials!";
}
```

---

#### **Safe Code Using Parameterized Raw Queries:**

If you need to write raw SQL, always use parameterized queries:

```php
<?php

$username = request('username');
$password = request('password');

// Secure raw query
$user = DB::select(
    "SELECT * FROM users WHERE username = ? AND password = ?",
    [$username, $password]
);

if ($user) {
    return "Login successful!";
} else {
    return "Invalid credentials!";
}
```

---

### Key Laravel Features to Prevent SQL Injection

1. **Eloquent ORM:**

   - Automatically escapes user inputs.
   - Simplifies database operations with object-relational mapping.

2. **Query Builder:**

   - Provides a fluent interface to build database queries securely.

3. **Parameterized Raw Queries:**

   - Use placeholders (`?`) or named bindings to safely inject variables.

4. **Validation Rules:**
   - Use Laravel’s built-in validation to ensure user inputs are clean before processing them.

---

### Additional Security Practices

1. **Avoid Using `DB::statement` for User Input:** Raw statements can be risky without parameterization.
2. **Validate Inputs:** Use Laravel's `request()->validate()` to ensure inputs meet specific criteria.
3. **Limit Database Permissions:** Assign only necessary privileges to the database user.
4. **Update Dependencies:** Keep Laravel and its packages up-to-date.
