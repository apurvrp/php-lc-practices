### **What are PHP Sessions?**

---

A **PHP Session** is a way to store data across multiple requests made by a user. It enables you to retain information (like user login status, preferences, or shopping cart contents) as the user navigates your website.

- **Session Data:** Stored on the server, and a unique session ID is assigned to each user.
- **Session ID:** Sent to the user via a cookie or appended to URLs for identification.

---

### **Why Use Sessions?**

HTTP is **stateless**, meaning it doesn't retain any information between requests. Sessions solve this by allowing the server to "remember" user-specific data.

---

### **How PHP Sessions Work?**

1. **Session Start:** Start the session using `session_start()`.
2. **Session Data Store:** Store user data in the `$_SESSION` superglobal array.
3. **Session ID Management:** PHP creates a unique session ID for each user.
4. **Session Expiry:** Sessions have a default expiration time, configurable by settings.

---

### **Session Life Cycle**

1. **Session Initialization:**

   - Starts when `session_start()` is called.
   - A new session ID is created if no session exists.

2. **Storing Data:**

   - Use the `$_SESSION` array to store user-specific data.

3. **Session Continuation:**

   - On subsequent requests, the browser sends the session ID to the server to continue the same session.

4. **Session Expiry:**

   - A session ends automatically after a predefined idle period (default: 24 minutes in PHP).

5. **Session Destruction:**
   - Use `session_destroy()` to manually terminate the session and clear its data.

---

### **Session Configuration Settings**

- **`session.gc_maxlifetime`:** Sets the lifetime of a session in seconds.
- **`session.cookie_lifetime`:** Specifies how long the session cookie remains on the browser.

---

### **Practical Example**

#### **Step 1: Start a Session and Store Data**

```php
<?php
// Start the session
session_start();

// Store data in the session
$_SESSION['username'] = "Apurv";
$_SESSION['role'] = "Admin";

echo "Session data saved.";
?>
```

---

#### **Step 2: Access Session Data on Another Page**

```php
<?php
// Resume the session
session_start();

// Access session data
if (isset($_SESSION['username'])) {
    echo "Hello, " . $_SESSION['username']; // Outputs: Hello, Apurv
    echo "Your role is: " . $_SESSION['role']; // Outputs: Your role is: Admin
} else {
    echo "No session data found.";
}
?>
```

---

#### **Step 3: Destroy the Session**

```php
<?php
// Resume the session
session_start();

// Destroy the session
session_destroy();

echo "Session destroyed.";
?>
```

---

### **Important Notes About Sessions**

1. **Session Storage:**

   - By default, PHP stores session data in files on the server.
   - The location is defined in `php.ini` (`session.save_path`).

2. **Security Tips:**
   - **Regenerate Session ID:** Use `session_regenerate_id()` to prevent session hijacking.
   - **Use HTTPS:** Always use sessions over secure connections.
   - **Validate Session Data:** Ensure session data is sanitized to avoid misuse.

---

### **Session Expiry Example**

To set a custom session timeout, modify these settings in `php.ini` or your PHP script:

```php
<?php
// Set session lifetime to 30 minutes
ini_set('session.gc_maxlifetime', 1800);
ini_set('session.cookie_lifetime', 1800);

session_start();
?>
```

If a user is inactive for more than 30 minutes, their session will expire.

---

### **Summary of Session Life Cycle**

| **Stage**           | **Action**                                      |
| ------------------- | ----------------------------------------------- |
| **Start Session**   | `session_start()`                               |
| **Store Data**      | Store data in `$_SESSION` array                 |
| **Retrieve Data**   | Access stored data in future requests           |
| **Expire Session**  | Automatically ends after `gc_maxlifetime`       |
| **Destroy Session** | Manually clear session with `session_destroy()` |

By using sessions, PHP makes it easy to manage user-specific data efficiently and securely across your web application.
